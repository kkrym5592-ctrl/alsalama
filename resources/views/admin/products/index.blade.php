<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المنتجات | AL SALAMA</title>

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

        button, input, select {
            font-family: inherit;
        }

        a {
            text-decoration: none;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1600px;
            margin: auto;
            padding: 32px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 32px;
            flex-wrap: wrap;
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
            color: white;
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

        .top-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-custom {
            min-height: 44px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 9px;
            padding: 10px 17px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            transition: .2s ease;
            cursor: pointer;
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
            color: #d7dce5;
            background: var(--surface-2);
            border: 1px solid var(--border);
        }

        .btn-secondary-custom:hover {
            background: var(--surface-3);
            color: #fff;
        }

        .breadcrumb-line {
            display: flex;
            align-items: center;
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

        .filters {
            padding: 20px 24px;
            display: grid;
            grid-template-columns: minmax(220px, 1.7fr) minmax(180px, 1fr) auto auto;
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

        .dark-control option {
            background: #10151f;
            color: #fff;
        }

        .filter-button {
            min-height: 45px;
            border-radius: 11px;
            padding: 0 18px;
            font-weight: 800;
            font-size: 13px;
            white-space: nowrap;
        }

        .table-responsive {
            width: 100%;
        }

        .products-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            color: var(--text);
        }

        .products-table thead th {
            padding: 16px 20px;
            background: #0d121b;
            color: #8792a4;
            border-bottom: 1px solid var(--border);
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .products-table tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(255,255,255,.045);
            font-size: 12px;
        }

        .products-table tbody tr {
            transition: background .2s;
        }

        .products-table tbody tr:hover {
            background: rgba(255,255,255,.022);
        }

        .products-table tbody tr:last-child td {
            border-bottom: none;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 220px;
        }

        .product-image {
            width: 57px;
            height: 57px;
            flex-shrink: 0;
            object-fit: cover;
            border-radius: 13px;
            background: var(--surface-3);
            border: 1px solid var(--border);
        }

        .product-placeholder {
            width: 57px;
            height: 57px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: #1b202c;
            color: #7d8799;
            border: 1px solid var(--border);
            font-size: 20px;
        }

        .product-name {
            font-size: 13px;
            font-weight: 800;
            color: #f5f6f8;
            margin-bottom: 5px;
            max-width: 220px;
            overflow-wrap: anywhere;
        }

        .product-description {
            color: var(--muted);
            font-size: 11px;
            max-width: 220px;
            line-height: 1.7;
        }

        .category-tag {
            display: inline-block;
            padding: 7px 10px;
            background: #1a2230;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 8px;
            color: #d6dce6;
            white-space: nowrap;
            font-size: 11px;
        }

        .price-main {
            color: #fff;
            font-weight: 900;
            font-size: 13px;
            white-space: nowrap;
        }

        .price-old {
            color: #778194;
            text-decoration: line-through;
            font-size: 11px;
            margin-top: 4px;
        }

        .price-discount {
            color: var(--green);
            font-size: 11px;
            margin-top: 4px;
            font-weight: 800;
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

        .status-available {
            background: rgba(55,201,138,.10);
            color: #54dba5;
            border: 1px solid rgba(55,201,138,.14);
        }

        .status-unavailable {
            background: rgba(230,57,70,.10);
            color: #ff7781;
            border: 1px solid rgba(230,57,70,.14);
        }

        .featured-badge {
            display: inline-flex;
            gap: 5px;
            align-items: center;
            color: var(--yellow);
            background: rgba(255,200,87,.09);
            border: 1px solid rgba(255,200,87,.13);
            border-radius: 7px;
            padding: 6px 8px;
            font-size: 10px;
            font-weight: 800;
            margin-top: 6px;
        }

        .not-featured {
            color: #657083;
            font-size: 11px;
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

            .filters {
                grid-template-columns: 1fr 1fr;
            }

            .stats-grid {
                gap: 12px;
            }

            .stat-card {
                padding: 17px;
            }
        }

        @media (max-width: 600px) {
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

            .top-actions {
                width: 100%;
            }

            .top-actions .btn-custom {
                flex: 1;
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
                grid-template-columns: 1fr;
                padding: 16px;
            }

            .content-header {
                padding: 18px 16px;
            }

            .products-table thead th,
            .products-table tbody td {
                padding: 13px 14px;
            }

        }
    </style>
</head>

<body>
@php
    $totalProducts = $products->count();
    $availableProducts = \App\Models\Product::where('is_available', true)->count();
    $unavailableProducts = \App\Models\Product::where('is_available', false)->count();
@endphp

<div class="page-wrapper">

    {{-- Header --}}
    <header class="topbar">
        <div class="brand-area">
            <div class="brand-icon">
                <i class="fa-solid fa-utensils"></i>
            </div>

            <div>
                <h1 class="brand-title">AL SALAMA</h1>
                <div class="brand-subtitle">لوحة إدارة المطعم</div>
            </div>
        </div>

        <div class="top-actions">
            <a href="{{ route('admin.products.create') }}"
               class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-plus"></i>
                إضافة منتج جديد
            </a>
            <a href="{{ route('admin.dashboard') }}"
               class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-plus"></i>
               BACK
            </a>
        </div>
    </header>

    <div class="breadcrumb-line">
        <span>الرئيسية</span>
        <i class="fa-solid fa-chevron-left"></i>
        <span>إدارة القائمة</span>
        <i class="fa-solid fa-chevron-left"></i>
        <span class="current">المنتجات</span>
    </div>

    <section class="page-heading">
        <h2>إدارة المنتجات</h2>
        <p>تحكم في منتجات المطعم وأسعارها وتوفرها من مكان واحد.</p>
    </section>

    {{-- Flash Messages --}}
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

    {{-- Statistics --}}
    <section class="stats-grid">
        <div class="stat-card">
            <div>
                <div class="stat-label">إجمالي المنتجات</div>
                <div class="stat-value">{{ number_format($totalProducts) }}</div>
            </div>
            <div class="stat-icon">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">منتجات متاحة</div>
                <div class="stat-value">{{ number_format($availableProducts) }}</div>
            </div>
            <div class="stat-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">منتجات غير متاحة</div>
                <div class="stat-value">{{ number_format($unavailableProducts) }}</div>
            </div>
            <div class="stat-icon yellow">
                <i class="fa-solid fa-ban"></i>
            </div>
        </div>
    </section>

    {{-- Products --}}
    <section class="content-card">

        <div class="content-header">
            <div>
                <h3 class="content-title">قائمة المنتجات</h3>
                <div class="content-subtitle">جميع المنتجات المسجلة في قائمة المطعم</div>
            </div>

            <span class="results-count">
                <i class="fa-solid fa-layer-group"></i>
                {{ number_format($totalProducts) }} منتج
            </span>
        </div>

        {{-- Search & Filters --}}
        <form action="{{ route('admin.products.index') }}" method="GET" class="filters">

            <div class="input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="text"
                    name="search"
                    class="dark-control"
                    placeholder="ابحث عن اسم المنتج..."
                    value="{{ request('search') }}"
                >
            </div>

            <select name="category_id" class="dark-control">
                <option value="">كل التصنيفات</option>
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn-custom btn-primary-custom filter-button">
                <i class="fa-solid fa-filter"></i>
                تطبيق
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="btn-custom btn-secondary-custom filter-button">
                <i class="fa-solid fa-rotate-right"></i>
                إعادة ضبط
            </a>
        </form>

        <div class="table-responsive">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>المنتج</th>
                        <th>التصنيف</th>
                        <th>السعر</th>
                        <th>التوفر</th>
                        <th>منتج مميز</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="product-cell">
                                @if($product->image)
                                    <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="product-image"
                                        loading="lazy"
                                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                                    >
                                    <div class="product-placeholder" style="display:none;">
                                        <i class="fa-solid fa-burger"></i>
                                    </div>
                                @else
                                    <div class="product-placeholder">
                                        <i class="fa-solid fa-burger"></i>
                                    </div>
                                @endif

                                <div>
                                    <div class="product-name">{{ $product->name }}</div>

                                    <div class="product-description">
                                        {{ \Illuminate\Support\Str::limit($product->description ?: 'لا يوجد وصف للمنتج', 55) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($product->category)
                                <span class="category-tag">
                                    <i class="fa-solid fa-tag ms-1"></i>
                                    {{ $product->category->name }}
                                </span>
                            @else
                                <span class="not-featured">بدون تصنيف</span>
                            @endif
                        </td>

                        <td>
                            @if($product->discount_price !== null && $product->discount_price < $product->price)
                                <div class="price-main">
                                    {{ number_format((float) $product->discount_price, 2) }} ج.م
                                </div>

                                <div class="price-old">
                                    {{ number_format((float) $product->price, 2) }} ج.م
                                </div>

                                <div class="price-discount">
                                    <i class="fa-solid fa-arrow-down"></i>
                                    خصم
                                    {{ $product->price > 0 ? number_format((($product->price - $product->discount_price) / $product->price) * 100, 0) : 0 }}%
                                </div>
                            @else
                                <div class="price-main">
                                    {{ number_format((float) $product->price, 2) }} ج.م
                                </div>
                            @endif
                        </td>

                        <td>
                            @if($product->is_available)
                                <span class="status-badge status-available">
                                    <i class="fa-solid fa-circle-check"></i>
                                    متاح
                                </span>
                            @else
                                <span class="status-badge status-unavailable">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    غير متاح
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($product->is_featured)
                                <span class="featured-badge">
                                    <i class="fa-solid fa-star"></i>
                                    مميز
                                </span>
                            @else
                                <span class="not-featured">عادي</span>
                            @endif
                        </td>

                        <td>
                            <div class="actions-cell">
                                <a
                                    href="{{ route('admin.products.edit', $product->id) }}"
                                    class="action-btn action-edit"
                                    title="تعديل المنتج"
                                    aria-label="تعديل المنتج"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form
                                    action="{{ route('admin.products.destroy', $product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('هل أنت متأكد من حذف المنتج: {{ addslashes($product->name) }}؟');"
                                    class="m-0"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn action-delete"
                                        title="حذف المنتج"
                                        aria-label="حذف المنتج"
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
                                <i class="fa-solid fa-box-open"></i>
                            </div>

                            <h4>لا توجد منتجات</h4>

                            <p>
                                @if(request()->hasAny(['search', 'category_id']))
                                    لم نعثر على منتجات مطابقة لبحثك. جرّب تغيير الفلاتر.
                                @else
                                    لم تتم إضافة أي منتجات حتى الآن. ابدأ بإضافة أول منتج.
                                @endif
                            </p>

                            @if(request()->hasAny(['search', 'category_id']))
                                <a href="{{ route('admin.products.index') }}"
                                   class="btn-custom btn-secondary-custom">
                                    <i class="fa-solid fa-rotate-right"></i>
                                    عرض كل المنتجات
                                </a>
                            @else
                                <a href="{{ route('admin.products.create') }}"
                                   class="btn-custom btn-primary-custom">
                                    <i class="fa-solid fa-plus"></i>
                                    إضافة أول منتج
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>


    </section>

    <div class="footer-note">
        AL SALAMA &copy; {{ date('Y') }} — إدارة المنتجات
    </div>

</div>

<script>
    document.querySelectorAll('.alert-custom').forEach(function (alert) {
        if (alert.classList.contains('alert-success-custom')) {
            setTimeout(function () {
                alert.style.transition = 'opacity .4s ease';
                alert.style.opacity = '0';

                setTimeout(function () {
                    alert.remove();
                }, 400);
            }, 4500);
        }
    });
</script>

</body>
</html>
