<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AL SALAMA - Receipt #{{ $order->id }}</title>

    <style>
        :root {
            --red: #e63946;
            --dark: #202124;
            --muted: #666;
            --line: #dedede;
            --light: #f7f7f7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 24px 12px;
            background: #eeeeee;
            color: var(--dark);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            line-height: 1.5;
        }

        .receipt {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
            padding: 25px 22px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .08);
        }

        .brand {
            text-align: center;
            padding-bottom: 18px;
        }

        .brand-name {
            margin: 0;
            color: var(--red);
            font-size: 30px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .brand-tagline {
            margin: 3px 0 0;
            color: var(--muted);
            font-size: 11px;
            letter-spacing: .5px;
        }

        .receipt-title {
            margin-top: 15px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .order-badge {
            display: inline-block;
            margin-top: 7px;
            padding: 5px 12px;
            border-radius: 20px;
            background: #fff0f1;
            color: var(--red);
            font-weight: 700;
            font-size: 12px;
        }

        .divider {
            margin: 17px 0;
            border: 0;
            border-top: 1px dashed #cfcfcf;
        }

        .section-title {
            margin: 0 0 11px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--red);
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin: 8px 0;
        }

        .info-label {
            flex: 0 0 105px;
            color: var(--muted);
        }

        .info-value {
            flex: 1;
            text-align: right;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .person-card {
            padding: 12px;
            margin: 10px 0;
            background: var(--light);
            border: 1px solid #ededed;
            border-radius: 8px;
        }

        .person-name {
            margin-bottom: 4px;
            font-weight: 700;
            font-size: 14px;
        }

        .person-detail {
            color: var(--muted);
            overflow-wrap: anywhere;
        }

        .person-detail + .person-detail {
            margin-top: 3px;
        }

        .person-detail a {
            color: inherit;
            text-decoration: none;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table th {
            padding: 9px 4px;
            background: var(--light);
            color: #444;
            font-size: 11px;
            text-transform: uppercase;
            text-align: left;
        }

        .items-table td {
            padding: 11px 4px;
            border-bottom: 1px solid #eeeeee;
            vertical-align: top;
        }

        .items-table th:last-child,
        .items-table td:last-child {
            text-align: right;
        }

        .items-table th:nth-child(2),
        .items-table td:nth-child(2) {
            text-align: center;
            width: 45px;
        }

        .product-name {
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin: 9px 0;
        }

        .summary-label {
            color: var(--muted);
        }

        .summary-value {
            font-weight: 600;
            text-align: right;
        }

        .total-row {
            margin-top: 14px;
            padding: 13px 12px;
            background: #fff0f1;
            border-radius: 8px;
            color: var(--red);
            font-size: 17px;
            font-weight: 800;
        }

        .footer {
            padding-top: 12px;
            text-align: center;
        }

        .footer-title {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
        }

        .footer-message {
            margin: 5px 0 0;
            color: var(--muted);
            font-size: 11px;
        }

        .footer-line {
            width: 45px;
            height: 3px;
            margin: 13px auto 0;
            background: var(--red);
            border-radius: 5px;
        }

        .no-print {
            display: block;
            max-width: 420px;
            margin: 15px auto 0;
            text-align: center;
        }

        .print-button {
            padding: 11px 24px;
            border: none;
            border-radius: 7px;
            background: var(--red);
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        @media print {
            @page {
                size: 80mm auto;
                margin: 4mm;
            }

            body {
                padding: 0;
                margin: 0;
                background: #fff;
                font-size: 11px;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .receipt {
                width: 100%;
                max-width: none;
                margin: 0;
                padding: 3mm 1mm;
                border-radius: 0;
                box-shadow: none;
            }

            .no-print {
                display: none !important;
            }

            .person-card,
            .total-row,
            .items-table th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .divider {
                margin: 12px 0;
            }

            .items-table tr {
                break-inside: avoid;
            }
        }
    </style>
</head>

<body>

@php
    $customer = $order->user;
    $deliveryPerson = $order->deliveryUser;
@endphp

<div class="receipt">

    {{-- BRAND --}}
    <header class="brand">
        <h1 class="brand-name">AL SALAMA</h1>
        <p class="brand-tagline">Fresh food. Made with care.</p>

        <div class="receipt-title">Order Receipt</div>

        <div class="order-badge">
            ORDER #{{ $order->id }}
        </div>
    </header>

    <hr class="divider">

    {{-- ORDER DETAILS --}}
    <section>
        <h2 class="section-title">Order Details</h2>

        <div class="info-row">
            <span class="info-label">Order Number</span>
            <span class="info-value">#{{ $order->id }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Order Type</span>
            <span class="info-value">
                {{ ucfirst($order->order_type ?? 'pickup') }}
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">Date</span>
            <span class="info-value">
                {{ $order->created_at?->format('d M Y, h:i A') ?? '—' }}
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">Payment</span>
            <span class="info-value">
                {{ ucfirst($order->payment_method ?? 'Cash') }}
            </span>
        </div>
    </section>

    <hr class="divider">

    {{-- CUSTOMER DETAILS --}}
    <section>
        <h2 class="section-title">Customer Information</h2>

        <div class="person-card">
            <div class="person-name">
                {{ $customer->name ?? 'Walk-in Customer' }}
            </div>

            <div class="person-detail">
                Phone:
                {{ $customer->phone ?? 'Not provided' }}
            </div>

            @if($order->order_type === 'delivery')
                <div class="person-detail">
                    Address:
                    {{ $customer->address ?? 'Not provided' }}
                </div>
            @endif
        </div>
    </section>

    {{-- DELIVERY PERSON --}}
    @if($order->order_type === 'delivery')
        <section>
            <h2 class="section-title">Delivery Information</h2>

            <div class="person-card">
                <div class="person-name">
                    {{ $deliveryPerson->name ?? 'Not assigned' }}
                </div>

                <div class="person-detail">
                    Phone:
                    @if($deliveryPerson && $deliveryPerson->phone)
                        <a href="tel:{{ $deliveryPerson->phone }}">
                            {{ $deliveryPerson->phone }}
                        </a>
                    @else
                        Not provided
                    @endif
                </div>
            </div>
        </section>
    @endif

    <hr class="divider">

    {{-- ORDER ITEMS --}}
    <section>
        <h2 class="section-title">Your Order</h2>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="product-name">
                                {{ $item->product->name ?? 'Product' }}
                            </div>
                        </td>

                        <td>{{ $item->quantity }}</td>

                        <td>
                            {{ number_format((float) $item->price * (int) $item->quantity, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <hr class="divider">

    {{-- TOTALS --}}
    <section>
        <div class="summary-row">
            <span class="summary-label">Subtotal</span>
            <span class="summary-value">
                {{ number_format((float) $order->subtotal, 2) }}
            </span>
        </div>

        @if($order->order_type === 'delivery')
            <div class="summary-row">
                <span class="summary-label">Delivery Fee</span>
                <span class="summary-value">
                    {{ number_format((float) $order->delivery_fee, 2) }}
                </span>
            </div>
        @endif

        <div class="summary-row total-row">
            <span>Total</span>
            <span>
                {{ number_format((float) $order->total, 2) }}
            </span>
        </div>
    </section>

    @if(!empty($order->notes))
        <hr class="divider">

        <section>
            <h2 class="section-title">Order Notes</h2>
            <p>{{ $order->notes }}</p>
        </section>
    @endif

    {{-- FOOTER --}}
    <footer class="footer">
        <p class="footer-title">Enjoy Your Meal!</p>
        <p class="footer-message">
            Thank you for choosing AL SALAMA.
        </p>
        <p class="footer-message">
            We appreciate your order ❤️
        </p>
        <div class="footer-line"></div>
    </footer>

</div>

<div class="no-print">
    <button class="print-button" onclick="window.print()">
        Print Receipt
    </button>
</div>

<script>
    window.addEventListener('load', function () {
        window.print();
    });
</script>

</body>
</html>
