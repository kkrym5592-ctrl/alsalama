<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الحسابات | AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #050914;
            --panel: #0b1222;
            --panel2: #101a2e;
            --red: #e63946;
            --red-hover: #c92e3a;
            --text: #f4f6fb;
            --muted: #929bad;
            --border: rgba(255,255,255,.08);
            --green: #4ade80;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
        }

        .topbar {
            background: #080e1b;
            border-bottom: 1px solid var(--border);
            padding: 18px 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-weight: 800;
            font-size: 21px;
            text-decoration: none;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            border-radius: 13px;
            background: var(--red);
            display: grid;
            place-items: center;
            box-shadow: 0 5px 22px rgba(230,57,70,.2);
        }

        .page {
            max-width: 1500px;
            margin: auto;
            padding: 32px 22px 55px;
        }

        .page-title {
            font-size: clamp(23px, 3vw, 31px);
            font-weight: 800;
            margin: 0 0 7px;
        }

        .muted { color: var(--muted); }

        .panel, .stat-card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
        }

        .panel-header {
            padding: 20px 23px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            font-weight: 800;
        }

        .panel-body { padding: 23px; }

        .stat-card {
            padding: 22px;
            height: 100%;
            transition: transform .2s, border-color .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(230,57,70,.4);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: rgba(230,57,70,.12);
            color: var(--red);
            font-size: 19px;
        }

        .stat-label {
            color: #aab3c5;
            font-size: 14px;
            margin-top: 18px;
        }

        .stat-value {
            font-size: clamp(24px, 3vw, 32px);
            font-weight: 800;
            overflow-wrap: anywhere;
            margin-top: 5px;
        }

        .form-label {
            color: #d9deea;
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .form-control, .form-select {
            background-color: var(--panel2);
            color: white;
            border: 1px solid rgba(255,255,255,.12);
            min-height: 47px;
            border-radius: 11px;
        }

        .form-control:focus, .form-select:focus {
            background-color: var(--panel2);
            color: white;
            border-color: var(--red);
            box-shadow: 0 0 0 .2rem rgba(230,57,70,.13);
        }

        .form-control::placeholder { color: #818da3; opacity: 1; }

        .form-control::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        .form-select option {
            background: var(--panel);
            color: white;
        }

        .btn-red {
            min-height: 47px;
            border: 0;
            border-radius: 11px;
            background: var(--red);
            color: white;
            font-weight: 800;
            padding: 10px 20px;
            transition: .2s;
        }

        .btn-red:hover {
            background: var(--red-hover);
            color: white;
        }

        .btn-dark-custom {
            min-height: 47px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: #182238;
            color: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            text-decoration: none;
            font-weight: 700;
        }

        .btn-dark-custom:hover {
            background: #202d45;
            color: white;
        }

        .period-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            padding: 9px 14px;
            background: rgba(230,57,70,.09);
            border: 1px solid rgba(230,57,70,.2);
            border-radius: 10px;
            color: #ff929a;
            font-size: 13px;
            font-weight: 700;
        }

        .table-responsive { width: 100%; }

        .table {
            --bs-table-bg: transparent;
            --bs-table-color: #e9edf5;
            --bs-table-border-color: rgba(255,255,255,.07);
            margin: 0;
            vertical-align: middle;
        }

        .table thead th {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            padding: 17px 18px;
            background: rgba(255,255,255,.015);
            border-bottom-width: 1px;
        }

        .table tbody td {
            padding: 17px 18px;
            white-space: nowrap;
        }

        .table tbody tr:hover td {
            background: rgba(255,255,255,.025);
        }

        .table tbody tr.order-row-clickable {
            cursor: pointer;
            transition: background-color .2s ease;
        }

        .table tbody tr.order-row-clickable:hover td {
            background: rgba(230,57,70,.10);
        }

        .order-row-clickable:focus-visible {
            outline: 2px solid var(--red);
            outline-offset: -2px;
        }

        .order-number {
            color: #ff7c86;
            font-weight: 800;
        }

        .status-pill {
            display: inline-block;
            border-radius: 30px;
            padding: 6px 11px;
            font-size: 12px;
            font-weight: 800;
        }

        .status-normal {
            color: #4ade80;
            background: rgba(74,222,128,.12);
        }

        .empty-state {
            text-align: center;
            padding: 55px 15px;
            color: var(--muted);
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 17px;
            border-radius: 20px;
            background: var(--panel2);
            display: grid;
            place-items: center;
            color: var(--red);
            font-size: 25px;
        }

        .pagination {
            margin: 0;
            gap: 5px;
            flex-wrap: wrap;
        }

        .page-link {
            background: var(--panel2);
            border-color: var(--border);
            color: white;
            border-radius: 8px !important;
        }

        .page-link:hover {
            background: #202d45;
            color: white;
            border-color: var(--border);
        }

        .page-item.active .page-link {
            background: var(--red);
            border-color: var(--red);
        }

        .page-item.disabled .page-link {
            background: var(--panel);
            color: #626d80;
            border-color: var(--border);
        }

        .footer-note {
            text-align: center;
            color: #69758a;
            font-size: 12px;
            margin-top: 25px;
        }

        @media (max-width: 767px) {
            .page { padding: 23px 13px 35px; }

            .panel-header, .panel-body { padding: 17px; }

            .stat-card { padding: 17px; }

            .table thead th, .table tbody td {
                padding: 14px 13px;
            }

            .brand { font-size: 18px; }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="container-fluid px-3 px-lg-4 d-flex justify-content-between align-items-center gap-3">
        <a href="{{ route('admin.accounts.index') }}" class="brand">
            <span class="brand-icon">
                <i class="fa-solid fa-utensils"></i>
            </span>
            <span>AL SALAMA</span>
        </a>

        <div class="d-flex align-items-center gap-3">
            <span class="muted small d-none d-md-inline">
                <i class="fa-solid fa-chart-line ms-1"></i>
                التقارير والحسابات
            </span>

            <a href="{{ route('admin.dashboard') }}" class="btn-dark-custom">
                <i class="fa-solid fa-arrow-right"></i>
                BACK
            </a>
        </div>
    </div>
</header>

<main class="page">

    {{-- عنوان الصفحة --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="page-title">إدارة الحسابات</h1>
            <div class="muted">
                حساب المبيعات حسب التاريخ والوردية للطلبات المكتملة أو التي تم توصيلها فقط.
            </div>
        </div>

        <div class="period-badge">
            <i class="fa-regular fa-calendar"></i>

            <span>
                من {{ \Illuminate\Support\Carbon::parse($dateFrom)->format('d/m/Y') }}
                إلى {{ \Illuminate\Support\Carbon::parse($dateTo)->format('d/m/Y') }}
            </span>

            @if($shiftId !== '')
                <span>| الوردية #{{ $shiftId }}</span>
            @else
                <span>| كل الورديات</span>
            @endif
        </div>
    </div>

    {{-- فلتر التاريخ والوردية --}}
    <section class="panel mb-4">
        <div class="panel-header">
            <span>
                <i class="fa-solid fa-calendar-days ms-2" style="color:var(--red)"></i>
                تحديد فترة الحسابات والوردية
            </span>
        </div>

        <div class="panel-body">
            <form method="GET" action="{{ route('admin.accounts.index') }}">
                <div class="row g-3 align-items-end">

                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="date_from" class="form-label">من تاريخ</label>
                        <input
                            type="date"
                            id="date_from"
                            name="date_from"
                            class="form-control"
                            value="{{ $dateFrom }}"
                            max="{{ $dateTo }}"
                            required
                        >
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="date_to" class="form-label">إلى تاريخ</label>
                        <input
                            type="date"
                            id="date_to"
                            name="date_to"
                            class="form-control"
                            value="{{ $dateTo }}"
                            min="{{ $dateFrom }}"
                            required
                        >
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="shift_id" class="form-label">الوردية</label>
                        <select name="shift_id" id="shift_id" class="form-select">
                            <option value="">كل الورديات</option>

                            @foreach($shifts as $shift)
                                <option
                                    value="{{ $shift->id }}"
                                    {{ (string) $shiftId === (string) $shift->id ? 'selected' : '' }}
                                >
                                    وردية #{{ $shift->id }}
                                    — {{ \Illuminate\Support\Carbon::parse($shift->opened_at)->format('d/m/Y h:i A') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 col-md-3 col-lg-1">
                        <button type="submit" class="btn btn-red w-100" title="تطبيق الفلتر">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                    </div>

                    <div class="col-6 col-md-3 col-lg-2">
                        <a href="{{ route('admin.accounts.index') }}" class="btn-dark-custom w-100">
                            <i class="fa-solid fa-rotate-right"></i>
                            اليوم
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </section>

    {{-- ملخص المبيعات --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>

                <div class="stat-label">إجمالي المبيعات المكتملة</div>

                <div class="stat-value" style="color:var(--green)">
                    {{ number_format((float) $totalSales, 2) }}
                    <span class="fs-6">ج.م</span>
                </div>

                <div class="muted small mt-2">
                    للطلبات المكتملة أو التي تم توصيلها فقط
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-receipt"></i>
                </div>

                <div class="stat-label">عدد الطلبات المكتملة</div>

                <div class="stat-value">
                    {{ number_format($totalOrders) }}
                </div>

                <div class="muted small mt-2">
                    الطلبات المكتملة أو التي تم توصيلها فقط
                </div>
            </div>
        </div>

    </div>

    {{-- جدول الطلبات --}}
    <section class="panel">

        <div class="panel-header">
            <span>
                <i class="fa-solid fa-list-ul ms-2" style="color:var(--red)"></i>
                تفاصيل الطلبات المكتملة
            </span>

            <span class="muted small">
                {{ number_format($orders->total()) }} طلب
            </span>
        </div>

        {{-- البحث --}}
        <div class="panel-body border-bottom" style="border-color:var(--border)!important">
            <form method="GET" action="{{ route('admin.accounts.index') }}">
                <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                <input type="hidden" name="date_to" value="{{ $dateTo }}">
                <input type="hidden" name="shift_id" value="{{ $shiftId }}">

                <div class="row g-3 align-items-end">

                    <div class="col-12 col-md-8 col-lg-9">
                        <label for="search" class="form-label">
                            البحث في بيانات الطلبات والعملاء
                        </label>

                        <input
                            type="search"
                            id="search"
                            name="search"
                            class="form-control"
                            value="{{ $search ?? '' }}"
                            placeholder="رقم الطلب، اسم العميل، user_name، الهاتف، نوع الطلب، order_kind، الدفع، التسوية..."
                        >

                        <small class="muted d-block mt-2">
                            اكتب كلمة أو رقمًا للبحث داخل النتائج المطابقة للفترة والوردية المحددتين.
                        </small>
                    </div>

                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn btn-red w-100">
                            <i class="fa-solid fa-magnifying-glass ms-1"></i>
                            بحث
                        </button>
                    </div>

                    <div class="col-6 col-md-2">
                        <a
                            href="{{ route('admin.accounts.index', [
                                'date_from' => $dateFrom,
                                'date_to' => $dateTo,
                                'shift_id' => $shiftId,
                            ]) }}"
                            class="btn-dark-custom w-100"
                        >
                            <i class="fa-solid fa-xmark"></i>
                            مسح البحث
                        </a>
                    </div>

                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">

                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>رقم الوردية</th>
                        <th>العميل</th>
                        <th>نوع الطلب</th>
                        <th>طريقة الدفع</th>
                        <th>الإجمالي</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                        <tr
                            class="order-row-clickable"
                            data-url="{{ route('admin.orders.show', $order->id) }}"
                            onclick="window.location.href = this.dataset.url"
                            onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); window.location.href = this.dataset.url; }"
                            title="اضغط لعرض تفاصيل الطلب"
                            tabindex="0"
                            role="link"
                        >
                            <td class="order-number">
                                #{{ $order->daily_order_number ?? $order->id }}
                            </td>

                            <td>
                                {{ $order->shift_id ? '#' . $order->shift_id : '—' }}
                            </td>

                            <td>
                                {{ $order->user?->name ?? 'عميل غير محدد' }}
                            </td>

                            <td>
                                {{ $order->order_type ?? '—' }}
                            </td>

                            <td>
                                {{ $order->payment_method ?? '—' }}
                            </td>

                            <td class="fw-bold">
                                {{ number_format((float) $order->total, 2) }} ج.م
                            </td>

                            <td>
                                <span class="status-pill status-normal">
                                    {{ $order->status === 'delivered' ? 'تم التوصيل' : 'مكتمل' }}
                                </span>
                            </td>

                            <td>
                                {{ $order->created_at?->format('d/m/Y') ?? '—' }}
                            </td>

                            <td>
                                {{ $order->created_at?->format('h:i A') ?? '—' }}
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fa-solid fa-receipt"></i>
                                    </div>

                                    <h5 class="text-white fw-bold mb-2">
                                        لا توجد طلبات مطابقة
                                    </h5>

                                    <p class="mb-0">
                                        لا توجد طلبات مكتملة أو تم توصيلها تطابق البحث والفترة والوردية المحددة.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-3 border-top" style="border-color:var(--border)!important">
                {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </section>

    <div class="footer-note">
        AL SALAMA — تقارير المبيعات والطلبات المكتملة
    </div>

</main>

<script>
    const dateFrom = document.getElementById('date_from');
    const dateTo = document.getElementById('date_to');

    dateFrom.addEventListener('change', function () {
        dateTo.min = this.value;

        if (dateTo.value && dateTo.value < this.value) {
            dateTo.value = this.value;
        }
    });

    dateTo.addEventListener('change', function () {
        dateFrom.max = this.value;

        if (dateFrom.value && dateFrom.value > this.value) {
            dateFrom.value = this.value;
        }
    });
</script>

</body>
</html>
