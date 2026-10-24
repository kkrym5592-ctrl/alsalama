<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة التصنيفات | AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #080b12;
            --surface: #10151f;
            --surface-2: #151c28;
            --surface-3: #1b2432;
            --border: rgba(255,255,255,.075);
            --text: #f4f5f7;
            --muted: #8993a4;
            --red: #e63946;
            --red-dark: #bc2634;
            --green: #37c98a;
            --yellow: #ffc857;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(ellipse at top right, rgba(230,57,70,.09), transparent 35%),
                var(--bg);
            color: var(--text);
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
        }

        a {
            text-decoration: none;
        }

        button, input, select {
            font-family: inherit;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1600px;
            margin: auto;
            padding: 32px;
        }

        /* HEADER */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .brand-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-icon {
            width: 54px;
            height: 54px;
            border-radius: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, var(--red), #a91626);
            color: #fff;
            font-size: 23px;
            box-shadow: 0 8px 28px rgba(230,57,70,.22);
        }

        .brand-title {
            margin: 0;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -.5px;
        }

        .brand-subtitle {
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .btn-custom {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 10px 17px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            transition: .2s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-primary-custom {
            background: var(--red);
            border: 1px solid var(--red);
            color: #fff;
            box-shadow: 0 5px 18px rgba(230,57,70,.15);
        }

        .btn-primary-custom:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            background: var(--surface-2);
            border: 1px solid var(--border);
            color: #d7dce5;
        }

        .btn-secondary-custom:hover {
            background: var(--surface-3);
            color: #fff;
        }

        .breadcrumb-line {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 24px;
        }

        .breadcrumb-line i {
            font-size: 10px;
        }

        .breadcrumb-line .current {
            color: #fff;
            font-weight: 700;
        }

        .page-heading {
            margin-bottom: 27px;
        }

        .page-heading h2 {
            font-size: 27px;
            font-weight: 900;
            margin: 0 0 8px;
        }

        .page-heading p {
            color: var(--muted);
            margin: 0;
            font-size: 13px;
        }

        /* STATISTICS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
            margin-bottom: 25px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 120px;
            padding: 22px;
            background: linear-gradient(145deg, var(--surface-2), var(--surface));
            border: 1px solid var(--border);
            border-radius: 19px;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            width: 95px;
            height: 95px;
            left: -30px;
            bottom: -40px;
            background: rgba(230,57,70,.06);
            border-radius: 50%;
            pointer-events: none;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .stat-value {
            font-size: 28px;
            line-height: 1.2;
            font-weight: 900;
        }

        .stat-icon {
            width: 49px;
            height: 49px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: rgba(230,57,70,.12);
            color: #ff5966;
            font-size: 20px;
            border: 1px solid rgba(230,57,70,.14);
        }

        .stat-icon.green {
            color: var(--green);
            background: rgba(55,201,138,.10);
            border-color: rgba(55,201,138,.13);
        }

        .stat-icon.yellow {
            color: var(--yellow);
            background: rgba(255,200,87,.10);
            border-color: rgba(255,200,87,.13);
        }

        /* CONTENT */

        .content-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0,0,0,.13);
        }

        .content-header {
            padding: 22px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .content-title {
            margin: 0;
            font-size: 16px;
            font-weight: 900;
        }

        .content-subtitle {
            margin-top: 5px;
            font-size: 12px;
            color: var(--muted);
        }

        .results-count {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            border-radius: 9px;
            background: rgba(230,57,70,.10);
            border: 1px solid rgba(230,57,70,.16);
            color: #ff7580;
            font-size: 12px;
            font-weight: 800;
        }

        /* SEARCH */

        .filters {
            padding: 20px 24px;
            display: grid;
            grid-template-columns: minmax(220px, 1.7fr) auto auto;
            gap: 12px;
            border-bottom: 1px solid var(--border);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap > i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        .dark-control {
            width: 100%;
            min-height: 45px;
            background-color: #0b1019 !important;
            color: #f3f4f6 !important;
            border: 1px solid #273040 !important;
            border-radius: 11px !important;
            padding: 10px 15px;
            font-size: 13px;
            outline: none;
            box-shadow: none !important;
        }

        .input-wrap .dark-control {
            padding-right: 42px;
        }

        .dark-control:focus {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 3px rgba(230,57,70,.10) !important;
        }

        .dark-control::placeholder {
            color: #697386;
        }

        /* TABLE */

        .table-responsive {
            width: 100%;
        }

        .categories-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            color: var(--text);
        }

        .categories-table thead th {
            padding: 16px 20px;
            background: #0d121b;
            color: #8792a4;
            border-bottom: 1px solid var(--border);
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .categories-table tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(255,255,255,.045);
            font-size: 12px;
        }

        .categories-table tbody tr {
            transition: background .2s;
        }

        .categories-table tbody tr:hover {
            background: rgba(255,255,255,.022);
        }

        .categories-table tbody tr:last-child td {
            border-bottom: none;
        }

        .category-cell {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 220px;
        }

        .category-image,
        .category-placeholder {
            width: 57px;
            height: 57px;
            flex-shrink: 0;
            border-radius: 13px;
            background: var(--surface-3);
            border: 1px solid var(--border);
        }

        .category-image {
            object-fit: cover;
        }

        .category-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7d8799;
            background: #1b202c;
            font-size: 20px;
        }

        .category-name {
            font-size: 13px;
            font-weight: 800;
            color: #f5f6f8;
            margin-bottom: 5px;
            overflow-wrap: anywhere;
        }

        .category-description {
            color: var(--muted);
            font-size: 11px;
            max-width: 230px;
            line-height: 1.7;
        }

        .group-tag {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 10px;
            background: #1a2230;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 8px;
            color: #d6dce6;
            white-space: nowrap;
            font-size: 11px;
        }

        .group-empty {
            color: #7e899a;
            font-size: 11px;
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 35px;
            padding: 7px 10px;
            background: rgba(230,57,70,.10);
            border: 1px solid rgba(230,57,70,.14);
            border-radius: 8px;
            color: #ff7580;
            font-weight: 900;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 8px;
            white-space: nowrap;
            font-size: 10px;
            font-weight: 800;
        }

        .status-active {
            background: rgba(55,201,138,.10);
            color: #54dba5;
            border: 1px solid rgba(55,201,138,.14);
        }

        .status-inactive {
            background: rgba(230,57,70,.10);
            color: #ff7781;
            border: 1px solid rgba(230,57,70,.14);
        }

        .actions-cell {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #171e2a;
            color: #d3d9e4;
            font-size: 12px;
            transition: .2s;
            cursor: pointer;
        }

        .action-edit:hover {
            background: rgba(255,200,87,.12);
            border-color: rgba(255,200,87,.3);
            color: var(--yellow);
        }

        .action-delete:hover {
            background: rgba(230,57,70,.13);
            border-color: rgba(230,57,70,.3);
            color: #ff6975;
        }

        /* EMPTY STATE */

        .empty-state {
            padding: 65px 20px !important;
            text-align: center;
        }

        .empty-icon {
            width: 75px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 17px;
            background: rgba(230,57,70,.09);
            border: 1px solid rgba(230,57,70,.13);
            color: var(--red);
            border-radius: 22px;
            font-size: 28px;
        }

        .empty-state h4 {
            font-size: 17px;
            font-weight: 900;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 20px;
        }

        /* PAGINATION */

        .pagination-area {
            padding: 20px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .pagination-info {
            color: var(--muted);
            font-size: 12px;
        }

        .pagination {
            margin: 0;
            gap: 5px;
        }

        .pagination .page-link {
            min-width: 35px;
            min-height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #151c28;
            color: #d6dce6;
            border: 1px solid var(--border);
            border-radius: 9px !important;
            font-size: 12px;
        }

        .pagination .page-item.active .page-link {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            background: #0d121b;
            color: #505a6b;
        }

        /* ALERTS */

        .alert-custom {
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text);
            border-radius: 13px;
            padding: 14px 17px;
            margin-bottom: 20px;
        }

        .alert-success-custom {
            border-color: rgba(55,201,138,.25);
            color: #67e0b0;
        }

        .alert-danger-custom {
            border-color: rgba(230,57,70,.25);
            color: #ff818a;
        }

        .footer-note {
            margin-top: 24px;
            text-align: center;
            color: #596476;
            font-size: 11px;
        }

        @media (max-width: 1000px) {
            .page-wrapper {
                padding: 22px;
            }

            .stats-grid {
                gap: 12px;
            }

            .stat-card {
                padding: 17px;
            }
        }

        @media (max-width: 700px) {
            .page-wrapper {
                padding: 15px 12px;
            }

            .topbar {
                align-items: flex-start;
                margin-bottom: 24px;
            }

            .brand-icon {
                width: 45px;
                height: 45px;
                border-radius: 13px;
                font-size: 19px;
            }

            .brand-title {
                font-size: 19px;
            }

            .topbar > a {
                width: 100%;
            }

            .page-heading h2 {
                font-size: 23px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .stat-card {
                min-height: 95px;
            }

            .stat-value {
                font-size: 24px;
            }

            .filters {
                grid-template-columns: 1fr 1fr;
                padding: 16px;
            }

            .filters .input-wrap {
                grid-column: 1 / -1;
            }

            .content-header {
                padding: 18px 16px;
            }

            .categories-table thead th,
            .categories-table tbody td {
                padding: 13px 14px;
            }

            .pagination-area {
                padding: 16px;
            }
        }
    </style>
</head>

<body>
@php
    $totalCategories = $categories->total();
    $activeCategories = \App\Models\Category::where('is_active', true)->count();
    $inactiveCategories = \App\Models\Category::where('is_active', false)->count();
@endphp

<div class="page-wrapper">

    {{-- HEADER --}}
    <header class="topbar">
        <div class="brand-area">
            <div class="brand-icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>

            <div>
                <h1 class="brand-title">AL SALAMA</h1>
                <div class="brand-subtitle">لوحة إدارة المطعم</div>
            </div>
        </div>

        <div class="d-flex">

            <a href="{{ route('admin.category.create') }}"
               class="btn-custom btn-primary-custom mx-2">
                <i class="fa-solid fa-plus"></i>
                إضافة تصنيف جديد
            </a>
            <a href="{{ route('admin.dashboard') }}"
               class="btn-custom btn-primary-custom">
               BACK
            </a>
        </div>
    </header>

    <div class="breadcrumb-line">
        <span>الرئيسية</span>
        <i class="fa-solid fa-chevron-left"></i>
        <span>إدارة القائمة</span>
        <i class="fa-solid fa-chevron-left"></i>
        <span class="current">التصنيفات</span>
    </div>

    <section class="page-heading">
        <h2>إدارة التصنيفات</h2>
        <p>نظّم أقسام الطعام واربط كل تصنيف بمجموعة المنيو المناسبة.</p>
    </section>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <i class="fa-solid fa-circle-check ms-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-custom alert-danger-custom">
            <i class="fa-solid fa-circle-exclamation ms-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-custom alert-danger-custom">
            <div class="fw-bold mb-2">حدث خطأ أثناء تنفيذ العملية:</div>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- STATISTICS --}}
    <section class="stats-grid">

        <div class="stat-card">
            <div>
                <div class="stat-label">إجمالي التصنيفات</div>
                <div class="stat-value">{{ number_format($totalCategories) }}</div>
            </div>

            <div class="stat-icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">تصنيفات نشطة</div>
                <div class="stat-value">{{ number_format($activeCategories) }}</div>
            </div>

            <div class="stat-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">تصنيفات غير نشطة</div>
                <div class="stat-value">{{ number_format($inactiveCategories) }}</div>
            </div>

            <div class="stat-icon yellow">
                <i class="fa-solid fa-ban"></i>
            </div>
        </div>

    </section>

    {{-- MAIN CONTENT --}}
    <section class="content-card">

        <div class="content-header">
            <div>
                <h3 class="content-title">قائمة التصنيفات</h3>
                <div class="content-subtitle">
                    إدارة أسماء التصنيفات والصور والمجموعات المرتبطة بها
                </div>
            </div>

            <span class="results-count">
                <i class="fa-solid fa-folder-open"></i>
                {{ number_format($categories->total()) }} تصنيف
            </span>
        </div>

        {{-- SEARCH --}}
        <form method="GET"
              action="{{ route('admin.category.index') }}"
              class="filters">

            <div class="input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="search"
                    name="search"
                    class="dark-control"
                    placeholder="ابحث عن اسم التصنيف..."
                    value="{{ request('search') }}"
                >
            </div>

            <button type="submit"
                    class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-filter"></i>
                بحث
            </button>

            <a href="{{ route('admin.category.index') }}"
               class="btn-custom btn-secondary-custom">
                <i class="fa-solid fa-rotate-right"></i>
                إعادة ضبط
            </a>

        </form>

        <div class="table-responsive">
            <table class="categories-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>التصنيف</th>
                        <th>مجموعة المنيو</th>
                        <th>المنتجات</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($categories as $category)

                    <tr>
                        <td>
                            <span style="color:#8993a4;font-weight:700;">
                                {{ $categories->firstItem() + $loop->index }}
                            </span>
                        </td>

                        {{-- CATEGORY --}}
                        <td>
                            <div class="category-cell">

                                @if($category->image)
                                    <img
                                        src="{{ asset('storage/' . ltrim(str_replace('public/', '', $category->image), '/')) }}"
                                        alt="{{ $category->name }}"
                                        class="category-image"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';"
                                    >

                                    <div class="category-placeholder" style="display:none;">
                                        <i class="fa-solid fa-utensils"></i>
                                    </div>
                                @else
                                    <div class="category-placeholder">
                                        <i class="fa-solid fa-utensils"></i>
                                    </div>
                                @endif

                                <div>
                                    <div class="category-name">
                                        {{ $category->name }}
                                    </div>

                                    <div class="category-description">
                                        {{ $category->description
                                            ? \Illuminate\Support\Str::limit($category->description, 55)
                                            : 'لا يوجد وصف للتصنيف' }}
                                    </div>
                                </div>

                            </div>
                        </td>

                        {{-- GROUP --}}
                        <td>
                            @if($category->menuGroup)
                                <span class="group-tag">
                                    <i class="fa-solid fa-folder" style="color:#ff6570;"></i>
                                    {{ $category->menuGroup->name }}
                                </span>
                            @else
                                <span class="group-empty">
                                    <i class="fa-solid fa-minus ms-1"></i>
                                    بدون مجموعة
                                </span>
                            @endif
                        </td>

                        {{-- PRODUCTS COUNT --}}
                        <td>
                            <span class="count-badge">
                                {{ $category->products_count ?? $category->products()->count() }}
                            </span>
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($category->is_active)
                                <span class="status-badge status-active">
                                    <i class="fa-solid fa-circle-check"></i>
                                    نشط
                                </span>
                            @else
                                <span class="status-badge status-inactive">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    غير نشط
                                </span>
                            @endif
                        </td>

                        {{-- ACTIONS --}}
                        <td>
                            <div class="actions-cell">

                                <a
                                    href="{{ route('admin.category.edit', $category) }}"
                                    class="action-btn action-edit"
                                    title="تعديل التصنيف"
                                    aria-label="تعديل التصنيف"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form
                                    action="{{ route('admin.category.destroy', $category) }}"
                                    method="POST"
                                    class="m-0"
                                    onsubmit="return confirm('هل أنت متأكد من حذف التصنيف {{ addslashes($category->name) }}؟');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn action-delete"
                                        title="حذف التصنيف"
                                        aria-label="حذف التصنيف"
                                    >
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="empty-state">
                            <div class="empty-icon">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>

                            @if(request()->filled('search'))
                                <h4>لا توجد نتائج مطابقة</h4>
                                <p>جرّب البحث باسم تصنيف مختلف.</p>

                                <a href="{{ route('admin.category.index') }}"
                                   class="btn-custom btn-secondary-custom">
                                    <i class="fa-solid fa-rotate-right"></i>
                                    عرض كل التصنيفات
                                </a>
                            @else
                                <h4>لا توجد تصنيفات حتى الآن</h4>
                                <p>ابدأ بإضافة أول تصنيف لتنظيم قائمة الطعام.</p>

                                <a href="{{ route('admin.category.create') }}"
                                   class="btn-custom btn-primary-custom">
                                    <i class="fa-solid fa-plus"></i>
                                    إضافة أول تصنيف
                                </a>
                            @endif
                        </td>
                    </tr>

                @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($categories->hasPages())
            <div class="pagination-area">
                <div class="pagination-info">
                    عرض {{ $categories->firstItem() ?? 0 }}
                    إلى {{ $categories->lastItem() ?? 0 }}
                    من {{ $categories->total() }} تصنيف
                </div>

                {{ $categories->onEachSide(1)->links() }}
            </div>
        @endif

    </section>

    <div class="footer-note">
        AL SALAMA &copy; {{ date('Y') }} — إدارة التصنيفات
    </div>

</div>

<script>
    document.querySelectorAll('.alert-success-custom').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity .4s ease';
            alert.style.opacity = '0';

            setTimeout(function () {
                alert.remove();
            }, 400);
        }, 4500);
    });
</script>

</body>
</html>
