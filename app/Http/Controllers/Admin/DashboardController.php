<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // الطلبات التي تنتظر القبول
        $pendingOrders = Order::where('status', 'pending')
            ->count();

        // الطلبات الجاري تجهيزها
        $preparingOrders = Order::where('status', 'preparing')
            ->count();

        // عدد الطلبات المكتملة أو التي تم توصيلها اليوم
        $completedOrders = Order::whereDate('created_at', Carbon::today())
            ->whereIn('status', ['completed', 'delivered'])
            ->count();

        // مبيعات اليوم من الطلبات المكتملة أو التي تم توصيلها فقط
        $todaySales = Order::whereDate('created_at', Carbon::today())
            ->whereIn('status', ['completed', 'delivered'])
            ->sum('total');

        // أحدث 5 طلبات بجميع الحالات لمتابعة التشغيل
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'pendingOrders',
            'preparingOrders',
            'completedOrders',
            'todaySales',
            'recentOrders'
        ));
    }
}
