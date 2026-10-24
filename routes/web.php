<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuGroupController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\OfferController;

use App\Http\Controllers\PortfolioController;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| PUBLIC HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function (Request $request) {

    $categories = Category::query()
        ->select('categories.*')
        ->selectSub(
            Product::query()
                ->selectRaw('COUNT(*)')
                ->whereColumn(
                    'products.category_id',
                    'categories.id'
                )
                ->where('products.is_available', true),
            'products_count'
        )
        ->where('categories.is_active', true)
        ->orderBy('categories.name')
        ->get();

    $selectedCategoryId = $request->query('category');

    $selectedCategory = null;

    if (
        $selectedCategoryId !== null &&
        ctype_digit((string) $selectedCategoryId)
    ) {
        $selectedCategory = $categories->firstWhere(
            'id',
            (int) $selectedCategoryId
        );
    }

    $productsQuery = Product::query()
        ->where('is_available', true)
        ->with('category');

    if ($selectedCategory) {
        $productsQuery->where(
            'category_id',
            $selectedCategory->id
        );
    }

    $products = $productsQuery
        ->orderBy('name')
        ->take(12)
        ->get();

    $offerProducts = Product::query()
        ->where('is_available', true)
        ->whereNotNull('discount_price')
        ->where('discount_price', '>', 0)
        ->whereColumn('discount_price', '<', 'price')
        ->orderByDesc('updated_at')
        ->take(8)
        ->get();

    return view('customer.home', compact(
        'offerProducts',
        'categories',
        'selectedCategory',
        'products'
    ));

})->name('home');




Route::get('/details/{product}', [
    ProductController::class,
    'details',
])->name('details');
/*
|--------------------------------------------------------------------------
| PUBLIC MENU
|--------------------------------------------------------------------------
*/

Route::get('/menu', function () {
    return view('customer.menu');
})->name('menu');


/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::get('/cart', function () {

    $cart = session()->get('cart', []);

    if (!is_array($cart)) {
        $cart = [];
    }

    $productIds = array_map('intval', array_keys($cart));

    $products = Product::whereIn('id', $productIds)
        ->get()
        ->keyBy('id');

    $cartItems = [];
    $cartSubtotal = 0;
    $cartCount = 0;

    foreach ($cart as $productId => $quantity) {

        $productId = (int) $productId;

        $product = $products->get($productId);

        if (!$product) {
            unset($cart[$productId]);
            continue;
        }

        $quantity = max(1, min(99, (int) $quantity));
        $cart[$productId] = $quantity;

        $originalPrice = (float) $product->price;

        $hasDiscount = $product->discount_price !== null
            && (float) $product->discount_price < $originalPrice;

        $unitPrice = $hasDiscount
            ? (float) $product->discount_price
            : $originalPrice;

        $lineTotal = round($unitPrice * $quantity, 2);

        $cartItems[] = [
            'product' => $product,
            'quantity' => $quantity,
            'original_price' => $originalPrice,
            'unit_price' => $unitPrice,
            'line_total' => $lineTotal,
            'has_discount' => $hasDiscount,
        ];

        $cartSubtotal += $lineTotal;
        $cartCount += $quantity;
    }

    session()->put('cart', $cart);

    $cartSubtotal = round($cartSubtotal, 2);

    $canCheckout = $cartCount > 0;

    foreach ($cartItems as $item) {
        if (!$item['product']->is_available) {
            $canCheckout = false;
            break;
        }
    }

    return view('customer.cart', compact(
        'cartItems',
        'cartCount',
        'cartSubtotal',
        'canCheckout'
    ));

})->name('cart');


/*
|--------------------------------------------------------------------------
| ADD PRODUCT TO CART
|--------------------------------------------------------------------------
*/

Route::post('/cart/add/{product}', function (
    Request $request,
    Product $product
) {

    abort_unless($product->is_available, 404);

    $cart = session()->get('cart', []);

    if (!is_array($cart)) {
        $cart = [];
    }

    $productId = (int) $product->id;
    $currentQuantity = (int) ($cart[$productId] ?? 0);

    $cart[$productId] = min(99, $currentQuantity + 1);

    session()->put('cart', $cart);

    $cartCount = array_sum($cart);

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart.',
            'product_id' => $productId,
            'product_name' => $product->name,
            'quantity' => $cart[$productId],
            'cart_count' => $cartCount,
        ]);
    }

    return redirect()
        ->route('cart')
        ->with(
            'success',
            $product->name . ' added to your cart.'
        );

})->name('cart.add');


/*
|--------------------------------------------------------------------------
| UPDATE CART QUANTITY
|--------------------------------------------------------------------------
*/

Route::post('/cart/update/{product}', function (
    Request $request,
    Product $product
) {

    $validated = $request->validate([
        'quantity' => [
            'required',
            'integer',
            'min:1',
            'max:99',
        ],
    ]);

    $cart = session()->get('cart', []);

    if (!is_array($cart)) {
        $cart = [];
    }

    $productId = (int) $product->id;

    if (!array_key_exists($productId, $cart)) {
        return redirect()
            ->route('cart')
            ->with(
                'error',
                'This product is not in your cart.'
            );
    }

    $newQuantity = (int) $validated['quantity'];
    $currentQuantity = (int) $cart[$productId];

    if (
        $product->is_available &&
        $newQuantity > $currentQuantity
    ) {
        $cart[$productId] = $newQuantity;
    } elseif ($newQuantity <= $currentQuantity) {
        $cart[$productId] = $newQuantity;
    } else {
        return redirect()
            ->route('cart')
            ->with(
                'error',
                'This product is currently unavailable.'
            );
    }

    session()->put('cart', $cart);

    return redirect()
        ->route('cart')
        ->with('success', 'Cart updated successfully.');

})->name('cart.update');


/*
|--------------------------------------------------------------------------
| REMOVE PRODUCT FROM CART
|--------------------------------------------------------------------------
*/

Route::post('/cart/remove/{product}', function (Product $product) {

    $cart = session()->get('cart', []);

    if (!is_array($cart)) {
        $cart = [];
    }

    unset($cart[(int) $product->id]);

    session()->put('cart', $cart);

    return redirect()
        ->route('cart')
        ->with(
            'success',
            'Product removed from your cart.'
        );

})->name('cart.remove');


/*
|--------------------------------------------------------------------------
| CART CHECKOUT
|--------------------------------------------------------------------------
*/

Route::post('/cart/checkout', function (Request $request) {

    $cart = session()->get('cart', []);

    if (!is_array($cart) || empty($cart)) {
        return redirect()
            ->route('cart')
            ->with('error', 'Your cart is empty.');
    }

    $validated = $request->validate([
        'notes' => [
            'nullable',
            'string',
            'max:1000',
        ],

        'payment_method' => [
            'required',
            'in:cash,wallet,card',
        ],
    ]);

    session()->put(
        'cart_note',
        trim($validated['notes'] ?? '')
    );

    session()->put(
        'cart_payment_method',
        $validated['payment_method']
    );

    if (!auth()->check()) {
        return redirect()
            ->route('login')
            ->with(
                'error',
                'Please log in to submit your order.'
            );
    }

    abort_unless(
        auth()->user()->role === 'customer',
        403,
        'Only customers can submit customer cart orders.'
    );

    return app(OrderController::class)
        ->storeCustomerOrder($request);

})->name('cart.checkout');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::get('/settings', function () {
        return view('customer.settings');
    })->name('settings');


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:customer'])->group(function () {

        /*
        | Customer order statuses
        */

        Route::get('/checkout', function () {

            $orders = Order::with([
                'items.product',
            ])
                ->where('user_id', auth()->id())
                ->orderByDesc('created_at')
                ->paginate(10);

            return view(
                'customer.checkout',
                compact('orders')
            );

        })->name('customer.checkout');


        /*
        | My Orders Alias
        */

        Route::get('/my-orders', function () {
            return redirect()->route('customer.checkout');
        })->name('customer.orders');


        /*
        | Customer order submission
        */

        Route::post('/checkout', [
            OrderController::class,
            'storeCustomerOrder',
        ])->name('customer.order.store');


        /*
        | Customer Profile
        */

        Route::get('/profile', function () {
            return view('customer.profile');
        })->name('customer.profile');

    });

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            DashboardController::class,
            'index',
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | SHIFTS
        |--------------------------------------------------------------------------
        */

        Route::get('/shifts', [
            ShiftController::class,
            'index',
        ])->name('shifts.index');

        Route::post('/shifts/open', [
            ShiftController::class,
            'open',
        ])->name('shifts.open');

        Route::post('/shifts/{shift}/close', [
            ShiftController::class,
            'close',
        ])->whereNumber('shift')
            ->name('shifts.close');


        /*
        |--------------------------------------------------------------------------
        | ACCOUNTS
        |--------------------------------------------------------------------------
        */

        Route::get('/accounts', [
            AccountController::class,
            'index',
        ])->name('accounts.index');


        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        Route::get('/users', [
            UserController::class,
            'index',
        ])->name('users.index');

        Route::patch('/users/{user}/role', [
            UserController::class,
            'updateRole',
        ])->whereNumber('user')
            ->name('users.updateRole');


        /*
        |--------------------------------------------------------------------------
        | MENU GROUPS
        |--------------------------------------------------------------------------
        */

        Route::resource('menu-groups', MenuGroupController::class)
    ->parameters(['menu-groups' => 'menuGroup']);

        Route::get('/menu-groups', [
            MenuGroupController::class,
            'index',
        ])->name('menu-groups.index');

        Route::get('/menu-groups/create', [
            MenuGroupController::class,
            'create',
        ])->name('menu-groups.create');

        Route::post('/menu-groups', [
            MenuGroupController::class,
            'store',
        ])->name('menu-groups.store');

        Route::get('/menu-groups/{menuGroup}/edit', [
            MenuGroupController::class,
            'edit',
        ])->whereNumber('menuGroup')
            ->name('menu-groups.edit');

        Route::put('/menu-groups/{menuGroup}', [
            MenuGroupController::class,
            'update',
        ])->whereNumber('menuGroup')
            ->name('menu-groups.update');

        Route::delete('/menu-groups/{menuGroup}', [
            MenuGroupController::class,
            'destroy',
        ])->whereNumber('menuGroup')
            ->name('menu-groups.destroy');


        /*
        |--------------------------------------------------------------------------
        | OFFERS
        |--------------------------------------------------------------------------
        */

        Route::get('/offers', [
            OfferController::class,
            'index',
        ])->name('offers.index');

        Route::get('/offers/create', [
            OfferController::class,
            'create',
        ])->name('offers.create');

        Route::post('/offers', [
            OfferController::class,
            'store',
        ])->name('offers.store');

        Route::get('/offers/{offer}/edit', [
            OfferController::class,
            'edit',
        ])->whereNumber('offer')
            ->name('offers.edit');

        Route::put('/offers/{offer}', [
            OfferController::class,
            'update',
        ])->whereNumber('offer')
            ->name('offers.update');

        Route::delete('/offers/{offer}', [
            OfferController::class,
            'destroy',
        ])->whereNumber('offer')
            ->name('offers.destroy');

        Route::patch('/offers/{offer}/toggle-status', [
            OfferController::class,
            'toggleStatus',
        ])->whereNumber('offer')
            ->name('offers.toggleStatus');


        /*
        |--------------------------------------------------------------------------
        | ORDERS - CUSTOM ROUTES
        |--------------------------------------------------------------------------
        */

        Route::get('/orders/select-user', [
            OrderController::class,
            'selectUser',
        ])->name('orders.selectUser');


        /*
        | Search all products
        */

        Route::get('/orders/products/search', [
            OrderController::class,
            'searchProducts',
        ])->name('orders.products.search');


        /*
        | Load products by category
        */

        Route::get(
            '/orders/category/{categoryId}/products',
            [OrderController::class, 'productsByCategory']
        )->whereNumber('categoryId')
            ->name('orders.category.products');


        /*
        | Today's offers - required by admin.orders.create
        */

        Route::get('/orders/today-offers', [
            OrderController::class,
            'todayOffers',
        ])->name('orders.todayOffers');


        /*
        | Settlement screen - required by admin.orders.create
        */

        Route::get('/orders/settlements/create', [
            OrderController::class,
            'createSettlement',
        ])->name('orders.settlements.create');

        Route::post('/orders/settlements', [
            OrderController::class,
            'storeSettlement',
        ])->name('orders.settlements.store');


        /*
        | Orders filtered by status
        */

        Route::get('/orders/status/{status}', [
            OrderController::class,
            'byStatus',
        ])->whereIn('status', [
            'pending',
            'preparing',
            'out_for_delivery',
        ])->name('orders.status');


        /*
        | Receipts
        */

        Route::get('/orders/{order}/receipt', [
            OrderController::class,
            'receipt',
        ])->whereNumber('order')
            ->name('orders.receipt');

        Route::get('/orders/{order}/kitchen-receipt', [
            OrderController::class,
            'kitchenReceipt',
        ])->whereNumber('order')
            ->name('orders.kitchen-receipt');


        /*
        | Confirm a pending delivery order
        */

        Route::get('/orders/{order}/confirm-delivery', [
            OrderController::class,
            'confirmDelivery',
        ])->whereNumber('order')
            ->name('orders.confirmDelivery');


        /*
        |--------------------------------------------------------------------------
        | ORDERS - STATUS ACTIONS
        |--------------------------------------------------------------------------
        */

        Route::patch('/orders/{order}/done', [
            OrderController::class,
            'done',
        ])->whereNumber('order')
            ->name('orders.done');

        Route::patch('/orders/{order}/payment-method', [
            OrderController::class,
            'updatePaymentMethod',
        ])->whereNumber('order')
            ->name('orders.payment-method');

        Route::patch('/orders/{order}/confirm', [
            OrderController::class,
            'confirm',
        ])->whereNumber('order')
            ->name('orders.confirm');

        Route::patch('/orders/{order}/cancel', [
            OrderController::class,
            'cancel',
        ])->whereNumber('order')
            ->name('orders.cancel');

        Route::patch('/orders/{order}/confirm-delivery', [
            OrderController::class,
            'saveConfirmedDelivery',
        ])->whereNumber('order')
            ->name('orders.confirmDelivery.save');

        Route::patch('/orders/{order}/cancel-active', [
            OrderController::class,
            'cancelActive',
        ])->whereNumber('order')
            ->name('orders.cancelActive');

        Route::patch('/orders/{order}/complete-preparing', [
            OrderController::class,
            'completePreparing',
        ])->whereNumber('order')
            ->name('orders.completePreparing');

        Route::patch('/orders/{order}/delivered', [
            OrderController::class,
            'markDelivered',
        ])->whereNumber('order')
            ->name('orders.delivered');


        /*
        |--------------------------------------------------------------------------
        | ORDERS - CRUD
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [
            OrderController::class,
            'index',
        ])->name('orders.index');

        Route::get('/orders/create', [
            OrderController::class,
            'create',
        ])->name('orders.create');

        Route::post('/orders', [
            OrderController::class,
            'store',
        ])->name('orders.store');

        Route::get('/orders/{order}/edit', [
            OrderController::class,
            'edit',
        ])->whereNumber('order')
            ->name('orders.edit');

        Route::put('/orders/{order}', [
            OrderController::class,
            'update',
        ])->whereNumber('order')
            ->name('orders.update');

        Route::delete('/orders/{order}', [
            OrderController::class,
            'destroy',
        ])->whereNumber('order')
            ->name('orders.destroy');

        Route::get('/orders/{order}', [
            OrderController::class,
            'show',
        ])->whereNumber('order')
            ->name('orders.show');


        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        Route::resource('products', ProductController::class);


        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        Route::get('/categories', [
            CategoryController::class,
            'index',
        ])->name('category.index');

        Route::get('/category/create', [
            CategoryController::class,
            'create',
        ])->name('category.create');

        Route::post('/category', [
            CategoryController::class,
            'store',
        ])->name('category.store');

        Route::get('/category/{category}/edit', [
            CategoryController::class,
            'edit',
        ])->whereNumber('category')
            ->name('category.edit');

        Route::put('/category/{category}', [
            CategoryController::class,
            'update',
        ])->whereNumber('category')
            ->name('category.update');

        Route::delete('/category/{category}', [
            CategoryController::class,
            'destroy',
        ])->whereNumber('category')
            ->name('category.destroy');

        Route::get('/category/{category}', [
            CategoryController::class,
            'show',
        ])->whereNumber('category')
            ->name('category.show');

    });


/*
|--------------------------------------------------------------------------
| DRIVER / DELIVERY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:driver'])->group(function () {

    Route::get('/driver', function () {
        return 'Driver Area';
    })->name('driver.dashboard');

});


/*
|--------------------------------------------------------------------------
| BREEZE AUTH
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';