<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kitchen Receipt - AL SALAMA</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 15px;
            background: #fff;
            color: #000;
            font-family: Arial, Helvetica, sans-serif;
        }

        .receipt {
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }

        .header h1 {
            font-size: 25px;
            margin: 0 0 5px;
            font-weight: 900;
        }

        .header h2 {
            font-size: 17px;
            margin: 0;
            letter-spacing: 2px;
        }

        .order-info {
            font-size: 14px;
            line-height: 1.7;
            border-bottom: 2px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .order-info strong {
            font-weight: 900;
        }

        .items-title {
            text-align: center;
            font-size: 17px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #000;
        }

        .product-name {
            flex: 1;
            font-size: 16px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .quantity {
            min-width: 65px;
            text-align: right;
            font-size: 23px;
            font-weight: 900;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px dashed #000;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin: 20px auto;
            max-width: 320px;
        }

        .actions button {
            flex: 1;
            padding: 12px 8px;
            border: 0;
            border-radius: 5px;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .print-btn {
            background: #198754;
        }

        .create-btn {
            background: #0d6efd;
        }

        @media print {
            @page {
                size: 80mm auto;
                margin: 4mm;
            }

            body {
                padding: 0;
                margin: 0;
            }

            .receipt {
                width: 100%;
                max-width: none;
            }

            .actions {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="receipt">

        <div class="header">
            <h1>AL SALAMA</h1>
            <h2>KITCHEN ORDER</h2>
        </div>

        <div class="order-info">
            <div>
                <strong>Order #:</strong>
                {{ $order->id }}
            </div>

            <div>
                <strong>Customer:</strong>
                {{ $order->user->name ?? 'Walk-in Customer' }}
            </div>

            <div>
                <strong>Date:</strong>
                {{ $order->created_at?->timezone(config('app.timezone'))->format('d/m/Y h:i A') }}
            </div>

            <div>
                <strong>Order Type:</strong>
                {{ ucfirst($order->order_type) }}
            </div>
        </div>

        <div class="items-title">ORDER ITEMS</div>

        @foreach ($order->items as $item)
            <div class="item">
                <div class="product-name">
                    {{ $item->product->name ?? 'Unknown Product' }}
                </div>

                <div class="quantity">
                    × {{ $item->quantity }}
                </div>
            </div>
        @endforeach

        <div class="footer">
            AL SALAMA — Kitchen Copy
        </div>

    </div>

    <div class="actions">
        <button class="print-btn" type="button" onclick="printReceipt()">
            Print Receipt
        </button>

        <button class="create-btn" type="button" onclick="goToCreate()">
            New Order
        </button>
    </div>

    <script>
        const createOrderUrl = @json(route('admin.orders.create'));
        const ordersIndexUrl = @json(route('admin.orders.index'));

        let redirectStarted = false;
        let printStarted = false;

        /*
         * Redirect according to the requested workflow:
         * kitchen  -> orders.index
         * confirm  -> orders.create
         */
        function redirectAfterPrint() {
            if (redirectStarted) return;

            redirectStarted = true;

            const params = new URLSearchParams(window.location.search);
            const destination = params.get('return_to');

            if (destination === 'create') {
                window.location.replace(createOrderUrl);
            } else {
                window.location.replace(ordersIndexUrl);
            }
        }

        function goToCreate() {
            if (redirectStarted) return;

            redirectStarted = true;
            window.location.href = createOrderUrl;
        }

        function printReceipt() {
            if (printStarted) return;

            printStarted = true;
            window.print();
        }

        /*
         * When the print dialog closes, redirect to the appropriate page.
         */
        window.addEventListener('afterprint', function () {
            redirectAfterPrint();
        });

        /*
         * Automatically print when URL contains ?print=1.
         */
        window.addEventListener('load', function () {
            const params = new URLSearchParams(window.location.search);

            if (params.get('print') === '1') {
                setTimeout(function () {
                    printReceipt();
                }, 300);
            }
        });
    </script>

</body>
</html>
