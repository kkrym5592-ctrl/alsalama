<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuGroup;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Shared Data
    |--------------------------------------------------------------------------
    */

    private function menuData(): array
    {
        return [
            'groups' => MenuGroup::with('categories')
                ->orderBy('name')
                ->get(),

            'categories' => Category::orderBy('name')->get(),

            'products' => Product::with('category')
                ->orderBy('name')
                ->get(),
        ];
    }

    private function deliveryUsers()
    {
        return User::where('role', 'delivery')
            ->orderBy('name')
            ->get(['id', 'name', 'phone']);
    }

    private function validateDeliveryUser($deliveryUserId): User
    {
        $deliveryUser = User::where('role', 'delivery')
            ->whereKey($deliveryUserId)
            ->first();

        if (!$deliveryUser) {
            throw ValidationException::withMessages([
                'delivery_user_id' => 'Please select a valid delivery person.',
            ]);
        }

        return $deliveryUser;
    }

    /*
    |--------------------------------------------------------------------------
    | Today's Offers
    |--------------------------------------------------------------------------
    */

    public function todayOffers()
    {
        $products = Product::query()
            ->whereNotNull('discount_price')
            ->where('discount_price', '>', 0)
            ->whereColumn('discount_price', '<', 'price')
            ->with('category')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'products' => $products,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Settlements
    |--------------------------------------------------------------------------
    */

    public function createSettlement()
    {
        return view('admin.orders.settlement');
    }

    public function settlementsCreate()
    {
        return $this->createSettlement();
    }

    public function storeSettlement(Request $request)
    {
        $validated = $request->validate([
            'settlement_name' => [
                'required',
                'string',
                'max:255',
            ],

            'settlement_weight' => [
                'required',
                'string',
                'max:255',
            ],

            'settlement_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ], [
            'settlement_name.required' => 'اسم التسوية مطلوب.',
            'settlement_weight.required' => 'الوزن مطلوب.',
            'settlement_price.required' => 'السعر مطلوب.',
            'settlement_price.numeric' => 'السعر يجب أن يكون رقمًا صحيحًا.',
            'settlement_price.min' => 'السعر لا يمكن أن يكون أقل من صفر.',
        ]);

        $order = DB::transaction(function () use ($validated) {
            $shift = Shift::where('status', 'open')
                ->whereDate('opened_at', now()->toDateString())
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            if (!$shift) {
                throw ValidationException::withMessages([
                    'shift' => 'لا يمكن تسجيل التسوية. افتح يوم العمل أولاً.',
                ]);
            }

            $customerId = User::where(
                'email',
                'walkin@alsalama.local'
            )->value('id');

            if (!$customerId) {
                throw ValidationException::withMessages([
                    'settlement_name' =>
                        'أنشئ حساب Walk-in أولاً حتى يمكن تسجيل التسوية.',
                ]);
            }

            $dailyOrderNumber = ((int) Order::where(
                'shift_id',
                $shift->id
            )->lockForUpdate()->max('daily_order_number')) + 1;

            $price = round((float) $validated['settlement_price'], 2);

            return Order::create([
                'user_id' => $customerId,
                'shift_id' => $shift->id,
                'daily_order_number' => $dailyOrderNumber,

                'order_type' => 'تسوية',
                'order_kind' => 'settlement',

                'settlement_name' => $validated['settlement_name'],
                'settlement_weight' => $validated['settlement_weight'],
                'settlement_price' => $price,

                'status' => 'completed',
                'payment_method' => 'cash',
                'payment_status' => 'pending',

                'subtotal' => $price,
                'delivery_fee' => 0,
                'total' => $price,
            ]);
        });

        return redirect()
            ->route('admin.orders.create')
            ->with(
                'success',
                "تم حفظ التسوية رقم {$order->daily_order_number} بنجاح."
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Offers
    |--------------------------------------------------------------------------
    */

    private function activeOffers()
    {
        $now = now();

        return Offer::query()
            ->where('is_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', $now);
            })
            ->get();
    }

    private function getProductPriceDetails(
        Product $product,
        $offers
    ): array {
        $originalPrice = max(0, (float) $product->price);

        $productDiscountPrice = $product->discount_price !== null
            ? (float) $product->discount_price
            : $originalPrice;

        $finalPrice = round(
            max(0, min($originalPrice, $productDiscountPrice)),
            2
        );

        $offerName = null;

        $matchingOffers = $offers->filter(
            function ($offer) use ($product) {
                $matchesProduct =
                    $offer->product_id !== null
                    && (int) $offer->product_id === (int) $product->id;

                $matchesCategory =
                    $offer->category_id !== null
                    && (int) $offer->category_id === (int) $product->category_id;

                return $matchesProduct || $matchesCategory;
            }
        );

        foreach ($matchingOffers as $offer) {
            $discountValue = max(0, (float) $offer->discount_value);

            if ($offer->discount_type === 'percentage') {
                $discountValue = min(100, $discountValue);

                $offerPrice = $originalPrice
                    * (1 - ($discountValue / 100));
            } else {
                $offerPrice = $originalPrice - $discountValue;
            }

            $offerPrice = round(
                max(0, min($originalPrice, $offerPrice)),
                2
            );

            if ($offerPrice < $finalPrice) {
                $finalPrice = $offerPrice;
                $offerName = $offer->name;
            }
        }

        return [
            'original_price' => round($originalPrice, 2),
            'effective_price' => round($finalPrice, 2),
            'has_offer' => $finalPrice < $originalPrice,
            'offer_name' => $offerName,
        ];
    }

    private function productsWithPrices($products)
    {
        $offers = $this->activeOffers();

        return $products->map(function ($product) use ($offers) {
            return array_merge(
                $product->toArray(),
                $this->getProductPriceDetails($product, $offers)
            );
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Calculate Order Items
    |--------------------------------------------------------------------------
    */

    private function calculateItems(array $items): array
    {
        $subtotal = 0;
        $itemsData = [];

        $productIds = array_column($items, 'product_id');

        $products = Product::whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $offers = $this->activeOffers();

        foreach ($items as $item) {
            $productId = (int) $item['product_id'];
            $quantity = (int) $item['quantity'];

            $product = $products->get($productId);

            if (!$product) {
                throw ValidationException::withMessages([
                    'items' => "Product #{$productId} was not found.",
                ]);
            }

            $priceDetails = $this->getProductPriceDetails(
                $product,
                $offers
            );

            $price = (float) $priceDetails['effective_price'];

            $subtotal += $price * $quantity;

            $itemsData[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
            ];
        }

        return [
            'subtotal' => round($subtotal, 2),
            'items' => $itemsData,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Customer
    |--------------------------------------------------------------------------
    */

    private function updateCustomerPhone(
        ?int $userId,
        array $validated
    ): void {
        if (
            $userId &&
            array_key_exists('customer_phone', $validated)
        ) {
            User::whereKey($userId)->update([
                'phone' => $validated['customer_phone'],
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    private function orderRules(bool $partial = false): array
    {
        $sometimes = $partial ? 'sometimes|' : '';

        return [
            'user_id' => $sometimes . 'nullable|exists:users,id',

            'customer_phone' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],

            'order_type' => $sometimes . 'required|in:delivery,pickup',

            'payment_method' => $sometimes . 'required|in:cash,card,wallet',

            'payment_status' => [
                'sometimes',
                'required',
                'in:pending,paid,failed',
            ],

            'delivery_user_id' => [
                'sometimes',
                'nullable',
                'required_if:order_type,delivery',
                'integer',
                'exists:users,id',
            ],

            'delivery_fee' => [
                'sometimes',
                'nullable',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'sometimes',
                'nullable',
                'string',
                'max:1000',
            ],

            'items' => [
                $partial ? 'sometimes' : 'required',
                'array',
                'min:1',
            ],

            'items.*.product_id' => [
                'required',
                'integer',
                'distinct',
                'exists:products,id',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
                'max:99',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Apply Changes To Existing Order
    |--------------------------------------------------------------------------
    */

    private function applyOrderChanges(
        Order $order,
        array $validated,
        bool $confirmOrder = false
    ): void {
        $orderType = $validated['order_type'] ?? $order->order_type;
        $userId = $validated['user_id'] ?? $order->user_id;

        if (!$userId) {
            throw ValidationException::withMessages([
                'user_id' => 'Please select a customer.',
            ]);
        }

        if ($orderType === 'delivery') {
            $deliveryUserId = array_key_exists(
                'delivery_user_id',
                $validated
            )
                ? $validated['delivery_user_id']
                : $order->delivery_user_id;

            if (!$deliveryUserId) {
                throw ValidationException::withMessages([
                    'delivery_user_id' => 'Please select a delivery person.',
                ]);
            }

            $this->validateDeliveryUser($deliveryUserId);

            $deliveryFee = (float) (
                $validated['delivery_fee']
                ?? $order->delivery_fee
                ?? 0
            );
        } else {
            $deliveryUserId = null;
            $deliveryFee = 0;
        }

        $order->user_id = $userId;
        $order->order_type = $orderType;
        $order->delivery_user_id = $deliveryUserId;
        $order->delivery_fee = $deliveryFee;

        if (array_key_exists('payment_method', $validated)) {
            $order->payment_method = $validated['payment_method'];
        }

        if (array_key_exists('payment_status', $validated)) {
            $order->payment_status = $validated['payment_status'];
        }

        if (array_key_exists('notes', $validated)) {
            $order->notes = $validated['notes'];
        }

        if (array_key_exists('items', $validated)) {
            $calculated = $this->calculateItems($validated['items']);

            $order->items()->delete();

            foreach ($calculated['items'] as $itemData) {
                $order->items()->create($itemData);
            }

            $order->subtotal = $calculated['subtotal'];
        } else {
            $order->subtotal = (float) $order->items()
                ->get()
                ->sum(function ($item) {
                    return (float) $item->price
                        * (int) $item->quantity;
                });
        }

        $order->total = round(
            (float) $order->subtotal + $deliveryFee,
            2
        );

        if (array_key_exists('customer_phone', $validated)) {
            $this->updateCustomerPhone(
                (int) $userId,
                $validated
            );
        }

        if ($confirmOrder) {
            $order->status = 'preparing';
        } elseif (array_key_exists('status', $validated)) {
            $order->status = $validated['status'];
        }

        $order->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Orders Dashboard
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pendingCount = Order::where('status', 'pending')->count();

        $preparingCount = Order::where('status', 'preparing')->count();

        $deliveryCount = Order::where(
            'status',
            'out_for_delivery'
        )->count();

        return view('admin.orders.index', compact(
            'pendingCount',
            'preparingCount',
            'deliveryCount'
        ));
    }

    public function byStatus(string $status)
    {
        abort_unless(
            in_array($status, [
                'pending',
                'preparing',
                'out_for_delivery',
            ], true),
            404
        );

        $orders = Order::with([
            'user',
            'deliveryUser',
            'items.product',
        ])
            ->where('status', $status)
            ->latest()
            ->get();

        $pageTitle = match ($status) {
            'pending' => 'Pending Orders',
            'preparing' => 'Preparing Orders',
            'out_for_delivery' => 'Out for Delivery',
            default => 'Orders',
        };

        return view('admin.orders.status', compact(
            'orders',
            'status',
            'pageTitle'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Create Admin Order
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.orders.create',
            array_merge(
                $this->menuData(),
                [
                    'deliveryUsers' => $this->deliveryUsers(),
                ]
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->orderRules());

        $orderType = $validated['order_type'];

        if ($orderType === 'delivery') {
            $this->validateDeliveryUser(
                $validated['delivery_user_id'] ?? null
            );
        }

        $order = DB::transaction(function () use (
            $validated,
            $orderType
        ) {
            $shift = Shift::where('status', 'open')
                ->whereDate('opened_at', now()->toDateString())
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            if (!$shift) {
                throw ValidationException::withMessages([
                    'shift' => 'لا يمكن إنشاء أوردر. افتح يوم العمل أولاً.',
                ]);
            }

            $calculated = $this->calculateItems($validated['items']);

            $customerId = $validated['user_id']
                ?? User::where(
                    'email',
                    'walkin@alsalama.local'
                )->value('id');

            if (!$customerId) {
                throw ValidationException::withMessages([
                    'user_id' =>
                        'Select a customer or create the Walk-in customer first.',
                ]);
            }

            $dailyOrderNumber = ((int) Order::where(
                'shift_id',
                $shift->id
            )->max('daily_order_number')) + 1;

            $deliveryFee = $orderType === 'delivery'
                ? (float) ($validated['delivery_fee'] ?? 0)
                : 0;

            $order = Order::create([
                'user_id' => $customerId,
                'shift_id' => $shift->id,
                'daily_order_number' => $dailyOrderNumber,

                'delivery_user_id' => $orderType === 'delivery'
                    ? $validated['delivery_user_id']
                    : null,

                'order_type' => $orderType,
                'status' => 'preparing',
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_status'] ?? 'pending',
                'subtotal' => $calculated['subtotal'],
                'delivery_fee' => $deliveryFee,
                'total' => round(
                    $calculated['subtotal'] + $deliveryFee,
                    2
                ),
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($calculated['items'] as $itemData) {
                $order->items()->create($itemData);
            }

            $this->updateCustomerPhone(
                (int) $customerId,
                $validated
            );

            return $order;
        });

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'daily_order_number' => $order->daily_order_number,
                'message' => 'Order created successfully.',
            ], 201);
        }

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Create Customer Order From Cart
    |--------------------------------------------------------------------------
    |
    | Uses cart, cart_note and cart_payment_method from the session.
    | This creates a pending pickup order for the authenticated customer.
    |
    */

    public function storeCustomerOrder(Request $request)
    {
        $user = $request->user();

        abort_unless($user && $user->role === 'customer', 403);

        $cart = session()->get('cart', []);

        if (!is_array($cart) || empty($cart)) {
            return redirect()
                ->route('cart')
                ->with('error', 'Your cart is empty.');
        }

        $paymentMethod = session()->get('cart_payment_method');

        if (!in_array($paymentMethod, ['cash', 'wallet', 'card'], true)) {
            return redirect()
                ->route('cart')
                ->with('error', 'Please select a valid payment method.');
        }

        $items = [];

        foreach ($cart as $productId => $quantity) {
            $productId = filter_var(
                $productId,
                FILTER_VALIDATE_INT
            );

            $quantity = filter_var(
                $quantity,
                FILTER_VALIDATE_INT
            );

            if (
                !$productId ||
                $productId < 1 ||
                !$quantity ||
                $quantity < 1 ||
                $quantity > 99
            ) {
                return redirect()
                    ->route('cart')
                    ->with('error', 'Your cart contains invalid items. Please review it.');
            }

            $items[] = [
                'product_id' => (int) $productId,
                'quantity' => (int) $quantity,
            ];
        }

        $products = Product::whereIn(
            'id',
            array_column($items, 'product_id')
        )->get()->keyBy('id');

        foreach ($items as $item) {
            $product = $products->get($item['product_id']);

            if (!$product) {
                return redirect()
                    ->route('cart')
                    ->with('error', 'A product in your cart no longer exists.');
            }

            if (!$product->is_available) {
                return redirect()
                    ->route('cart')
                    ->with(
                        'error',
                        $product->name . ' is currently unavailable.'
                    );
            }
        }

        $notes = trim((string) session()->get('cart_note', ''));

        $order = DB::transaction(function () use (
            $user,
            $items,
            $paymentMethod,
            $notes
        ) {
            $shift = Shift::where('status', 'open')
                ->whereDate('opened_at', now()->toDateString())
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            if (!$shift) {
                throw ValidationException::withMessages([
                    'shift' => 'Orders cannot be submitted right now. Please try again later.',
                ]);
            }

            // Recalculate prices on the server instead of trusting browser prices.
            $calculated = $this->calculateItems($items);

            $dailyOrderNumber = ((int) Order::where(
                'shift_id',
                $shift->id
            )->max('daily_order_number')) + 1;

            $order = Order::create([
                'user_id' => $user->id,
                'shift_id' => $shift->id,
                'daily_order_number' => $dailyOrderNumber,

                'order_type' => 'pickup',
                'order_kind' => 'regular',

                'status' => 'pending',

                'payment_method' => $paymentMethod,
                'payment_status' => 'pending',

                'subtotal' => $calculated['subtotal'],
                'delivery_fee' => 0,
                'total' => $calculated['subtotal'],

                'notes' => $notes !== '' ? $notes : null,
            ]);

            foreach ($calculated['items'] as $itemData) {
                $order->items()->create($itemData);
            }

            return $order;
        });

        // Clear the cart and checkout data only after the order is saved.
        session()->forget([
            'cart',
            'cart_note',
            'cart_payment_method',
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your order has been submitted successfully.',
                'order_id' => $order->id,
                'daily_order_number' => $order->daily_order_number,
                'status' => $order->status,
                'payment_method' => $order->payment_method,
                'total' => $order->total,
            ], 201);
        }

        return redirect()
            ->route('customer.orders')
            ->with(
                'success',
                "Your order #{$order->daily_order_number} has been submitted successfully."
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Show / Edit Order
    |--------------------------------------------------------------------------
    */

    public function show(Order $order)
    {
        $order->load([
            'user',
            'deliveryUser',
            'items.product',
        ]);

        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load([
            'user',
            'deliveryUser',
            'items.product',
        ]);

        return view(
            'admin.orders.create2',
            array_merge(
                [
                    'order' => $order,
                    'deliveryUsers' => $this->deliveryUsers(),
                ],
                $this->menuData()
            )
        );
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate(array_merge(
            $this->orderRules(true),
            [
                'status' => [
                    'sometimes',
                    'required',
                    'in:pending,preparing,completed,out_for_delivery,delivered,cancelled',
                ],
            ]
        ));

        DB::transaction(function () use ($order, $validated) {
            $this->applyOrderChanges($order, $validated);
        });

        $order->refresh();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully.',
                'order' => [
                    'id' => $order->id,
                    'daily_order_number' => $order->daily_order_number,
                    'status' => $order->status,
                    'order_type' => $order->order_type,
                    'payment_method' => $order->payment_method,
                    'payment_status' => $order->payment_status,
                    'subtotal' => $order->subtotal,
                    'delivery_fee' => $order->delivery_fee,
                    'total' => $order->total,
                ],
            ]);
        }

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        DB::transaction(function () use ($order) {
            $order->items()->delete();
            $order->delete();
        });

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully.',
            ]);
        }

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Order Completion / Payment
    |--------------------------------------------------------------------------
    */

    public function done(Order $order)
    {
        $order->update([
            'status' => 'completed',
        ]);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Order marked as completed.',
                'status' => $order->status,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Order marked as completed.');
    }

    public function updatePaymentMethod(
        Request $request,
        Order $order
    ) {
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,card,wallet',
        ]);

        $order->update([
            'payment_method' => $validated['payment_method'],
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment method updated successfully.',
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Payment method updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Receipts
    |--------------------------------------------------------------------------
    */

    public function receipt(Order $order)
    {
        $order->load([
            'user',
            'deliveryUser',
            'items.product',
        ]);

        return view('admin.orders.receipt', compact('order'));
    }

    public function kitchenReceipt(Order $order)
    {
        $order->load([
            'user',
            'deliveryUser',
            'items.product',
        ]);

        return view('admin.orders.kitchen-receipt', compact('order'));
    }

    /*
    |--------------------------------------------------------------------------
    | Product / Customer Search
    |--------------------------------------------------------------------------
    */

    public function productsByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $products = Product::where('category_id', $category->id)
            ->orderBy('name')
            ->get();

        return response()->json([
            'products' => $this->productsWithPrices($products),
        ]);
    }

    public function selectUser()
    {
        $users = User::orderBy('name')->get();

        return view('admin.orders.selectuser', compact('users'));
    }

    public function searchProducts()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->get();

        return response()->json([
            'products' => $this->productsWithPrices($products),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Confirm Pending Order
    |--------------------------------------------------------------------------
    */

    public function confirm(Order $order)
    {
        abort_unless($order->status === 'pending', 403);

        $order->load([
            'user',
            'deliveryUser',
            'items.product',
        ]);

        return view(
            'admin.orders.create2',
            array_merge(
                [
                    'order' => $order,
                    'deliveryUsers' => $this->deliveryUsers(),
                ],
                $this->menuData()
            )
        );
    }

    public function cancel(Order $order)
    {
        abort_unless($order->status === 'pending', 403);

        $order->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('admin.orders.status', 'pending')
            ->with('success', "Order #{$order->id} cancelled.");
    }

    public function confirmDelivery(Order $order)
    {
        abort_unless(
            $order->status === 'pending'
                && $order->order_type === 'delivery',
            403
        );

        $order->load([
            'user',
            'deliveryUser',
            'items.product',
        ]);

        return view(
            'admin.orders.create2',
            array_merge(
                [
                    'order' => $order,
                    'deliveryUsers' => $this->deliveryUsers(),
                ],
                $this->menuData()
            )
        );
    }

    public function saveConfirmedDelivery(
        Request $request,
        Order $order
    ) {
        abort_unless($order->status === 'pending', 403);

        $validated = $request->validate($this->orderRules(true));

        DB::transaction(function () use ($order, $validated) {
            $this->applyOrderChanges($order, $validated, true);
        });

        $order->refresh();

        return redirect()
            ->route('admin.orders.show', $order)
            ->with(
                'success',
                "Order #{$order->id} updated and confirmed successfully."
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Additional Status Actions
    |--------------------------------------------------------------------------
    */

    public function cancelActive(Order $order)
    {
        abort_unless(
            in_array(
                $order->status,
                ['preparing', 'out_for_delivery'],
                true
            ),
            403
        );

        $previousStatus = $order->status;

        $order->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('admin.orders.status', $previousStatus)
            ->with(
                'success',
                "Order #{$order->id} cancelled successfully."
            );
    }

    public function completePreparing(Order $order)
    {
        abort_unless($order->status === 'preparing', 403);

        if ($order->order_type === 'delivery') {
            $order->update([
                'status' => 'out_for_delivery',
            ]);
        } else {
            $order->update([
                'status' => 'completed',
            ]);
        }

        return redirect()
            ->route('admin.orders.receipt', $order)
            ->with(
                'success',
                "Order #{$order->id} updated successfully."
            );
    }

    public function markDelivered(Order $order)
    {
        abort_unless(
            $order->status === 'out_for_delivery'
                && $order->order_type === 'delivery',
            403
        );

        $order->update([
            'status' => 'delivered',
        ]);

        return redirect()
            ->route('admin.orders.status', 'out_for_delivery')
            ->with(
                'success',
                "Order #{$order->id} delivered successfully."
            );
    }
}