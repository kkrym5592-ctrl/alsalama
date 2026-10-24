@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<style>
    :root {
        --primary: #e63946;
        --primary-hover: #cf3040;
        --primary-dark: #a51d2d;
        --primary-soft: rgba(230, 57, 70, .08);
        --primary-shadow: rgba(230, 57, 70, .18);

        --page-bg: #f7f7f7;
        --card-bg: #ffffff;
        --panel-bg: #ffffff;
        --table-head-bg: #fafbfc;
        --icon-bg: #f1f3f7;
        --quick-icon-bg: #f5f6f8;

        --text: #171717;
        --text-dark: #252525;
        --text-secondary: #7a8494;
        --text-muted: #8b95a5;
        --text-light: #98a2b3;
        --icon: #344054;

        --border: #e9edf2;
        --border-light: #edf0f4;
        --border-table: #f0f2f5;

        --white: #ffffff;
        --black: #000000;

        --success: #18a058;
        --success-soft: #e7f8ef;
        --success-dark: #16834b;

        --warning: #b77900;
        --warning-soft: #fff4df;

        --info: #2670d9;
        --info-soft: #eaf2ff;

        --shadow: rgba(0, 0, 0, .05);
    }

    .welcome {
        margin-bottom: 28px;
    }

    .welcome h2 {
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 7px;
        color: var(--text);
    }

    .welcome p {
        color: var(--text-muted);
        font-size: 13px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 15px;
        padding: 22px;
        position: relative;
        overflow: hidden;
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--icon-bg);
        color: var(--icon);
    }

    .stat-label {
        margin-top: 18px;
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 500;
    }

    .stat-number {
        font-size: 25px;
        font-weight: 800;
        margin-top: 5px;
        color: var(--text);
    }

    .stat-change {
        font-size: 10px;
        color: var(--success);
        margin-top: 8px;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    .panel {
        background: var(--panel-bg);
        border: 1px solid var(--border);
        border-radius: 15px;
        overflow: hidden;
    }

    .panel-header {
        padding: 20px 22px;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .panel-header h3 {
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
        margin: 0;
    }

    .view-all {
        color: var(--primary);
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
    }

    .view-all:hover {
        color: var(--primary-hover);
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
    }

    .orders-table th {
        text-align: left;
        padding: 13px 20px;
        font-size: 10px;
        color: var(--text-light);
        font-weight: 600;
        background: var(--table-head-bg);
    }

    .orders-table td {
        padding: 15px 20px;
        border-top: 1px solid var(--border-table);
        font-size: 11px;
        color: var(--text);
    }

    .order-id {
        font-weight: 700;
    }

    .customer {
        font-weight: 600;
    }

    .order-type {
        color: var(--text-secondary);
    }

    .status {
        display: inline-flex;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700;
    }

    .status.pending {
        background: var(--warning-soft);
        color: var(--warning);
    }

    .status.preparing {
        background: var(--info-soft);
        color: var(--info);
    }

    .status.completed {
        background: var(--success-soft);
        color: var(--success-dark);
    }

    .quick-actions {
        padding: 20px;
        display: grid;
        gap: 10px;
    }

    .quick-action {
        border: 1px solid var(--border-light);
        border-radius: 11px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 13px;
        transition: .2s;
        text-decoration: none;
        color: var(--text);
        min-width: 0;
    }

    .quick-action:hover {
        border-color: var(--primary);
        transform: translateY(-1px);
        color: var(--text);
        background: var(--primary-soft);
    }

    .quick-action-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: var(--quick-icon-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--icon);
        flex-shrink: 0;
    }

    .quick-action-icon.red {
        background: var(--primary-soft);
        color: var(--primary);
    }

    .quick-action strong {
        font-size: 11px;
        display: block;
    }

    .quick-action span {
        color: var(--text-light);
        font-size: 9px;
        display: block;
        margin-top: 3px;
    }

    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {
        .content {
            padding: 18px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .topbar {
            padding: 0 18px;
        }

        .orders-table {
            min-width: 650px;
        }

        .panel.orders-panel {
            overflow-x: auto;
        }
    }
</style>

<div class="welcome">
    <h2>
        Welcome back, {{ auth()->user()->name ?? 'Admin' }} 👋
    </h2>

    <p>
        Here is what's happening with AL SALAMA today.
    </p>
</div>

{{-- STATISTICS --}}
<div class="stats-grid">

    {{-- PENDING --}}
    <div class="stat-card">
        <div class="stat-top">
            <div>
                <div class="stat-label">Pending Orders</div>
                <div class="stat-number">{{ $pendingOrders }}</div>
                <div class="stat-change">
                    <i class="fa-solid fa-arrow-up"></i>
                    New orders waiting
                </div>
            </div>

            <div class="stat-icon">
                <i class="fa-solid fa-bell"></i>
            </div>
        </div>
    </div>

    {{-- PREPARING --}}
    <div class="stat-card">
        <div class="stat-top">
            <div>
                <div class="stat-label">Preparing</div>
                <div class="stat-number">{{ $preparingOrders }}</div>
                <div class="stat-change">
                    <i class="fa-solid fa-fire"></i>
                    In kitchen
                </div>
            </div>

            <div class="stat-icon">
                <i class="fa-solid fa-fire-burner"></i>
            </div>
        </div>
    </div>

    {{-- COMPLETED --}}
    <div class="stat-card">
        <div class="stat-top">
            <div>
                <div class="stat-label">Completed</div>
                <div class="stat-number">{{ $completedOrders }}</div>
                <div class="stat-change">
                    <i class="fa-solid fa-check"></i>
                    Ready orders
                </div>
            </div>

            <div class="stat-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
    </div>

    {{-- SALES --}}
    <div class="stat-card">
        <div class="stat-top">
            <div>
                <div class="stat-label">Today's Sales</div>
                <div class="stat-number">
                    {{ number_format($todaySales, 2) }} EGP
                </div>
                <div class="stat-change">
                    <i class="fa-solid fa-arrow-up"></i>
                    Today's total
                </div>
            </div>

            <div class="stat-icon">
                <i class="fa-solid fa-coins"></i>
            </div>
        </div>
    </div>

</div>

{{-- LOWER SECTION --}}
<div class="dashboard-grid">

    {{-- RECENT ORDERS --}}
    <div class="panel orders-panel">
        <div class="panel-header">
            <h3>Recent Orders</h3>

            <a href="{{ route('admin.orders.index') }}" class="view-all">
                View All
            </a>
        </div>

        <table class="orders-table">
            <thead>
                <tr>
                    <th>ORDER</th>
                    <th>CUSTOMER</th>
                    <th>TYPE</th>
                    <th>TOTAL</th>
                    <th>STATUS</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td class="order-id">#{{ $order->id }}</td>

                        <td class="customer">
                            {{ $order->user->name ?? 'Guest' }}
                        </td>

                        <td class="order-type">
                            {{ ucfirst($order->order_type) }}
                        </td>

                        <td>
                            {{ number_format($order->total, 2) }} EGP
                        </td>

                        <td>
                            @if($order->status === 'pending')
                                <span class="status pending">Pending</span>
                            @elseif($order->status === 'preparing')
                                <span class="status preparing">Preparing</span>
                            @elseif($order->status === 'completed')
                                <span class="status completed">Completed</span>
                            @elseif($order->status === 'out_for_delivery')
                                <span class="status preparing">Out for delivery</span>
                            @elseif($order->status === 'delivered')
                                <span class="status completed">Delivered</span>
                            @elseif($order->status === 'cancelled')
                                <span class="status pending">Cancelled</span>
                            @else
                                <span class="status">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            style="text-align:center; padding:30px; color:var(--text-muted);">
                            No orders yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="panel">
        <div class="panel-header">
            <h3>Quick Actions</h3>
        </div>
        
        <div class="quick-actions">
            {{-- NEW: MANAGE SHIFTS --}}
            <a href="{{ route('admin.shifts.index') }}" class="quick-action">
                <div class="quick-action-icon red">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
    
                <div>
                    <strong>Manage Shifts</strong>
                    <span>Open and manage daily shifts</span>
                </div>
            </a>
    
            {{-- NEW: MANAGE ACCOUNTS --}}
            <a href="{{ route('admin.accounts.index') }}" class="quick-action">
                <div class="quick-action-icon red">
                    <i class="fa-solid fa-wallet"></i>
                </div>
    
                <div>
                    <strong>Manage Accounts</strong>
                    <span>Review daily accounts and transactions</span>
                </div>
            </a>

            {{-- ADD PRODUCT --}}
            <a href="{{ route('admin.products.create') }}" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fa-solid fa-plus"></i>
                </div>

                <div>
                    <strong>Add Product</strong>
                    <span>Create a new menu item</span>
                </div>
            </a>

            {{-- ADD CATEGORY --}}
            <a href="{{ route('admin.category.create') }}" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <div>
                    <strong>Add Category</strong>
                    <span>Create a new category</span>
                </div>
            </a>

            {{-- CREATE GROUP --}}
            <a href="{{ route('admin.menu-groups.create') }}" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fa-solid fa-folder-plus"></i>
                </div>

                <div>
                    <strong>Create New Group</strong>
                    <span>Add a menu group with name and image</span>
                </div>
            </a>

            {{-- MANAGE USERS --}}
            <a href="{{ route('admin.users.index') }}" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div>
                    <strong>Manage Users</strong>
                    <span>View users and manage their roles</span>
                </div>
            </a>


        </div>
    </div>

</div>

@endsection
