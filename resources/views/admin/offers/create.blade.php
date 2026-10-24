<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة عرض جديد | AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #080a0f;
            --panel: #10131b;
            --panel-light: #171b25;
            --border: rgba(255,255,255,.09);
            --red: #e63946;
            --red-dark: #c62836;
            --text: #f5f6fa;
            --muted: #9299a8;
            --input: #0b0e15;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Cairo', sans-serif;
            color: var(--text);
            background:
                radial-gradient(ellipse at top right, rgba(230,57,70,.09), transparent 35%),
                var(--bg);
        }

        .page {
            width: 100%;
            max-width: 1000px;
            margin: auto;
            padding: 35px 20px 55px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 15px;
            background: linear-gradient(145deg, var(--red), var(--red-dark));
            color: white;
            font-size: 21px;
            box-shadow: 0 7px 25px rgba(230,57,70,.2);
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            color: var(--muted);
            font-size: 12px;
            margin-top: 2px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            text-decoration: none;
            color: #e6e8ef;
            border: 1px solid var(--border);
            background: var(--panel);
            padding: 10px 16px;
            border-radius: 11px;
            font-size: 13px;
            transition: .2s;
        }

        .back-btn:hover {
            color: white;
            border-color: var(--red);
            background: rgba(230,57,70,.08);
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .page-heading h1 {
            font-size: clamp(23px, 4vw, 30px);
            font-weight: 800;
            margin: 0 0 8px;
        }

        .page-heading p {
            color: var(--muted);
            margin: 0;
            font-size: 13px;
        }

        .form-card {
            border: 1px solid var(--border);
            border-radius: 20px;
            background: rgba(16,19,27,.96);
            overflow: hidden;
            box-shadow: 0 20px 70px rgba(0,0,0,.2);
        }

        .card-header {
            background: linear-gradient(90deg, rgba(230,57,70,.12), transparent);
            border-bottom: 1px solid var(--border);
            padding: 22px 25px;
        }

        .card-header h2 {
            margin: 0 0 5px;
            font-size: 17px;
            font-weight: 700;
        }

        .card-header p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .form-body {
            padding: 28px 25px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 800;
            margin: 0 0 20px;
        }

        .section-title i {
            color: var(--red);
            font-size: 15px;
        }

        .section-block {
            margin-bottom: 30px;
        }

        .section-block:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            color: #e5e7ee;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .required {
            color: var(--red);
        }

        .form-control,
        .form-select {
            min-height: 47px;
            background-color: var(--input) !important;
            color: var(--text) !important;
            border: 1px solid #292e3a !important;
            border-radius: 11px !important;
            padding: 11px 14px;
            font-family: inherit;
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-control::placeholder {
            color: #626a7a;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 3px rgba(230,57,70,.12) !important;
        }

        .form-select {
            cursor: pointer;
            color-scheme: dark;
        }

        .form-select option {
            background: #10131b;
            color: white;
        }

        input[type="datetime-local"] {
            color-scheme: dark;
        }

        .form-text {
            color: var(--muted);
            font-size: 11px;
            margin-top: 7px;
        }

        .field-error {
            display: block;
            color: #ff737d;
            font-size: 12px;
            margin-top: 7px;
        }

        .target-options {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 13px;
            margin-bottom: 20px;
        }

        .target-option {
            position: relative;
            cursor: pointer;
        }

        .target-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .target-content {
            min-height: 86px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 17px;
            border: 1px solid #292e3a;
            border-radius: 13px;
            background: var(--input);
            transition: .2s;
        }

        .target-option input:checked + .target-content {
            border-color: var(--red);
            background: rgba(230,57,70,.08);
            box-shadow: inset 0 0 0 1px rgba(230,57,70,.12);
        }

        .target-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: #202431;
            color: #cbd0dc;
            font-size: 17px;
            flex-shrink: 0;
        }

        .target-option input:checked + .target-content .target-icon {
            color: white;
            background: var(--red);
        }

        .target-name {
            font-weight: 700;
            font-size: 13px;
        }

        .target-description {
            color: var(--muted);
            font-size: 11px;
            margin-top: 4px;
        }

        .conditional-field {
            display: none;
        }

        .conditional-field.show {
            display: block;
        }

        .discount-preview {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 18px;
            padding: 17px;
            background: rgba(230,57,70,.06);
            border: 1px dashed rgba(230,57,70,.35);
            border-radius: 13px;
        }

        .preview-icon {
            width: 45px;
            height: 45px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            color: white;
            background: var(--red);
            border-radius: 13px;
            font-size: 18px;
        }

        .preview-label {
            font-size: 11px;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .preview-value {
            font-size: 18px;
            font-weight: 800;
            color: #ff6974;
        }

        .status-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 17px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--input);
        }

        .status-title {
            font-size: 13px;
            font-weight: 700;
        }

        .status-description {
            font-size: 11px;
            color: var(--muted);
            margin-top: 4px;
        }

        .form-check-input {
            width: 43px;
            height: 23px;
            margin: 0 !important;
            float: none !important;
            cursor: pointer;
            background-color: #303543;
            border: 1px solid #454b59;
            flex-shrink: 0;
        }

        .form-check-input:checked {
            background-color: var(--red);
            border-color: var(--red);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(230,57,70,.15);
            border-color: var(--red);
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            flex-wrap: wrap;
            padding-top: 24px;
            margin-top: 27px;
            border-top: 1px solid var(--border);
        }

        .btn-save {
            min-height: 47px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 25px;
            border: 0;
            border-radius: 11px;
            background: linear-gradient(135deg, var(--red), var(--red-dark));
            color: white;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            transition: .2s;
        }

        .btn-save:hover {
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(230,57,70,.22);
        }

        .btn-cancel {
            min-height: 47px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 22px;
            border: 1px solid var(--border);
            border-radius: 11px;
            color: #d4d8e2;
            background: #1a1e28;
            text-decoration: none;
            font-family: inherit;
            font-size: 13px;
            transition: .2s;
        }

        .btn-cancel:hover {
            color: white;
            border-color: #555d6d;
        }

        .alert {
            border-radius: 12px;
            font-size: 13px;
        }

        .alert-danger {
            color: #ffb4bb;
            background: rgba(230,57,70,.1);
            border: 1px solid rgba(230,57,70,.25);
        }

        .footer-note {
            text-align: center;
            color: #656c7b;
            font-size: 11px;
            margin-top: 22px;
        }

        @media (max-width: 576px) {
            .page {
                padding: 22px 13px 35px;
            }

            .form-body {
                padding: 22px 16px;
            }

            .card-header {
                padding: 19px 16px;
            }

            .target-options {
                grid-template-columns: 1fr;
            }

            .form-actions > * {
                width: 100%;
            }

            .page-heading h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <header class="topbar">
        <div class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-tags"></i>
            </div>

            <div>
                <div class="brand-name">AL SALAMA</div>
                <div class="brand-subtitle">إدارة العروض والخصومات</div>
            </div>
        </div>

        <a href="{{ route('admin.offers.index') }}" class="back-btn">
            <i class="fa-solid fa-arrow-right"></i>
            العودة للعروض
        </a>
    </header>

    <div class="page-heading">
        <h1>إنشاء عرض جديد</h1>
        <p>أضف خصمًا جديدًا على منتج أو تصنيف وحدد فترة سريانه.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <div class="fw-bold mb-2">
                <i class="fa-solid fa-circle-exclamation ms-1"></i>
                برجاء مراجعة البيانات التالية:
            </div>

            <ul class="mb-0 pe-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-card">

        <div class="card-header">
            <h2>
                <i class="fa-solid fa-wand-magic-sparkles ms-2" style="color: var(--red)"></i>
                بيانات العرض
            </h2>

            <p>أدخل بيانات العرض بدقة قبل الحفظ.</p>
        </div>

        <div class="form-body">

            <form action="{{ route('admin.offers.store') }}" method="POST">
                @csrf

                {{-- OFFER INFORMATION --}}
                <section class="section-block">

                    <h3 class="section-title">
                        <i class="fa-solid fa-pen-to-square"></i>
                        المعلومات الأساسية
                    </h3>

                    <div class="mb-4">
                        <label for="name" class="form-label">
                            اسم العرض <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="مثال: خصم الوجبة المميزة"
                            maxlength="255"
                            required
                        >

                        @error('name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <label class="form-label">
                        تطبيق العرض على <span class="required">*</span>
                    </label>

                    <div class="target-options">

                        <label class="target-option">
                            <input
                                type="radio"
                                name="target_type"
                                value="product"
                                id="target_product"
                                @checked(old('target_type', 'product') === 'product')
                                required
                            >

                            <div class="target-content">
                                <div class="target-icon">
                                    <i class="fa-solid fa-burger"></i>
                                </div>

                                <div>
                                    <div class="target-name">منتج محدد</div>
                                    <div class="target-description">تطبيق الخصم على منتج واحد</div>
                                </div>
                            </div>
                        </label>

                        <label class="target-option">
                            <input
                                type="radio"
                                name="target_type"
                                value="category"
                                id="target_category"
                                @checked(old('target_type') === 'category')
                            >

                            <div class="target-content">
                                <div class="target-icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>

                                <div>
                                    <div class="target-name">تصنيف كامل</div>
                                    <div class="target-description">تطبيق الخصم على تصنيف</div>
                                </div>
                            </div>
                        </label>

                    </div>

                    @error('target_type')
                        <span class="field-error mb-3">{{ $message }}</span>
                    @enderror

                    {{-- PRODUCT SELECT --}}
                    <div
                        id="product_field"
                        class="conditional-field mb-4"
                    >
                        <label for="product_id" class="form-label">
                            اختر المنتج <span class="required">*</span>
                        </label>

                        <select
                            name="product_id"
                            id="product_id"
                            class="form-select @error('product_id') is-invalid @enderror"
                        >
                            <option value="">-- اختر المنتج --</option>

                            @foreach ($products as $product)
                                <option
                                    value="{{ $product->id }}"
                                    @selected((string) old('product_id') === (string) $product->id)
                                >
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('product_id')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- CATEGORY SELECT --}}
                    <div
                        id="category_field"
                        class="conditional-field mb-4"
                    >
                        <label for="category_id" class="form-label">
                            اختر التصنيف <span class="required">*</span>
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                        >
                            <option value="">-- اختر التصنيف --</option>

                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @selected((string) old('category_id') === (string) $category->id)
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                </section>

                <hr style="border-color: var(--border); opacity: 1; margin-bottom: 30px;">

                {{-- DISCOUNT SETTINGS --}}
                <section class="section-block">

                    <h3 class="section-title">
                        <i class="fa-solid fa-percent"></i>
                        إعدادات الخصم
                    </h3>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="discount_type" class="form-label">
                                نوع الخصم <span class="required">*</span>
                            </label>

                            <select
                                name="discount_type"
                                id="discount_type"
                                class="form-select @error('discount_type') is-invalid @enderror"
                                required
                            >
                                <option
                                    value="percentage"
                                    @selected(old('discount_type', 'percentage') === 'percentage')
                                >
                                    نسبة مئوية (%)
                                </option>

                                <option
                                    value="fixed"
                                    @selected(old('discount_type') === 'fixed')
                                >
                                    مبلغ ثابت (جنيه)
                                </option>
                            </select>

                            @error('discount_type')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="discount_value" class="form-label">
                                قيمة الخصم <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                name="discount_value"
                                id="discount_value"
                                class="form-control @error('discount_value') is-invalid @enderror"
                                value="{{ old('discount_value') }}"
                                placeholder="مثال: 15"
                                min="0.01"
                                max="1000000"
                                step="0.01"
                                required
                            >

                            <div class="form-text" id="discount_help">
                                أدخل نسبة الخصم من 0 إلى 100.
                            </div>

                            @error('discount_value')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="discount-preview">
                        <div class="preview-icon">
                            <i class="fa-solid fa-ticket"></i>
                        </div>

                        <div>
                            <div class="preview-label">معاينة قيمة الخصم</div>
                            <div class="preview-value" id="discount_preview">0%</div>
                        </div>
                    </div>

                </section>

                <hr style="border-color: var(--border); opacity: 1; margin-bottom: 30px;">

                {{-- OFFER DATES --}}
                <section class="section-block">

                    <h3 class="section-title">
                        <i class="fa-regular fa-calendar-days"></i>
                        مدة العرض
                    </h3>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="starts_at" class="form-label">
                                تاريخ ووقت البداية
                            </label>

                            <input
                                type="datetime-local"
                                name="starts_at"
                                id="starts_at"
                                class="form-control @error('starts_at') is-invalid @enderror"
                                value="{{ old('starts_at') }}"
                            >

                            <div class="form-text">
                                اتركه فارغًا ليكون العرض متاحًا من دون تاريخ بداية محدد.
                            </div>

                            @error('starts_at')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ends_at" class="form-label">
                                تاريخ ووقت الانتهاء
                            </label>

                            <input
                                type="datetime-local"
                                name="ends_at"
                                id="ends_at"
                                class="form-control @error('ends_at') is-invalid @enderror"
                                value="{{ old('ends_at') }}"
                            >

                            <div class="form-text">
                                اتركه فارغًا إذا لم تحدد موعد انتهاء.
                            </div>

                            @error('ends_at')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                </section>

                <hr style="border-color: var(--border); opacity: 1; margin-bottom: 25px;">

                {{-- STATUS --}}
                <section class="section-block">

                    <h3 class="section-title">
                        <i class="fa-solid fa-toggle-on"></i>
                        حالة العرض
                    </h3>

                    <div class="status-box">
                        <div>
                            <div class="status-title">تفعيل العرض مباشرة</div>
                            <div class="status-description">
                                عند التفعيل يصبح العرض مؤهلًا للتطبيق وفق تاريخ البداية والنهاية.
                            </div>
                        </div>

                        <input
                            type="checkbox"
                            name="is_active"
                            id="is_active"
                            value="1"
                            class="form-check-input"
                            @checked(old('is_active', '1') == '1')
                        >
                    </div>

                </section>

                {{-- ACTIONS --}}
                <div class="form-actions">

                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-check"></i>
                        حفظ العرض
                    </button>

                    <a href="{{ route('admin.offers.index') }}" class="btn-cancel">
                        <i class="fa-solid fa-xmark"></i>
                        إلغاء
                    </a>

                </div>

            </form>

        </div>
    </div>

    <div class="footer-note">
        AL SALAMA · إدارة العروض والخصومات
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const productRadio = document.getElementById('target_product');
    const categoryRadio = document.getElementById('target_category');

    const productField = document.getElementById('product_field');
    const categoryField = document.getElementById('category_field');

    const productSelect = document.getElementById('product_id');
    const categorySelect = document.getElementById('category_id');

    const discountType = document.getElementById('discount_type');
    const discountValue = document.getElementById('discount_value');
    const discountHelp = document.getElementById('discount_help');
    const discountPreview = document.getElementById('discount_preview');

    function updateTargetFields() {
        const isProduct = productRadio.checked;

        productField.classList.toggle('show', isProduct);
        categoryField.classList.toggle('show', !isProduct);

        productSelect.required = isProduct;
        categorySelect.required = !isProduct;

        productSelect.disabled = !isProduct;
        categorySelect.disabled = isProduct;
    }

    function updateDiscountPreview() {
        const type = discountType.value;
        const value = parseFloat(discountValue.value);

        if (!Number.isFinite(value) || value <= 0) {
            discountPreview.textContent = type === 'percentage' ? '0%' : '0 جنيه';
        } else if (type === 'percentage') {
            discountPreview.textContent = value + '%';
        } else {
            discountPreview.textContent = value.toLocaleString('ar-EG') + ' جنيه';
        }

        if (type === 'percentage') {
            discountValue.max = '100';
            discountHelp.textContent = 'أدخل نسبة الخصم أكبر من 0 وحتى 100%.';
        } else {
            discountValue.max = '1000000';
            discountHelp.textContent = 'أدخل قيمة الخصم بالجنيه المصري.';
        }
    }

    productRadio.addEventListener('change', updateTargetFields);
    categoryRadio.addEventListener('change', updateTargetFields);

    discountType.addEventListener('change', updateDiscountPreview);
    discountValue.addEventListener('input', updateDiscountPreview);

    updateTargetFields();
    updateDiscountPreview();
});
</script>

</body>
</html>
