<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تعديل المنتج | AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #080b12;
            --surface: #10151f;
            --surface-2: #151c28;
            --border: rgba(255,255,255,.08);
            --text: #f4f5f7;
            --muted: #8993a4;
            --red: #e63946;
            --red-dark: #bc2634;
            --green: #37c98a;
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

        .page-wrapper {
            width: 100%;
            max-width: 1100px;
            margin: auto;
            padding: 30px 22px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 18px;
            margin-bottom: 30px;
        }

        .brand-area {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, var(--red), #a91626);
            color: #fff;
            font-size: 22px;
            box-shadow: 0 8px 25px rgba(230,57,70,.2);
        }

        .brand-title {
            margin: 0;
            font-size: 23px;
            font-weight: 900;
        }

        .brand-subtitle {
            color: var(--muted);
            font-size: 12px;
            margin-top: 4px;
        }

        .btn-custom {
            min-height: 43px;
            padding: 10px 16px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 11px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
        }

        .btn-red {
            color: #fff;
            background: var(--red);
            border: 1px solid var(--red);
        }

        .btn-red:hover {
            color: #fff;
            background: var(--red-dark);
            border-color: var(--red-dark);
            transform: translateY(-1px);
        }

        .btn-secondary-custom {
            color: #d7dce5;
            background: var(--surface-2);
            border: 1px solid var(--border);
        }

        .btn-secondary-custom:hover {
            color: #fff;
            background: #202a39;
        }

        .breadcrumb-line {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
            margin-bottom: 22px;
            color: var(--muted);
            font-size: 12px;
        }

        .breadcrumb-line i {
            font-size: 10px;
        }

        .breadcrumb-line a {
            color: var(--muted);
            text-decoration: none;
        }

        .breadcrumb-line a:hover {
            color: #fff;
        }

        .breadcrumb-line .current {
            color: #fff;
            font-weight: 700;
        }

        .page-heading {
            margin-bottom: 24px;
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

        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0,0,0,.13);
        }

        .card-header-custom {
            padding: 22px 25px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .header-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(230,57,70,.12);
            color: #ff6570;
            border: 1px solid rgba(230,57,70,.15);
            border-radius: 13px;
            font-size: 17px;
        }

        .card-header-custom h3 {
            font-size: 16px;
            font-weight: 900;
            margin: 0;
        }

        .card-header-custom p {
            color: var(--muted);
            font-size: 12px;
            margin: 4px 0 0;
        }

        .form-body {
            padding: 26px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .form-group {
            min-width: 0;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 9px;
            color: #e5e8ee;
            font-size: 12px;
            font-weight: 800;
        }

        .required {
            color: #ff6570;
        }

        .dark-control {
            width: 100%;
            min-height: 46px;
            padding: 11px 14px;
            border: 1px solid #273040;
            border-radius: 11px;
            outline: none;
            background-color: #0b1019;
            color: #f3f4f6;
            font-family: inherit;
            font-size: 13px;
            box-shadow: none;
            transition: .2s;
        }

        textarea.dark-control {
            min-height: 120px;
            resize: vertical;
        }

        .dark-control:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(230,57,70,.1);
        }

        .dark-control::placeholder {
            color: #697386;
        }

        .dark-control option {
            background: #10151f;
            color: #fff;
        }

        .form-help {
            color: var(--muted);
            font-size: 11px;
            margin-top: 7px;
            line-height: 1.7;
        }

        .current-image-box {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px;
            border: 1px solid var(--border);
            background: #0b1019;
            border-radius: 13px;
            margin-bottom: 12px;
        }

        .current-image {
            width: 100px;
            height: 100px;
            flex-shrink: 0;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--surface-2);
        }

        .no-image {
            width: 100px;
            height: 100px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--surface-2);
            color: var(--muted);
            font-size: 28px;
        }

        .image-info {
            min-width: 0;
        }

        .image-info strong {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .image-info span {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.8;
        }

        .check-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .check-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: #0b1019;
            border: 1px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
        }

        .check-card input {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            accent-color: var(--red);
            cursor: pointer;
        }

        .check-card strong {
            display: block;
            font-size: 12px;
            font-weight: 800;
        }

        .check-card small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-top: 4px;
        }

        .alert-custom {
            padding: 14px 17px;
            margin-bottom: 20px;
            border: 1px solid rgba(230,57,70,.25);
            border-radius: 12px;
            background: rgba(230,57,70,.08);
            color: #ff818a;
        }

        .alert-success-custom {
            color: #67e0b0;
            background: rgba(55,201,138,.08);
            border-color: rgba(55,201,138,.25);
        }

        .invalid-feedback-custom {
            display: block;
            margin-top: 7px;
            color: #ff818a;
            font-size: 11px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 20px 26px;
            border-top: 1px solid var(--border);
            background: rgba(255,255,255,.015);
        }

        .footer-note {
            color: var(--muted);
            font-size: 11px;
        }

        .footer-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        @media (max-width: 650px) {
            .page-wrapper {
                padding: 20px 12px;
            }

            .topbar {
                align-items: flex-start;
            }

            .brand-title {
                font-size: 19px;
            }

            .page-heading h2 {
                font-size: 23px;
            }

            .form-body {
                padding: 18px 15px;
            }

            .form-grid,
            .check-grid {
                grid-template-columns: 1fr;
            }

            .card-header-custom {
                padding: 18px 15px;
            }

            .form-footer {
                padding: 17px 15px;
                align-items: stretch;
            }

            .footer-actions {
                width: 100%;
            }

            .footer-actions .btn-custom {
                flex: 1;
            }

            .current-image {
                width: 80px;
                height: 80px;
            }

            .no-image {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>

<body>

<div class="page-wrapper">

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

        <a href="{{ route('admin.products.index') }}"
           class="btn-custom btn-secondary-custom">
            <i class="fa-solid fa-arrow-right"></i>
            العودة للمنتجات
        </a>
    </header>

    <div class="breadcrumb-line">
        <a href="{{ route('admin.dashboard') }}">الرئيسية</a>
        <i class="fa-solid fa-chevron-left"></i>
        <a href="{{ route('admin.products.index') }}">إدارة المنتجات</a>
        <i class="fa-solid fa-chevron-left"></i>
        <span class="current">تعديل المنتج</span>
    </div>

    <section class="page-heading">
        <h2>تعديل المنتج</h2>
        <p>عدّل بيانات المنتج وسعره وتصنيفه وصورته وتوفره.</p>
    </section>

    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <i class="fa-solid fa-circle-check ms-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-custom">
            <i class="fa-solid fa-circle-exclamation ms-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-custom">
            <strong class="d-block mb-2">راجع البيانات التالية:</strong>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="form-card">

        <div class="card-header-custom">
            <div class="header-icon">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>

            <div>
                <h3>بيانات المنتج</h3>
                <p>المنتج: {{ $product->name }}</p>
            </div>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-body">

                <div class="form-grid">

                    <div class="form-group">
                        <label for="name" class="form-label">
                            اسم المنتج <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="dark-control"
                            value="{{ old('name', $product->name) }}"
                            placeholder="مثال: برجر لحم"
                            required
                        >

                        @error('name')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id" class="form-label">
                            التصنيف <span class="required">*</span>
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="dark-control"
                            required
                        >
                            <option value="">اختر التصنيف</option>

                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ (string) old('category_id', $product->category_id) === (string) $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price" class="form-label">
                            السعر الأصلي بالجنيه <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            class="dark-control"
                            value="{{ old('price', $product->price) }}"
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                            required
                        >

                        @error('price')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount_price" class="form-label">
                            سعر الخصم بالجنيه
                        </label>

                        <input
                            type="number"
                            id="discount_price"
                            name="discount_price"
                            class="dark-control"
                            value="{{ old('discount_price', $product->discount_price) }}"
                            min="0"
                            step="0.01"
                            placeholder="اتركه فارغًا لو مفيش خصم"
                        >

                        <div class="form-help">
                            اترك الحقل فارغًا إذا كان المنتج بدون خصم.
                        </div>

                        @error('discount_price')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="description" class="form-label">
                            وصف المنتج
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="dark-control"
                            placeholder="اكتب وصفًا مختصرًا للمنتج..."
                        >{{ old('description', $product->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="image" class="form-label">
                            صورة المنتج
                        </label>

                        <div class="current-image-box">
                            @if($product->image)
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="current-image"
                                    id="currentImage"
                                    onerror="this.style.display='none';document.getElementById('noImage').style.display='flex';"
                                >

                                <div class="no-image" id="noImage" style="display:none;">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @else
                                <div class="no-image" id="noImage">
                                    <i class="fa-solid fa-image"></i>
                                </div>

                                <img
                                    src=""
                                    alt="معاينة الصورة"
                                    class="current-image"
                                    id="currentImage"
                                    style="display:none;"
                                >
                            @endif

                            <div class="image-info">
                                <strong>الصورة الحالية</strong>
                                <span>
                                    يمكنك الاحتفاظ بالصورة الحالية أو اختيار صورة جديدة.
                                    لن يتم تغيير الصورة إلا عند اختيار ملف جديد.
                                </span>
                            </div>
                        </div>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="dark-control"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                        >

                        <div class="form-help">
                            الصيغ المدعومة: JPG، PNG، WEBP.
                        </div>

                        @error('image')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">حالة المنتج</label>

                        <div class="check-grid">

                            <label class="check-card" for="is_available">
                                <input
                                    type="checkbox"
                                    id="is_available"
                                    name="is_available"
                                    value="1"
                                    {{ (bool) old('is_available', $product->is_available) ? 'checked' : '' }}
                                >

                                <span>
                                    <strong>المنتج متاح</strong>
                                    <small>يظهر المنتج كمتاح للطلب.</small>
                                </span>
                            </label>

                            <label class="check-card" for="is_featured">
                                <input
                                    type="checkbox"
                                    id="is_featured"
                                    name="is_featured"
                                    value="1"
                                    {{ (bool) old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                >

                                <span>
                                    <strong>منتج مميز</strong>
                                    <small>تمييز المنتج في قائمة المطعم.</small>
                                </span>
                            </label>

                        </div>
                    </div>

                </div>
            </div>

            <div class="form-footer">
                <div class="footer-note">
                    <i class="fa-solid fa-circle-info ms-1"></i>
                    تأكد من مراجعة السعر والتصنيف قبل الحفظ.
                </div>

                <div class="footer-actions">
                    <a href="{{ route('admin.products.index') }}"
                       class="btn-custom btn-secondary-custom">
                        <i class="fa-solid fa-xmark"></i>
                        إلغاء
                    </a>

                    <button type="submit" class="btn-custom btn-red">
                        <i class="fa-solid fa-floppy-disk"></i>
                        حفظ التعديلات
                    </button>
                </div>
            </div>

        </form>
    </section>

</div>

<script>
    const imageInput = document.getElementById('image');
    const currentImage = document.getElementById('currentImage');
    const noImage = document.getElementById('noImage');

    imageInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) {
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('من فضلك اختر ملف صورة صالح.');
            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            currentImage.src = event.target.result;
            currentImage.style.display = 'block';

            if (noImage) {
                noImage.style.display = 'none';
            }
        };

        reader.readAsDataURL(file);
    });
</script>

</body>
</html>
