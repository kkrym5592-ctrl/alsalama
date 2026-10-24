<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إدارة الورديات | AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css"
          rel="stylesheet">

    <style>
        :root {
            --bg: #050914;
            --panel: #0b1222;
            --panel-2: #101a2e;
            --red: #e63946;
            --red-hover: #c92535;
            --text: #f4f6fb;
            --muted: #929bad;
            --border: rgba(255,255,255,.08);
            --green: #4ade80;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        .page {
            max-width: 1600px;
            margin: auto;
            padding: 28px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
            margin-bottom: 28px;
        }

        .brand {
            color: var(--red);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 3px;
            margin-bottom: 8px;
        }

        .page-title {
            font-size: 29px;
            font-weight: 800;
            margin: 0 0 8px;
        }

        .muted { color: var(--muted); }

        .btn-custom {
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 11px 17px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s;
            cursor: pointer;
        }

        .btn-dashboard {
            background: var(--panel-2);
            color: var(--text);
        }

        .btn-dashboard:hover {
            color: white;
            background: #1a2944;
        }

        .btn-open {
            background: var(--green);
            color: #05210f;
            border-color: var(--green);
        }

        .btn-open:hover {
            background: #22c55e;
            color: #05210f;
        }

        .btn-close-day {
            background: var(--red);
            color: white;
            border-color: var(--red);
        }

        .btn-close-day:hover {
            background: var(--red-hover);
            color: white;
        }

        .btn-custom:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .panel, .stat-card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 17px;
        }

        .stat-card {
            padding: 21px;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            right: 0;
            top: 18px;
            bottom: 18px;
            width: 3px;
            background: var(--red);
            border-radius: 5px;
        }

        .stat-label {
            color: #aab3c5;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 29px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(230,57,70,.13);
            color: var(--red);
            font-size: 21px;
        }

        .panel { overflow: hidden; }

        .panel-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 17px;
            font-weight: 800;
        }

        .panel-body { padding: 20px; }

        .table-responsive { width: 100%; }

        .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--text);
            --bs-table-border-color: var(--border);
            margin: 0;
            vertical-align: middle;
        }

        .table thead th {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            padding: 16px;
            background: rgba(255,255,255,.015);
        }

        .table tbody td { padding: 16px; }

        .table tbody tr:hover {
            background: rgba(255,255,255,.025);
        }

        .status-pill {
            display: inline-block;
            border-radius: 30px;
            padding: 7px 11px;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-open {
            color: var(--green);
            background: rgba(74,222,128,.12);
        }

        .status-closed {
            color: #aab3c5;
            background: rgba(148,163,184,.12);
        }

        .status-cancelled {
            color: #ff7b86;
            background: rgba(230,57,70,.13);
        }

        .empty-state {
            padding: 35px 15px !important;
            text-align: center;
            color: var(--muted);
        }

        .shift-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .alert {
            border-radius: 12px;
        }

        .alert-success {
            color: #bbf7d0;
            background: rgba(34,197,94,.12);
            border-color: rgba(34,197,94,.25);
        }

        .alert-danger {
            color: #fecaca;
            background: rgba(230,57,70,.12);
            border-color: rgba(230,57,70,.25);
        }

        .pagination {
            justify-content: center;
            margin: 0;
            gap: 4px;
        }

        .page-link {
            background: var(--panel-2);
            border-color: var(--border);
            color: white;
        }

        .page-link:hover {
            background: var(--red);
            border-color: var(--red);
            color: white;
        }

        .page-item.active .page-link {
            background: var(--red);
            border-color: var(--red);
        }

        .page-item.disabled .page-link {
            background: var(--panel);
            border-color: var(--border);
            color: #697386;
        }

        .modal-content {
            background: var(--panel);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .modal-header, .modal-footer {
            border-color: var(--border);
        }

        .btn-close { filter: invert(1); }

        @media (max-width: 768px) {
            .page { padding: 17px 12px; }
            .page-title { font-size: 23px; }
            .stat-card { padding: 17px; }
            .stat-value { font-size: 24px; }
            .panel-header, .panel-body { padding: 15px; }
            .table thead th, .table tbody td {
                padding: 13px 11px;
            }
            .topbar-actions { width: 100%; }
            .topbar-actions .btn-custom { flex: 1; }
        }
    </style>
</head>

<body>
<div class="page">

    {{-- Header --}}
    <header class="topbar">
        <div>
            <div class="brand">AL SALAMA / MANAGEMENT</div>
            <h1 class="page-title">إدارة الورديات</h1>
            <div class="muted">إدارة يوم العمل ومتابعة الطلبات وسجل الورديات.</div>
        </div>

        <div class="d-flex flex-wrap gap-2 topbar-actions">
            <a href="{{ url('/admin/dashboard') }}" class="btn-custom btn-dashboard">
                <span>←</span>
                الرجوع للوحة التحكم
            </a>

            @if($todayShift && $todayShift->status === 'open')
                <button type="button"
                        class="btn-custom btn-close-day"
                        data-bs-toggle="modal"
                        data-bs-target="#closeShiftModal">
                    إغلاق اليوم
                </button>
            @else
                <form method="POST" action="{{ route('admin.shifts.open') }}">
                    @csrf
                    <button type="submit" class="btn-custom btn-open">
                        + فتح يوم جديد
                    </button>
                </form>
            @endif
        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Current Shift Status --}}
    <div class="panel mb-4">
        <div class="panel-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <div class="muted small mb-2">حالة يوم العمل</div>

                @if($todayShift && $todayShift->status === 'open')
                    <span class="status-pill status-open">● اليوم مفتوح لاستقبال الطلبات</span>
                    <div class="muted small mt-2">
                        بدأ في:
                        {{ $todayShift->opened_at?->format('Y-m-d H:i') ?? '—' }}
                    </div>
                @else
                    <span class="status-pill status-closed">● لا يوجد يوم عمل مفتوح</span>
                    <div class="muted small mt-2">
                        افتح يوم العمل قبل تسجيل طلبات جديدة.
                    </div>
                @endif
            </div>

            <div class="text-end">
                <div class="muted small mb-1">تاريخ اليوم</div>
                <div class="fw-bold">{{ now()->format('Y-m-d') }}</div>
            </div>
        </div>
    </div>

    {{-- Statistics --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="stat-label mb-0">حالة الوردية</div>
                    <div class="stat-icon">◷</div>
                </div>

                <div class="stat-value">
                    @if($todayShift && $todayShift->status === 'open')
                        <span style="color:var(--green)">مفتوحة</span>
                    @else
                        <span style="color:var(--red)">مغلقة</span>
                    @endif
                </div>

                <div class="muted small mt-2">
                    {{ $todayShift?->opened_at?->format('H:i') ?? '—' }}
                    وقت بداية الوردية
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="stat-label mb-0">طلبات الوردية</div>
                    <div class="stat-icon">▤</div>
                </div>

                <div class="stat-value">
                    {{ number_format($todayOrderCount) }}
                </div>

                <div class="muted small mt-2">إجمالي طلبات الوردية الحالية</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="stat-label mb-0">رقم الطلب التالي</div>
                    <div class="stat-icon">#</div>
                </div>

                <div class="stat-value" style="color:var(--red)">
                    {{ number_format($nextOrderNumber) }}
                </div>

                <div class="muted small mt-2">يبدأ الترقيم من 1 لكل وردية</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="stat-label mb-0">بداية الوردية</div>
                    <div class="stat-icon">▣</div>
                </div>

                <div class="stat-value" style="font-size:22px">
                    {{ $todayShift?->opened_at?->format('Y-m-d') ?? '—' }}
                </div>

                <div class="muted small mt-2">
                    {{ $todayShift?->opened_at?->format('H:i:s') ?? '—' }}
                </div>
            </div>
        </div>

    </div>

    {{-- Current Shift Orders --}}
    <div class="panel mb-4">
        <div class="panel-header">
            <span>طلبات الوردية الحالية</span>
            <span class="muted small">
                {{ number_format($todayOrderCount) }} طلب
            </span>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>العميل</th>
                        <th>نوع الطلب</th>
                        <th>الإجمالي</th>
                        <th>الحالة</th>
                        <th>وقت الطلب</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="fw-bold" style="color:var(--red)">
                                #{{ $order->daily_order_number ?? $order->id }}
                            </td>

                            <td>{{ $order->user?->name ?? 'عميل غير محدد' }}</td>

                            <td>
                                @if($order->order_type === 'delivery')
                                    توصيل
                                @elseif($order->order_type === 'pickup')
                                    استلام
                                @else
                                    {{ $order->order_type ?? '—' }}
                                @endif
                            </td>

                            <td class="fw-bold">
                                {{ number_format((float)$order->total, 2) }}
                            </td>

                            <td>
                                @php
                                    $statusLabels = [
                                        'pending' => 'جديد',
                                        'preparing' => 'قيد التجهيز',
                                        'out_for_delivery' => 'خرج للتوصيل',
                                        'completed' => 'مكتمل',
                                        'delivered' => 'تم التسليم',
                                        'cancelled' => 'ملغي',
                                    ];

                                    $isCancelled = $order->status === 'cancelled';
                                    $isCompleted = in_array(
                                        $order->status,
                                        ['completed', 'delivered'],
                                        true
                                    );
                                @endphp

                                <span class="status-pill
                                    {{ $isCancelled ? 'status-cancelled' : ($isCompleted ? 'status-closed' : 'status-open') }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </td>

                            <td>
                                {{ $order->created_at?->format('H:i') ?? '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                لا توجد طلبات مسجلة في هذه الوردية حتى الآن.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-3">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    {{-- Shift History --}}
    <div class="panel">
        <div class="panel-header">
            <span>سجل الورديات السابقة</span>
            <span class="muted small">تاريخ أيام العمل</span>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>رقم الوردية</th>
                        <th>تاريخ البداية</th>
                        <th>تاريخ الإغلاق</th>
                        <th>عدد الطلبات</th>
                        <th>الحالة</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($shifts as $shift)
                        <tr>
                            <td class="fw-bold" style="color:var(--red)">
                                #{{ $shift->id }}
                            </td>

                            <td>
                                {{ $shift->opened_at?->format('Y-m-d H:i') ?? '—' }}
                            </td>

                            <td>
                                {{ $shift->closed_at?->format('Y-m-d H:i') ?? '—' }}
                            </td>

                            <td>{{ number_format($shift->orders_count) }}</td>

                            <td>
                                <span class="status-pill
                                    {{ $shift->status === 'open' ? 'status-open' : 'status-closed' }}">
                                    {{ $shift->status === 'open' ? 'مفتوحة' : 'مغلقة' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                لا توجد ورديات مسجلة حتى الآن.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($shifts->hasPages())
            <div class="p-3">
                {{ $shifts->links() }}
            </div>
        @endif
    </div>

</div>

{{-- Close Shift Confirmation --}}
@if($todayShift && $todayShift->status === 'open')
    <div class="modal fade" id="closeShiftModal" tabindex="-1"
         aria-labelledby="closeShiftModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="closeShiftModalLabel">
                        إغلاق يوم العمل؟
                    </h5>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-2">
                        هل أنت متأكد أنك تريد إغلاق يوم العمل الحالي؟
                    </p>

                    <div class="muted small">
                        بعد الإغلاق لن يمكن إنشاء طلبات جديدة حتى تفتح يوم عمل جديد.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-custom btn-dashboard"
                            data-bs-dismiss="modal">
                        إلغاء
                    </button>

                    <form method="POST" action="{{ route('admin.shifts.close', $todayShift) }}">
                        @csrf

                        <button type="submit" class="btn-custom btn-close-day">
                            تأكيد إغلاق اليوم
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
