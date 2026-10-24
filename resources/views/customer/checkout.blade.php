<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AL SALAMA | My Orders</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --red: #e63946;
            --red-dark: #c92d39;
            --bg: #090909;
            --card: #111111;
            --card-light: #181818;
            --border: #292929;
            --text: #ffffff;
            --muted: #969696;
            --green: #37c98a;
            --yellow: #e9b65b;
            --blue: #58a6ff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .header {
            background: #101010;
            border-bottom: 1px solid var(--border);
        }

        .header-inner {
            max-width: 1150px;
            margin: auto;
            padding: 16px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            border-radius: 13px;
            background: linear-gradient(145deg, #ff505b, #c51e2c);
            display: grid;
            place-items: center;
            font-size: 19px;
        }

        .brand-name {
            font-size: 19px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
        }

        .header-link {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            border: 1px solid var(--border);
            padding: 11px 15px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            transition: .2s;
        }

        .header-link:hover {
            border-color: var(--red);
        }

        .page {
            max-width: 1150px;
            margin: auto;
            padding: 35px 22px 55px;
        }

        .breadcrumb {
            display: flex;
            gap: 10px;
            align-items: center;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 24px;
        }

        .breadcrumb .current {
            color: var(--red);
        }

        .page-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 28px;
        }

        .page-heading h1 {
            font-size: clamp(27px, 4vw, 36px);
            font-weight: 800;
            margin-bottom: 8px;
        }

        .page-heading h1 span {
            color: var(--red);
        }

        .page-heading p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .orders-count {
            color: #ff9aa1;
            background: rgba(230, 57, 70, .09);
            border: 1px solid rgba(230, 57, 70, .2);
            padding: 10px 13px;
            border-radius: 12px;
            font-size: 12px;
            white-space: nowrap;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 13px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .alert-success {
            color: #80e7b9;
            background: rgba(55, 201, 138, .08);
            border: 1px solid rgba(55, 201, 138, .2);
        }

        .alert-error {
            color: #ff858d;
            background: rgba(230, 57, 70, .08);
            border: 1px solid rgba(230, 57, 70, .22);
        }

        .orders-list {
            display: grid;
            gap: 18px;
        }

        .order-card {
            border: 1px solid var(--border);
            background: var(--card);
            border-radius: 17px;
            overflow: hidden;
        }

        .order-header {
            padding: 20px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .order-identity {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .order-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: rgba(230, 57, 70, .1);
            color: var(--red);
        }

        .order-number {
            font-size: 15px;
            font-weight: 800;
        }

        .order-date {
            color: var(--muted);
            font-size: 11px;
            margin-top: 5px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            border: 1px solid transparent;
        }

        .status-pending {
            background: rgba(233, 182, 91, .1);
            border-color: rgba(233, 182, 91, .2);
            color: var(--yellow);
        }

        .status-preparing {
            background: rgba(88, 166, 255, .1);
            border-color: rgba(88, 166, 255, .2);
            color: var(--blue);
        }

        .status-out_for_delivery {
            background: rgba(172, 131, 255, .1);
            border-color: rgba(172, 131, 255, .2);
            color: #c4a7ff;
        }

        .status-delivered,
        .status-completed {
            background: rgba(55, 201, 138, .1);
            border-color: rgba(55, 201, 138, .2);
            color: var(--green);
        }

        .status-cancelled {
            background: rgba(230, 57, 70, .1);
            border-color: rgba(230, 57, 70, .2);
            color: #ff818a;
        }

        .status-unknown {
            background: #1d1d1d;
            border-color: #333;
            color: #ccc;
        }

        .order-body {
            padding: 21px 22px;
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .items-list {
            display: grid;
            gap: 12px;
        }

        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 13px;
            background: #0c0c0c;
            border: 1px solid #222;
            border-radius: 12px;
        }

        .item-info {
            min-width: 0;
        }

        .item-name {
            font-size: 13px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .item-quantity {
            color: var(--muted);
            font-size: 11px;
            margin-top: 5px;
        }

        .item-total {
            white-space: nowrap;
            font-size: 12px;
            font-weight: 700;
        }

        .order-meta {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 20px;
        }

        .meta-box {
            background: var(--card-light);
            border: 1px solid var(--border);
            padding: 14px;
            border-radius: 12px;
            min-width: 0;
        }

        .meta-label {
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 7px;
        }

        .meta-value {
            font-size: 12px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .meta-value.total {
            color: var(--red);
            font-size: 16px;
        }

        .order-note {
            margin-top: 16px;
            padding: 13px 14px;
            background: #0c0c0c;
            border: 1px solid #222;
            border-radius: 12px;
        }

        .order-note-title {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 7px;
        }

        .order-note-text {
            font-size: 12px;
            line-height: 1.7;
            overflow-wrap: anywhere;
            white-space: pre-wrap;
        }

        .order-footer {
            border-top: 1px solid var(--border);
            padding: 15px 22px;
            color: var(--muted);
            font-size: 11px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .empty-state {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            text-align: center;
            padding: 55px 20px;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            display: grid;
            place-items: center;
            border-radius: 22px;
            background: rgba(230, 57, 70, .1);
            color: var(--red);
            font-size: 27px;
        }

        .empty-state h2 {
            font-size: 19px;
            margin-bottom: 9px;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .primary-button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 9px;
            background: var(--red);
            padding: 13px 18px;
            border-radius: 11px;
            color: white;
            font-weight: 700;
            font-size: 12px;
            transition: .2s;
        }

        .primary-button:hover {
            background: var(--red-dark);
        }

        .pagination {
            margin-top: 25px;
        }

        .pagination nav > div:first-child {
            color: var(--muted);
            font-size: 12px;
        }

        .pagination a,
        .pagination span[aria-current="page"] span {
            background: #161616 !important;
            border-color: #333 !important;
            color: white !important;
        }

        .footer {
            text-align: center;
            color: #686868;
            margin-top: 40px;
            font-size: 11px;
        }

        @media (max-width: 650px) {
            .header-inner {
                padding: 13px 15px;
            }

            .page {
                padding: 25px 14px 40px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .order-header,
            .order-body,
            .order-footer {
                padding-left: 15px;
                padding-right: 15px;
            }

            .order-meta {
                grid-template-columns: 1fr 1fr;
            }

            .order-meta .meta-box:last-child {
                grid-column: 1 / -1;
            }

            .order-number {
                font-size: 13px;
            }

            .status {
                font-size: 10px;
                padding: 8px 10px;
            }
        }

        @media (max-width: 390px) {
            .brand-name {
                font-size: 16px;
            }

            .brand-subtitle {
                font-size: 10px;
            }

            .brand-icon {
                width: 39px;
                height: 39px;
            }

            .header-link span {
                display: none;
            }

            .order-identity {
                gap: 9px;
            }

            .order-icon {
                width: 37px;
                height: 37px;
            }

            .item-total {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>

<header class="header">
    <div class="header-inner">

        <a href="{{ route('home') }}" class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-utensils"></i>
            </div>

            <div>
                <div class="brand-name">AL SALAMA</div>
                <div class="brand-subtitle">Your orders, all in one place</div>
            </div>
        </a>

        <a href="{{ route('home') }}" class="header-link">
            <i class="fa-solid fa-utensils"></i>
            <span>Browse Menu</span>
        </a>

    </div>
</header>

<main class="page">

    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 9px;"></i>
        <span class="current">My Orders</span>
    </div>

    <div class="page-heading">
        <div>
            <h1>My <span>Orders</span></h1>
            <p>Track your order status and review your previous orders.</p>
        </div>

        <div class="orders-count">
            <i class="fa-solid fa-receipt"></i>
            {{ $orders->total() }} {{ $orders->total() === 1 ? 'Order' : 'Orders' }}
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($orders->count())

        <div class="orders-list">

            @foreach($orders as $order)

                @php
                    $statusLabels = [
                        'pending' => 'Pending Confirmation',
                        'preparing' => 'Preparing',
                        'out_for_delivery' => 'Out for Delivery',
                        'delivered' => 'Delivered',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ];

                    $statusIcons = [
                        'pending' => 'fa-clock',
                        'preparing' => 'fa-fire-burner',
                        'out_for_delivery' => 'fa-motorcycle',
                        'delivered' => 'fa-box-open',
                        'completed' => 'fa-circle-check',
                        'cancelled' => 'fa-circle-xmark',
                    ];

                    $status = $order->status ?? 'pending';

                    $statusLabel = $statusLabels[$status]
                        ?? ucfirst(str_replace('_', ' ', $status));

                    $statusIcon = $statusIcons[$status]
                        ?? 'fa-circle-info';

                    $paymentLabels = [
                        'cash' => 'Cash',
                        'card' => 'Card',
                        'wallet' => 'Mobile Wallet',
                    ];

                    $paymentLabel = $paymentLabels[$order->payment_method]
                        ?? ucfirst((string) $order->payment_method);

                    $typeLabels = [
                        'pickup' => 'Pickup',
                        'delivery' => 'Delivery',
                    ];

                    $orderTypeLabel = $typeLabels[$order->order_type]
                        ?? $order->order_type;

                    $displayNumber = $order->daily_order_number
                        ?: $order->id;
                @endphp

                <article class="order-card">

                    <div class="order-header">

                        <div class="order-identity">
                            <div class="order-icon">
                                <i class="fa-solid fa-receipt"></i>
                            </div>

                            <div>
                                <div class="order-number">
                                    Order #{{ $displayNumber }}
                                </div>

                                <div class="order-date">
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ optional($order->created_at)->format('M d, Y - h:i A') }}
                                </div>
                            </div>
                        </div>

                        <span class="status status-{{ $status }}">
                            <i class="fa-solid {{ $statusIcon }}"></i>
                            {{ $statusLabel }}
                        </span>

                    </div>

                    <div class="order-body">

                        <h3 class="section-title">
                            <i class="fa-solid fa-bag-shopping"
                               style="color: var(--red); margin-right: 5px;"></i>
                            Order Items
                        </h3>

                        @if($order->items->count())

                            <div class="items-list">

                                @foreach($order->items as $item)

                                    <div class="order-item">
                                        <div class="item-info">
                                            <div class="item-name">
                                                {{ $item->product->name ?? 'Product no longer available' }}
                                            </div>

                                            <div class="item-quantity">
                                                Quantity: {{ $item->quantity }}
                                                × {{ number_format((float) $item->price, 2) }} EGP
                                            </div>
                                        </div>

                                        <div class="item-total">
                                            {{ number_format(
                                                (float) $item->price * (int) $item->quantity,
                                                2
                                            ) }}
                                            EGP
                                        </div>
                                    </div>

                                @endforeach

                            </div>

                        @else

                            <p style="color: var(--muted); font-size: 12px;">
                                No order items found.
                            </p>

                        @endif

                        <div class="order-meta">

                            <div class="meta-box">
                                <div class="meta-label">Order Type</div>

                                <div class="meta-value">
                                    {{ $orderTypeLabel }}
                                </div>
                            </div>

                            <div class="meta-box">
                                <div class="meta-label">Payment Method</div>

                                <div class="meta-value">
                                    {{ $paymentLabel }}
                                </div>
                            </div>

                            <div class="meta-box">
                                <div class="meta-label">Order Total</div>

                                <div class="meta-value total">
                                    {{ number_format((float) $order->total, 2) }} EGP
                                </div>
                            </div>

                        </div>

                        @if($order->notes)
                            <div class="order-note">
                                <div class="order-note-title">
                                    <i class="fa-solid fa-note-sticky"></i>
                                    Your Order Notes
                                </div>

                                <div class="order-note-text">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="order-footer">
                        <span>
                            <i class="fa-solid fa-circle-info"></i>
                            Order status:
                            {{ $statusLabel }}
                        </span>

                        <span>
                            Payment:
                            {{ ucfirst($order->payment_status ?? 'pending') }}
                        </span>
                    </div>

                </article>

            @endforeach

        </div>

        @if($orders->hasPages())
            <div class="pagination">
                {{ $orders->links() }}
            </div>
        @endif

    @else

        <section class="empty-state">
            <div class="empty-icon">
                <i class="fa-solid fa-receipt"></i>
            </div>

            <h2>No Orders Yet</h2>

            <p>
                You haven't placed any orders yet.
                Browse our menu and your orders will appear here.
            </p>

            <a href="{{ route('menu') }}" class="primary-button">
                <i class="fa-solid fa-utensils"></i>
                Explore the Menu
            </a>
        </section>

    @endif

    <footer class="footer">
        AL SALAMA &copy; {{ date('Y') }}. All rights reserved.
    </footer>

</main>

</body>
</html>