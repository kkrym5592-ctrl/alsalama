<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    /**
     * Display shifts, today's orders, and shift history.
     */
    public function index()
    {
        $today = now()->toDateString();

        // Close shifts left open from previous dates.
        Shift::where('status', 'open')
            ->whereDate('opened_at', '<', $today)
            ->update([
                'status' => 'closed',
                'closed_at' => now(),
            ]);

        // Get today's latest shift, or create one if none exists.
        $todayShift = DB::transaction(function () use ($today) {
            $shift = Shift::whereDate('opened_at', $today)
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            if (!$shift) {
                $shift = Shift::create([
                    'opened_at' => now(),
                    'status' => 'open',
                ]);
            }

            return $shift;
        });

        // Count orders during this shift.
        $todayOrderCount = Order::whereBetween('created_at', [
            $todayShift->opened_at,
            $todayShift->closed_at ?? now(),
        ])->count();

        $nextOrderNumber = $todayOrderCount + 1;

        // Get orders during this shift.
        $orders = Order::with('user')
            ->whereBetween('created_at', [
                $todayShift->opened_at,
                $todayShift->closed_at ?? now(),
            ])
            ->orderByDesc('id')
            ->paginate(20);

        // Get shifts history.
        $shifts = Shift::withCount('orders')
            ->orderByDesc('opened_at')
            ->paginate(15, ['*'], 'shifts_page');

        return view('admin.shifts.index', compact(
            'todayShift',
            'todayOrderCount',
            'nextOrderNumber',
            'orders',
            'shifts'
        ));
    }

    /**
     * Open a new shift.
     */
    public function open(Request $request)
    {
        $shift = DB::transaction(function () {
            // Prevent opening another shift while one is already open.
            $existingShift = Shift::where('status', 'open')
                ->lockForUpdate()
                ->first();

            if ($existingShift) {
                return null;
            }

            return Shift::create([
                'opened_at' => now(),
                'status' => 'open',
            ]);
        });

        if (!$shift) {
            return redirect()
                ->route('admin.shifts.index')
                ->with('error', 'There is already an open shift.');
        }

        return redirect()
            ->route('admin.shifts.index')
            ->with('success', 'Shift opened successfully.');
    }

    /**
     * Close a shift.
     */
    public function close(Shift $shift)
    {
        $closed = DB::transaction(function () use ($shift) {
            $lockedShift = Shift::whereKey($shift->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedShift->status === 'closed') {
                return false;
            }

            $lockedShift->update([
                'status' => 'closed',
                'closed_at' => now(),
            ]);

            return true;
        });

        if (!$closed) {
            return redirect()
                ->route('admin.shifts.index')
                ->with('error', 'This shift is already closed.');
        }

        return redirect()
            ->route('admin.shifts.index')
            ->with('success', 'Shift closed successfully.');
    }
}
