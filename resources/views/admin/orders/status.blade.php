<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle ?? 'Orders' }} - AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --bg: #ffffff;
            --card: #ffffff;
            --border: #cccccc;
            --black: #111111;
            --red: #e63946;
            --red-dark: #c92735;
            --muted: #666666;
            --light: #f6f6f6;
            --green: #198754;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--black);
            font-family: Arial, sans-serif;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--black);
        }

        .brand {
            color: var(--red);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .page-header h2 {
            font-weight: 800;
        }

        .order-card {
            position: relative;
            background: var(--card);
            border: 2px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 18px;
            cursor: pointer;
            transition: .2s;
        }

        .order-card:hover {
            border-color: var(--red);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .07);
            transform: translateY(-2px);
        }

        .order-number {
            color: var(--red);
            font-weight: 800;
            font-size: 20px;
        }

        .order-info {
            color: var(--muted);
            font-size: 13px;
            line-height: 2;
            overflow-wrap: anywhere;
        }

        .order-total {
            font-size: 21px;
            font-weight: 800;
            color: var(--black);
            white-space: nowrap;
        }

        .status-badge {
            display: inline-block;
            padding: 7px 11px;
            border: 1px solid #e6b7bb;
            border-radius: 7px;
            background: #fff0f1;
            color: var(--red-dark);
            font-size: 11px;
            font-weight: 800;
        }

        .order-type {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 6px;
            background: var(--light);
            border: 1px solid #dddddd;
            color: var(--black);
            font-size: 11px;
            font-weight: 700;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid #e5e5e5;
        }

        .actions form {
            display: inline-flex;
            margin: 0;
        }

        .actions .btn {
            min-height: 39px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            padding: 9px 15px;
        }

        .btn-confirm {
            background: var(--green);
            color: #fff;
            border: 2px solid var(--green);
        }

        .btn-confirm:hover {
            background: #146c43;
            border-color: #146c43;
            color: #fff;
        }

        .btn-cancel {
            background: var(--red);
            color: #fff;
            border: 2px solid var(--red);
        }

        .btn-cancel:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
            color: #fff;
        }

        .btn-black {
            background: var(--black);
            color: #fff;
            border: 2px solid var(--black);
        }

        .btn-black:hover {
            background: #333;
            border-color: #333;
            color: #fff;
        }

        .btn-outline-custom {
            background: #fff;
            color: var(--black);
            border: 2px solid var(--black);
        }

        .btn-outline-custom:hover {
            background: var(--black);
            color: #fff;
        }

        .empty-state {
            background: #fff;
            border: 2px dashed var(--border);
            border-radius: 14px;
            padding: 45px 20px;
            text-align: center;
            color: var(--muted);
        }

        .empty-state i {
            color: var(--red);
            font-size: 35px;
            margin-bottom: 15px;
        }

        .alert {
            border-radius: 10px;
        }

        @media (max-width: 576px) {
            .order-card {
                padding: 15px;
            }

            .order-total {
                font-size: 18px;
            }

            .actions .btn {
                width: 100%;
            }

            .actions form {
                flex: 1 1 100%;
            }

            .actions form .btn {
                width: 100%;
            }

            .page-header .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container py-4 py-md-5">

        <div class="page-header">
            <div>
                <div class="brand mb-2">AL SALAMA</div>

                <h2 class="mb-1">
                    {{ $pageTitle ?? 'Orders' }}
                </h2>

                <div class="text-secondary small">
                    عدد الطلبات: {{ $orders->count() }}
                </div>
            </div>

            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-custom">
                <i class="fa-solid fa-arrow-right ms-1"></i>
                لوحة الطلبات
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @forelse($orders as $order)

            <div class="order-card" onclick="window.location.href='{{ route('admin.orders.show', $order) }}'">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                    <div>
                        <div class="order-number mb-2">
                            طلب #{{ $order->id }}
                        </div>

                        <div class="fw-bold mb-1">
                            {{ $order->user->name ?? 'Walk-in Customer' }}
                        </div>

                        <div class="order-info">
                            <div>
                                نوع الطلب:
                                <span class="order-type">
                                    {{ $order->order_type === 'delivery' ? 'Delivery' : 'Pickup' }}
                                </span>
                            </div>

                            <div>
                                طريقة الدفع:
                                {{ ucfirst($order->payment_method ?? 'cash') }}
                            </div>

                            <div>
                                وقت الطلب:
                                {{ $order->created_at?->format('Y-m-d h:i A') }}
                            </div>

                            @if($order->order_type === 'delivery')
                                <div>
                                    المندوب:
                                    {{ $order->deliveryUser->name ?? 'لم يتم تعيين مندوب' }}
                                </div>

                                <div>
                                    رسوم التوصيل:
                                    {{ number_format((float) ($order->delivery_fee ?? 0), 2) }}
                                    EGP
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-start">
                        <span class="status-badge">
                            {{ strtoupper(str_replace('_', ' ', $order->status)) }}
                        </span>

                        <div class="order-total mt-3">
                            {{ number_format((float) $order->total, 2) }}
                            <small>EGP</small>
                        </div>
                    </div>

                </div>

                @if($order->items->isNotEmpty())
                    <div class="order-info mt-3">
                        <strong style="color:#111">المنتجات:</strong>

                        @foreach($order->items as $item)
                            <span>
                                {{ $item->product->name ?? 'Product' }}
                                × {{ $item->quantity }}
                            </span>@if(!$loop->last)، @endif
                        @endforeach
                    </div>
                @endif

                <div class="actions" onclick="event.stopPropagation()">

                    {{-- EDIT: AVAILABLE FOR ALL ORDER STATUSES --}}
                    <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-cancel"
                        onclick="event.stopPropagation()">
                        <i class="fa-solid fa-pen ms-1"></i>
                        Edit
                    </a>

                    {{-- PENDING --}}
                    @if($status === 'pending' && $order->status === 'pending')

                        @if($order->order_type === 'delivery')

                            <a href="{{ route('admin.orders.confirmDelivery', $order) }}" class="btn btn-confirm">
                                <i class="fa-solid fa-check ms-1"></i>
                                Confirm
                            </a>

                        @else

                            <form method="POST" action="{{ route('admin.orders.confirm', $order) }}"
                                onsubmit="return confirm('Confirm this pickup order?')">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-confirm">
                                    <i class="fa-solid fa-check ms-1"></i>
                                    Confirm
                                </button>
                            </form>

                        @endif

                        <form method="POST" action="{{ route('admin.orders.cancel', $order) }}"
                            onsubmit="return confirm('Cancel this order?')">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-cancel">
                                <i class="fa-solid fa-xmark ms-1"></i>
                                Cancel
                            </button>
                        </form>

                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-custom">
                            <i class="fa-solid fa-eye ms-1"></i>
                            View Details
                        </a>

                        <a href="{{ route('admin.orders.kitchen-receipt', $order) }}" class="btn btn-black"
                            onclick="event.stopPropagation()">
                            <i class="fa-solid fa-print ms-1"></i>
                            Kitchen Print
                        </a>

                        {{-- PREPARING --}}
                    @elseif($status === 'preparing' && $order->status === 'preparing')

                        <a href="{{ route('admin.orders.kitchen-receipt', $order) }}" class="btn btn-black">
                            <i class="fa-solid fa-print ms-1"></i>
                            Kitchen Print
                        </a>

                        <form method="POST" action="{{ route('admin.orders.cancelActive', $order) }}"
                            onsubmit="return confirm('Cancel this order?')">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-cancel">
                                <i class="fa-solid fa-xmark ms-1"></i>
                                Cancel
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.orders.completePreparing', $order) }}"
                            onsubmit="return confirm('Complete this order and print its receipt?')">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-confirm">
                                <i class="fa-solid fa-check-double ms-1"></i>
                                Complete & Print Receipt
                            </button>
                        </form>

                        {{-- OUT FOR DELIVERY --}}
                    @elseif($status === 'out_for_delivery' && $order->status === 'out_for_delivery')

                        <form method="POST" action="{{ route('admin.orders.cancelActive', $order) }}"
                            onsubmit="return confirm('Cancel this delivery order?')">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-cancel">
                                <i class="fa-solid fa-xmark ms-1"></i>
                                Cancel
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.orders.delivered', $order) }}"
                            onsubmit="return confirm('Mark this order as delivered?')">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-confirm">
                                <i class="fa-solid fa-check ms-1"></i>
                                Done
                            </button>
                        </form>

                        {{-- OTHER STATUS --}}
                    @else

                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-custom">
                            <i class="fa-solid fa-eye ms-1"></i>
                            View Details
                        </a>

                    @endif

                </div>

            </div>

        @empty

            <div class="empty-state">
                <i class="fa-regular fa-clipboard d-block"></i>

                <h4 class="mb-2">لا توجد طلبات</h4>

                <p class="mb-0">
                    لا توجد طلبات في هذه الحالة حاليًا.
                </p>
            </div>

        @endforelse

    </div>

</body>

</html>