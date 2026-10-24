<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Order Management - AL SALAMA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --red: #e63946;
            --red-dark: #c92735;
            --black: #111111;
            --white: #ffffff;
            --bg: #ffffff;
            --card: #ffffff;
            --border: #cfcfcf;
            --muted: #666666;
            --light: #f7f7f7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--white);
            color: var(--black);
            font-family: Inter, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 20px max(20px, calc((100% - 1150px) / 2));
            background: var(--white);
            border-bottom: 2px solid var(--black);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .back-btn {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            border: 2px solid var(--border);
            border-radius: 12px;
            background: var(--white);
            color: var(--black);
            transition: .2s;
        }

        .back-btn:hover {
            background: var(--black);
            border-color: var(--black);
            color: var(--white);
        }

        h1 {
            margin: 0;
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -.6px;
        }

        .subtitle {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 12px;
        }

        .new-order {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 13px 18px;
            border: 2px solid var(--red);
            border-radius: 10px;
            background: var(--red);
            color: var(--white);
            font-size: 12px;
            font-weight: 800;
            transition: .2s;
        }

        .new-order:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
            transform: translateY(-2px);
        }

        .container {
            width: 100%;
            max-width: 1150px;
            margin: auto;
            padding: 42px 24px;
        }

        .intro {
            margin-bottom: 30px;
        }

        .intro h2 {
            margin: 0 0 9px;
            font-size: clamp(25px, 4vw, 32px);
            font-weight: 800;
            letter-spacing: -1px;
        }

        .intro h2 span {
            color: var(--red);
        }

        .intro p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .status-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-height: 290px;
            padding: 25px;
            overflow: hidden;
            border: 2px solid var(--border);
            border-radius: 16px;
            background: var(--white);
            transition: transform .2s, border-color .2s, box-shadow .2s;
        }

        .status-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--red);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .25s;
        }

        .status-card:hover {
            transform: translateY(-5px);
            border-color: var(--red);
            box-shadow: 0 12px 30px rgba(0, 0, 0, .09);
        }

        .status-card:hover::after {
            transform: scaleX(1);
        }

        .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 28px;
        }

        .status-icon {
            width: 55px;
            height: 55px;
            display: grid;
            place-items: center;
            border: 2px solid #f0c6ca;
            border-radius: 13px;
            background: #fff0f1;
            color: var(--red);
            font-size: 22px;
        }

        .status-label {
            padding: 7px 10px;
            border: 1px solid #f0b5bb;
            border-radius: 6px;
            background: #fff0f1;
            color: var(--red-dark);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .status-card h3 {
            margin: 0 0 10px;
            color: var(--black);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.4px;
        }

        .status-card p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.9;
        }

        .card-bottom {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 12px;
            margin-top: auto;
            padding-top: 27px;
        }

        .count-label {
            display: block;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 11px;
        }

        .count-number {
            color: var(--red);
            font-size: 36px;
            font-weight: 800;
            line-height: 1;
        }

        .open-icon {
            width: 41px;
            height: 41px;
            display: grid;
            place-items: center;
            border: 2px solid var(--border);
            border-radius: 10px;
            background: var(--white);
            color: var(--black);
            transition: .2s;
        }

        .status-card:hover .open-icon {
            background: var(--red);
            border-color: var(--red);
            color: var(--white);
        }

        .status-card.pending .status-icon,
        .status-card.delivery .status-icon {
            background: #fff0f1;
            border-color: #f0c6ca;
            color: var(--red);
        }

        .status-card.preparing .status-icon {
            background: #f2f2f2;
            border-color: #d0d0d0;
            color: var(--black);
        }

        .footer {
            padding-top: 32px;
            color: #777777;
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 850px) {
            .status-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .status-card {
                min-height: 245px;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 14px 15px;
                gap: 10px;
            }

            h1 {
                font-size: 18px;
            }

            .subtitle {
                font-size: 10px;
            }

            .back-btn {
                width: 39px;
                height: 39px;
            }

            .new-order {
                width: 42px;
                height: 42px;
                padding: 0;
            }

            .new-order span {
                display: none;
            }

            .container {
                padding: 30px 15px;
            }

            .status-card {
                padding: 21px;
            }

            .intro {
                margin-bottom: 24px;
            }
        }
    </style>
</head>

<body>

<header class="header">
    <div class="header-left">
        <a href="{{ route('admin.dashboard') }}"
           class="back-btn"
           aria-label="Back to dashboard">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div>
            <h1>Order Management</h1>
            <p class="subtitle">AL SALAMA · Orders Control Center</p>
        </div>
    </div>

    <a href="{{ route('admin.orders.create') }}" class="new-order">
        <i class="fa-solid fa-plus"></i>
        <span>New Order</span>
    </a>
</header>

<main class="container">

    <div class="intro">
        <h2>Manage Your <span>Orders</span></h2>
        <p>Choose an order status to view and manage its orders.</p>
    </div>

    <div class="status-grid">

        <!-- PENDING ORDERS -->
        <a href="{{ route('admin.orders.status', ['status' => 'pending']) }}"
           class="status-card pending">

            <div class="card-top">
                <div class="status-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <span class="status-label">Needs Attention</span>
            </div>

            <h3>Pending Orders</h3>

            <p>
                Review new orders, check customer details, and accept
                orders before preparation begins.
            </p>

            <div class="card-bottom">
                <div>
                    <span class="count-label">Waiting for action</span>
                    <strong class="count-number">{{ $pendingCount }}</strong>
                </div>

                <span class="open-icon">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </div>
        </a>

        <!-- PREPARING ORDERS -->
        <a href="{{ route('admin.orders.status', ['status' => 'preparing']) }}"
           class="status-card preparing">

            <div class="card-top">
                <div class="status-icon">
                    <i class="fa-solid fa-fire-burner"></i>
                </div>

                <span class="status-label">In Progress</span>
            </div>

            <h3>Preparing Orders</h3>

            <p>
                Track orders currently being prepared by the kitchen
                and manage their progress.
            </p>

            <div class="card-bottom">
                <div>
                    <span class="count-label">Currently in preparation</span>
                    <strong class="count-number">{{ $preparingCount }}</strong>
                </div>

                <span class="open-icon">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </div>
        </a>

        <!-- OUT FOR DELIVERY -->
        <a href="{{ route('admin.orders.status', ['status' => 'out_for_delivery']) }}"
           class="status-card delivery">

            <div class="card-top">
                <div class="status-icon">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>

                <span class="status-label">On The Way</span>
            </div>

            <h3>Out for Delivery</h3>

            <p>
                View delivery orders that have left the restaurant
                and follow up on their progress.
            </p>

            <div class="card-bottom">
                <div>
                    <span class="count-label">Awaiting delivery</span>
                    <strong class="count-number">{{ $deliveryCount }}</strong>
                </div>

                <span class="open-icon">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </div>
        </a>

    </div>

    <div class="footer">
        AL SALAMA · Order Management System
    </div>

</main>

</body>
</html>
