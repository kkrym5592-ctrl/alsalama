<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->toDateString();

        $validated = $request->validate([
            'date_from' => ['nullable', 'date_format:Y-m-d'],
            'date_to' => [
                'nullable',
                'date_format:Y-m-d',
                'after_or_equal:date_from',
            ],
            'shift_id' => [
                'nullable',
                'integer',
                Rule::exists('shifts', 'id'),
            ],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $dateFrom = $validated['date_from'] ?? $today;
        $dateTo = $validated['date_to'] ?? $today;
        $shiftId = $validated['shift_id'] ?? '';
        $search = trim($validated['search'] ?? '');

        $shifts = Shift::orderByDesc('opened_at')->get();

        // الطلبات المكتملة أو التي تم توصيلها خلال الفترة المحددة.
        $baseQuery = Order::query()
            ->whereBetween('created_at', [
                Carbon::parse($dateFrom)->startOfDay(),
                Carbon::parse($dateTo)->endOfDay(),
            ])
            ->whereIn('status', ['completed', 'delivered']);

        // فلتر الوردية.
        if ($shiftId !== '') {
            $baseQuery->where('shift_id', $shiftId);
        }

        // البحث في بيانات الطلب والعميل.
        if ($search !== '') {
            $baseQuery->where(function ($query) use ($search) {
                $like = '%' . $search . '%';

                $query->where('id', 'like', $like)
                    ->orWhere('daily_order_number', 'like', $like)
                    ->orWhere('order_type', 'like', $like)
                    ->orWhere('order_kind', 'like', $like)
                    ->orWhere('status', 'like', $like)
                    ->orWhere('payment_method', 'like', $like)
                    ->orWhere('payment_status', 'like', $like)
                    ->orWhere('subtotal', 'like', $like)
                    ->orWhere('delivery_fee', 'like', $like)
                    ->orWhere('total', 'like', $like)
                    ->orWhere('settlement_name', 'like', $like)
                    ->orWhere('settlement_weight', 'like', $like)
                    ->orWhere('settlement_price', 'like', $like)
                    ->orWhere('user_id', 'like', $like)
                    ->orWhere('delivery_user_id', 'like', $like)
                    ->orWhere('shift_id', 'like', $like)
                    ->orWhere('notes', 'like', $like)
                    ->orWhereHas('user', function ($userQuery) use ($like) {
                        $userQuery->where('name', 'like', $like)
                            ->orWhere('phone', 'like', $like);
                    });
            });
        }

        // الإحصائيات حسب الفلاتر والبحث.
        $totalOrders = (clone $baseQuery)->count();
        $totalSales = (clone $baseQuery)->sum('total');

        // قائمة الطلبات.
        $orders = (clone $baseQuery)
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.accounts.index', compact(
            'dateFrom',
            'dateTo',
            'shiftId',
            'search',
            'shifts',
            'totalSales',
            'totalOrders',
            'orders'
        ));
    }
}
