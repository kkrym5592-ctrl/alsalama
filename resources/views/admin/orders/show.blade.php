<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Order #{{ $order->id }} - AL SALAMA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --red: #e63946;
            --red-hover: #c92e3b;
            --bg: #070a12;
            --card: #0d1220;
            --card-hover: #121a2b;
            --border: #222b3d;
            --text: #f4f6fb;
            --muted: #8e9ab0;
            --green: #20c982;
            --blue: #438cff;
            --orange: #ffb648;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Inter, sans-serif;
        }

        a {
            text-decoration: none;
        }

        button, input, select, textarea {
            font-family: inherit;
        }

        button, a {
            -webkit-tap-highlight-color: transparent;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 14px max(20px, calc((100% - 1150px) / 2));
            background: rgba(7, 10, 18, .97);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }

        .nav-left,
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-btn {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--card);
            color: var(--text);
            transition: .2s;
        }

        .back-btn:hover {
            color: var(--red);
            border-color: var(--red);
        }

        .brand-title {
            margin: 0;
            font-size: 19px;
            font-weight: 800;
        }

        .brand-subtitle {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 11px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 10px 14px;
            border: 1px solid transparent;
            border-radius: 10px;
            color: white;
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
            white-space: nowrap;
        }

        .btn-red {
            background: var(--red);
        }

        .btn-red:hover {
            background: var(--red-hover);
        }

        .btn-dark {
            background: var(--card);
            border-color: var(--border);
        }

        .btn-dark:hover {
            background: var(--card-hover);
            border-color: #46516a;
        }

        .btn-blue {
            background: rgba(67, 140, 255, .10);
            border-color: rgba(67, 140, 255, .35);
            color: #83b3ff;
        }

        .btn-blue:hover {
            background: var(--blue);
            color: white;
        }

        .page {
            width: 100%;
            max-width: 1150px;
            margin: auto;
            padding: 28px 25px 45px;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 9px;
            color: #ff6975;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .page-heading h2 {
            margin: 0;
            font-size: 29px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .page-heading p {
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .heading-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .panel {
            margin-bottom: 20px;
            padding: 23px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 17px;
        }

        .panel-heading {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 22px;
        }

        .panel-icon {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 12px;
            background: rgba(230, 57, 70, .12);
            color: var(--red);
            font-size: 16px;
        }

        .panel-heading h3 {
            margin: 0;
            font-size: 15px;
            font-weight: 800;
        }

        .panel-heading p {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 11px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
            margin-bottom: 20px;
        }

        .summary-card {
            min-width: 0;
            padding: 17px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
        }

        .summary-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 13px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .summary-label i {
            color: var(--red);
        }

        .summary-value {
            font-size: 19px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .summary-value.total {
            color: #ff6975;
        }

        .summary-note {
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 11px;
            border: 1px solid transparent;
            border-radius: 9px;
            font-size: 10px;
            font-weight: 800;
        }

        .status-pending,
        .payment-pending {
            color: var(--orange);
            background: rgba(255, 182, 72, .10);
            border-color: rgba(255, 182, 72, .2);
        }

        .status-preparing {
            color: var(--blue);
            background: rgba(67, 140, 255, .10);
            border-color: rgba(67, 140, 255, .2);
        }

        .status-completed,
        .status-delivered,
        .payment-paid {
            color: var(--green);
            background: rgba(32, 201, 130, .10);
            border-color: rgba(32, 201, 130, .2);
        }

        .status-cancelled,
        .status-canceled,
        .payment-failed {
            color: #ff6975;
            background: rgba(230, 57, 70, .10);
            border-color: rgba(230, 57, 70, .2);
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .detail-item {
            min-width: 0;
            padding: 14px;
            background: #090e19;
            border: 1px solid rgba(255, 255, 255, .045);
            border-radius: 11px;
        }

        .detail-label {
            display: block;
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .detail-value {
            display: block;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
            overflow-wrap: anywhere;
            line-height: 1.6;
        }

        .detail-value a {
            color: #ff6975;
        }

        .detail-value a:hover {
            text-decoration: underline;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 570px;
        }

        .items-table th {
            padding: 14px 16px;
            background: #111827;
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .items-table td {
            padding: 15px 16px;
            border-top: 1px solid var(--border);
            color: var(--text);
            font-size: 12px;
            vertical-align: middle;
        }

        .items-table tbody tr:hover {
            background: rgba(255, 255, 255, .02);
        }

        .product-name {
            font-weight: 800;
        }

        .product-subtitle {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
        }

        .quantity-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            padding: 6px 9px;
            background: rgba(230, 57, 70, .10);
            border: 1px solid rgba(230, 57, 70, .2);
            border-radius: 7px;
            color: #ff6975;
            font-weight: 800;
        }

        .money {
            font-weight: 800;
            white-space: nowrap;
        }

        .totals {
            width: 100%;
            max-width: 380px;
            margin: 20px 0 0 auto;
            padding: 17px;
            background: #090e19;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 10px 0;
            color: var(--muted);
            font-size: 12px;
        }

        .total-row strong {
            color: var(--text);
            font-weight: 800;
            text-align: right;
        }

        .total-row.grand-total {
            margin-top: 7px;
            padding-top: 17px;
            border-top: 1px solid var(--border);
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
        }

        .total-row.grand-total strong {
            color: #ff6975;
            font-size: 20px;
        }

        .notes-box {
            padding: 15px;
            background: #090e19;
            border: 1px solid var(--border);
            border-left: 3px solid var(--red);
            border-radius: 10px;
            color: #dce2ee;
            font-size: 12px;
            line-height: 1.9;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .empty-items {
            padding: 25px;
            color: var(--muted);
            text-align: center;
            font-size: 12px;
        }

        .page-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 0 0;
            color: var(--muted);
            font-size: 10px;
        }

        .page-footer strong {
            color: var(--red);
            letter-spacing: 1px;
        }

        @media (max-width: 800px) {
            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .page-heading {
                flex-direction: column;
            }

            .details-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 550px) {
            .navbar {
                padding: 11px 13px;
                gap: 8px;
            }

            .nav-left {
                gap: 8px;
                min-width: 0;
            }

            .back-btn {
                width: 37px;
                height: 37px;
            }

            .brand-title {
                font-size: 15px;
            }

            .brand-subtitle {
                font-size: 9px;
            }

            .nav-actions {
                gap: 6px;
            }

            .nav-actions .btn {
                width: 38px;
                min-height: 38px;
                height: 38px;
                padding: 0;
                font-size: 12px;
            }

            .nav-actions .btn span {
                display: none;
            }

            .page {
                padding: 22px 13px 30px;
            }

            .page-heading h2 {
                font-size: 24px;
            }

            .heading-actions {
                width: 100%;
            }

            .heading-actions .btn {
                flex: 1;
            }

            .panel {
                padding: 16px;
                border-radius: 14px;
            }

            .summary-grid {
                gap: 10px;
            }

            .summary-card {
                padding: 13px;
            }

            .summary-value {
                font-size: 17px;
            }

            .summary-label {
                font-size: 9px;
            }

            .details-grid {
                grid-template-columns: 1fr;
                gap: 9px;
            }

            .page-footer {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media print {
            @page {
                size: A4;
                margin: 12mm;
            }

            body {
                background: white !important;
                color: #111 !important;
                font-family: Arial, sans-serif;
            }

            .navbar,
            .heading-actions,
            .no-print,
            .page-footer {
                display: none !important;
            }

            .page {
                max-width: none;
                padding: 0;
            }

            .page-heading {
                margin-bottom: 15px;
            }

            .page-heading h2,
            .page-heading p,
            .eyebrow {
                color: #111 !important;
            }

            .panel,
            .summary-card,
            .detail-item,
            .totals,
            .notes-box {
                background: white !important;
                color: #111 !important;
                border-color: #ddd !important;
                break-inside: avoid;
            }

            .panel {
                padding: 14px;
                margin-bottom: 12px;
            }

            .panel-heading h3,
            .summary-value,
            .detail-value,
            .total-row strong,
            .items-table td {
                color: #111 !important;
            }

            .summary-label,
            .detail-label,
            .panel-heading p,
            .total-row,
            .product-subtitle {
                color: #555 !important;
            }

            .items-table th {
                background: #eee !important;
                color: #222 !important;
            }

            .items-table th,
            .items-table td {
                border-color: #ddd !important;
            }

            .status-badge,
            .quantity-pill {
                background: white !important;
                color: #111 !important;
                border-color: #aaa !important;
            }

            .summary-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .details-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .table-wrapper {
                overflow: visible;
            }

            .items-table {
                min-width: 0;
            }
        }
    </style>
</head>

<body>

@php
    $status = $order->status ?? 'unknown';

    $statusClass = match($status) {
        'pending' => 'status-pending',
        'preparing', 'out_for_delivery' => 'status-preparing',
        'completed' => 'status-completed',
        'delivered' => 'status-delivered',
        'cancelled' => 'status-cancelled',
        'canceled' => 'status-canceled',
        default => 'status-pending',
    };

    $statusLabel = match($status) {
        'out_for_delivery' => 'Out for delivery',
        'cancelled', 'canceled' => 'Cancelled',
        default => ucfirst(str_replace('_', ' ', $status)),
    };

    $paymentStatus = $order->payment_status ?? 'pending';

    $paymentClass = match($paymentStatus) {
        'paid' => 'payment-paid',
        'failed' => 'payment-failed',
        default => 'payment-pending',
    };

    $paymentLabel = ucfirst(str_replace('_', ' ', $paymentStatus));

    $items = $order->items ?? collect();

    $subtotal = (float) ($order->subtotal ?? $items->sum(function ($item) {
        return (float) ($item->price ?? 0) * (int) ($item->quantity ?? 0);
    }));

    $deliveryFee = (float) ($order->delivery_fee ?? 0);

    $total = (float) ($order->total ?? ($subtotal + $deliveryFee));

    $customer = $order->user ?? null;

    $deliveryUser = $order->deliveryUser ?? null;
@endphp

<header class="navbar">
    <div class="nav-left">
        <a href="{{ route('admin.orders.index') }}"
           class="back-btn"
           aria-label="Back to orders"
           title="Back to orders">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div>
            <h1 class="brand-title">AL SALAMA</h1>
            <p class="brand-subtitle">Order details and management</p>
        </div>
    </div>

    <div class="nav-actions">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-dark">
            <i class="fa-solid fa-list"></i>
            <span>All Orders</span>
        </a>
    </div>
</header>

<main class="page">

    <section class="page-heading">
        <div>
            <div class="eyebrow">
                <i class="fa-solid fa-receipt"></i>
                ORDER DETAILS
            </div>

            <h2>Order #{{ $order->id }}</h2>

            <p>
                Created on
                {{ $order->created_at?->format('d M Y - h:i A') ?? 'N/A' }}
            </p>
        </div>

        <div class="heading-actions">
            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-blue">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Order
            </a>

            <a href="{{ route('admin.orders.kitchen-receipt', $order) }}"
               class="btn btn-dark">
                <i class="fa-solid fa-utensils"></i>
                Kitchen Receipt
            </a>

            <a href="{{ route('admin.orders.receipt', $order) }}"
               target="_blank"
               rel="noopener"
               class="btn btn-red">
                <i class="fa-solid fa-print"></i>
                Customer Receipt
            </a>
        </div>
    </section>

    {{-- SUMMARY CARDS --}}

    <section class="summary-grid">

        <div class="summary-card">
            <div class="summary-label">
                <i class="fa-solid fa-money-bill-wave"></i>
                Order Total
            </div>

            <div class="summary-value total">
                {{ number_format($total, 2) }} EGP
            </div>

            <div class="summary-note">Final order amount</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">
                <i class="fa-solid fa-circle-check"></i>
                Order Status
            </div>

            <div>
                <span class="status-badge {{ $statusClass }}">
                    <i class="fa-solid fa-circle"></i>
                    {{ $statusLabel }}
                </span>
            </div>

            <div class="summary-note">Current order progress</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">
                <i class="fa-solid fa-credit-card"></i>
                Payment Status
            </div>

            <div>
                <span class="status-badge {{ $paymentClass }}">
                    <i class="fa-solid fa-circle"></i>
                    {{ $paymentLabel }}
                </span>
            </div>

            <div class="summary-note">
                {{ ucfirst($order->payment_method ?? 'Not specified') }}
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-label">
                <i class="fa-solid fa-basket-shopping"></i>
                Total Items
            </div>

            <div class="summary-value">
                {{ $items->sum('quantity') }}
            </div>

            <div class="summary-note">
                {{ $items->count() }} different product(s)
            </div>
        </div>

    </section>

    {{-- CUSTOMER INFORMATION --}}

    <section class="panel">

        <div class="panel-heading">
            <div class="panel-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <div>
                <h3>Customer Information</h3>
                <p>Customer details associated with this order</p>
            </div>
        </div>

        <div class="details-grid">

            <div class="detail-item">
                <span class="detail-label">Customer Name</span>
                <span class="detail-value">
                    {{ $customer->name ?? 'Guest / Unknown' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Customer ID</span>
                <span class="detail-value">
                    {{ $order->user_id ?? 'N/A' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Email Address</span>
                <span class="detail-value">
                    @if(!empty($customer?->email))
                        <a href="mailto:{{ $customer->email }}">
                            {{ $customer->email }}
                        </a>
                    @else
                        Not available
                    @endif
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Phone Number</span>
                <span class="detail-value">
                    @if(!empty($customer?->phone))
                        <a href="tel:{{ $customer->phone }}">
                            {{ $customer->phone }}
                        </a>
                    @elseif(!empty($order->phone))
                        <a href="tel:{{ $order->phone }}">
                            {{ $order->phone }}
                        </a>
                    @else
                        Not available
                    @endif
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Delivery Address</span>
                <span class="detail-value">
                    {{ $order->address ?? $order->delivery_address ?? $customer->address ?? 'Not specified' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Order Type</span>
                <span class="detail-value">
                    {{ ucfirst($order->order_type ?? 'N/A') }}
                </span>
            </div>

        </div>

    </section>

    {{-- ORDER INFORMATION --}}

    <section class="panel">

        <div class="panel-heading">
            <div class="panel-icon">
                <i class="fa-solid fa-clipboard-list"></i>
            </div>

            <div>
                <h3>Order Information</h3>
                <p>Payment, delivery, and timeline details</p>
            </div>
        </div>

        <div class="details-grid">

            <div class="detail-item">
                <span class="detail-label">Order Number</span>
                <span class="detail-value">#{{ $order->id }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Order Created</span>
                <span class="detail-value">
                    {{ $order->created_at?->format('d M Y - h:i A') ?? 'N/A' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Last Updated</span>
                <span class="detail-value">
                    {{ $order->updated_at?->format('d M Y - h:i A') ?? 'N/A' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Payment Method</span>
                <span class="detail-value">
                    {{ ucfirst($order->payment_method ?? 'Not specified') }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Payment Status</span>
                <span class="detail-value">{{ $paymentLabel }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Delivery Person</span>
                <span class="detail-value">
                    {{ $deliveryUser->name ?? 'Not assigned / Not applicable' }}
                </span>
            </div>

        </div>

    </section>

    {{-- SETTLEMENT INFORMATION --}}

<section class="panel">

    <div class="panel-heading">
        <div class="panel-icon">
            <i class="fa-solid fa-scale-balanced"></i>
        </div>

        <div>
            <h3>بيانات التسوية</h3>
            <p>اسم التسوية والوزن والسعر</p>
        </div>
    </div>

    <div class="details-grid">

        <div class="detail-item">
            <span class="detail-label">اسم التسوية</span>
            <span class="detail-value">
                {{ filled($order->settlement_name) ? $order->settlement_name : 'غير محدد' }}
            </span>
        </div>

        <div class="detail-item">
            <span class="detail-label">وزن التسوية</span>
            <span class="detail-value">
                @if($order->settlement_weight !== null && $order->settlement_weight !== '')
                    {{ $order->settlement_weight }} كجم
                @else
                    غير محدد
                @endif
            </span>
        </div>

        <div class="detail-item">
            <span class="detail-label">سعر التسوية</span>
            <span class="detail-value">
                @if($order->settlement_price !== null && $order->settlement_price !== '')
                    {{ $order->settlement_price }} جنيه
                @else
                    غير محدد
                @endif
            </span>
        </div>

    </div>

</section>

    {{-- ORDER ITEMS --}}

    <section class="panel">

        <div class="panel-heading">
            <div class="panel-icon">
                <i class="fa-solid fa-burger"></i>
            </div>

            <div>
                <h3>Ordered Products</h3>
                <p>Every product, quantity, price, and line total</p>
            </div>
        </div>

        @if($items->count())

            <div class="table-wrapper">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Line Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($items as $item)
                            @php
                                $product = $item->product ?? null;
                                $quantity = (int) ($item->quantity ?? 0);
                                $unitPrice = (float) ($item->price ?? 0);
                                $lineTotal = $unitPrice * $quantity;
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <span class="product-name">
                                        {{ $product->name ?? 'Product #' . ($item->product_id ?? 'N/A') }}
                                    </span>

                                    @if(!empty($item->notes))
                                        <span class="product-subtitle">
                                            {{ $item->notes }}
                                        </span>
                                    @endif
                                </td>

                                <td class="money">
                                    {{ number_format($unitPrice, 2) }} EGP
                                </td>

                                <td>
                                    <span class="quantity-pill">
                                        {{ $quantity }}
                                    </span>
                                </td>

                                <td class="money">
                                    {{ number_format($lineTotal, 2) }} EGP
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else

            <div class="empty-items">
                <i class="fa-solid fa-box-open"></i>
                No products were found for this order.
            </div>

        @endif

        <div class="totals">

            <div class="total-row">
                <span>Subtotal</span>
                <strong>{{ number_format($subtotal, 2) }} EGP</strong>
            </div>

            @if(($order->order_type ?? '') === 'delivery')
                <div class="total-row">
                    <span>Delivery Fee</span>
                    <strong>{{ number_format($deliveryFee, 2) }} EGP</strong>
                </div>
            @endif

            <div class="total-row grand-total">
                <span>Grand Total</span>
                <strong>{{ number_format($total, 2) }} EGP</strong>
            </div>

        </div>

    </section>

    {{-- ORDER NOTES --}}

    @if(!empty($order->notes))

        <section class="panel">

            <div class="panel-heading">
                <div class="panel-icon">
                    <i class="fa-solid fa-note-sticky"></i>
                </div>

                <div>
                    <h3>Order Notes</h3>
                    <p>Additional instructions provided for this order</p>
                </div>
            </div>

            <div class="notes-box">{{ $order->notes }}</div>

        </section>

    @endif

    <footer class="page-footer">
        <span>AL SALAMA · Order management system</span>
        <strong>ORDER #{{ $order->id }}</strong>
    </footer>

</main>

</body>
</html>
