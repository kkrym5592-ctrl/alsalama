<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>تعديل المجموعة - AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --bg: #050914;
            --card: #0b1222;
            --card-light: #101a2d;
            --border: rgba(255, 255, 255, .09);
            --text: #f5f7fb;
            --muted: #929db2;
            --red: #e63946;
            --red-dark: #c92735;
            --input: #080e1b;
            --green: #198754;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(ellipse at top right, rgba(230, 57, 70, .08), transparent 38%),
                var(--bg);
            color: var(--text);
            font-family: Arial, Tahoma, sans-serif;
        }

        a {
            text-decoration: none;
        }

        .page-container {
            max-width: 900px;
            margin: auto;
            padding: 35px 18px 50px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            padding-bottom: 25px;
            margin-bottom: 30px;
            border-bottom: 1px solid var(--border);
        }

        .brand {
            color: var(--red);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 9px;
        }

        .page-title {
            font-size: clamp(23px, 4vw, 32px);
            font-weight: 900;
            margin: 0 0 8px;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--muted);
            margin: 0;
            line-height: 1.8;
        }

        .btn-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 43px;
            padding: 10px 17px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 800;
            transition: .2s ease;
        }

        .btn-red {
            color: #fff;
            background: var(--red);
            border: 1px solid var(--red);
        }

        .btn-red:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-outline {
            color: var(--text);
            background: transparent;
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            color: #fff;
            background: var(--card-light);
            border-color: var(--red);
        }

        .form-card {
            background: linear-gradient(145deg, #0d1628, var(--card));
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 50px rgba(0, 0, 0, .22);
        }

        .card-header-custom {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 23px 25px;
            border-bottom: 1px solid var(--border);
            background: rgba(255, 255, 255, .015);
        }

        .header-icon {
            width: 47px;
            height: 47px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: rgba(230, 57, 70, .13);
            border: 1px solid rgba(230, 57, 70, .28);
            border-radius: 13px;
            font-size: 19px;
        }

        .card-header-custom h3 {
            font-size: 17px;
            font-weight: 900;
            margin: 0 0 6px;
        }

        .card-header-custom p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .form-content {
            padding: 27px 25px;
        }

        .form-label {
            display: block;
            color: #e9edf5;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .required {
            color: var(--red);
        }

        .form-control,
        .form-control:focus {
            color: var(--text);
            background-color: var(--input);
            border: 1px solid #263249;
            border-radius: 10px;
            box-shadow: none;
        }

        .form-control {
            min-height: 49px;
            padding: 12px 14px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(230, 57, 70, .11);
        }

        .form-control::placeholder {
            color: #68748a;
        }

        input[type="file"].form-control {
            padding: 8px;
            min-height: 48px;
        }

        input[type="file"]::file-selector-button {
            color: #fff;
            background: #202b40;
            border: 0;
            border-radius: 7px;
            padding: 7px 12px;
            margin-left: 12px;
            cursor: pointer;
        }

        .form-text {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.9;
            margin-top: 9px;
        }

        .current-image-box {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
            padding: 15px;
            background: var(--input);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .current-image {
            width: 120px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--card);
        }

        .image-placeholder {
            width: 120px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--muted);
            background: var(--card-light);
            border: 1px dashed #354158;
            border-radius: 10px;
            font-size: 27px;
        }

        .image-info-title {
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .image-info-text {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }

        .preview-box {
            display: none;
            margin-top: 15px;
        }

        .preview-box.show {
            display: block;
        }

        .preview-image {
            display: block;
            width: 150px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--red);
        }

        .alert {
            border: 1px solid transparent;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.9;
        }

        .alert-success {
            color: #b7f7d0;
            background: rgba(25, 135, 84, .12);
            border-color: rgba(25, 135, 84, .35);
        }

        .alert-danger {
            color: #ffc3c7;
            background: rgba(230, 57, 70, .10);
            border-color: rgba(230, 57, 70, .3);
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding-top: 24px;
            margin-top: 26px;
            border-top: 1px solid var(--border);
        }

        .actions .btn-custom {
            min-width: 145px;
        }

        .footer-note {
            color: #68748a;
            text-align: center;
            font-size: 11px;
            margin-top: 22px;
        }

        @media (max-width: 576px) {
            .page-container {
                padding: 23px 13px 35px;
            }

            .topbar {
                align-items: stretch;
            }

            .topbar > a {
                width: 100%;
            }

            .card-header-custom {
                padding: 19px 16px;
            }

            .form-content {
                padding: 22px 16px;
            }

            .current-image-box {
                align-items: flex-start;
                gap: 13px;
            }

            .current-image,
            .image-placeholder {
                width: 95px;
                height: 90px;
            }

            .actions {
                flex-direction: column;
            }

            .actions .btn-custom {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page-container">

    {{-- Page Header --}}
    <header class="topbar">
        <div>
            <div class="brand">AL SALAMA</div>
            <h1 class="page-title">تعديل المجموعة</h1>
            <p class="page-subtitle">
                تعديل بيانات مجموعة قائمة في قائمة الطعام.
            </p>
        </div>

        <a href="{{ route('admin.menu-groups.index') }}"
           class="btn-custom btn-outline">
            <i class="fa-solid fa-arrow-right"></i>
            العودة للمجموعات
        </a>
    </header>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success mb-4">
            <i class="fa-solid fa-circle-check ms-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <div class="fw-bold mb-2">
                <i class="fa-solid fa-triangle-exclamation ms-1"></i>
                حدث خطأ أثناء حفظ التعديلات:
            </div>

            <ul class="mb-0 pe-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Form --}}
    <section class="form-card">

        <div class="card-header-custom">
            <div class="header-icon">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>

            <div>
                <h3>بيانات المجموعة</h3>
                <p>عدّل الاسم أو ارفع صورة جديدة للمجموعة.</p>
            </div>
        </div>

        <div class="form-content">

            <form action="{{ route('admin.menu-groups.update', $menuGroup) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Group Name --}}
                <div class="mb-4">
                    <label for="name" class="form-label">
                        اسم المجموعة
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $menuGroup->name) }}"
                        placeholder="اكتب اسم المجموعة..."
                        maxlength="255"
                        required
                        autofocus
                    >

                    @error('name')
                        <div class="text-danger small mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Current Image --}}
                <div class="mb-4">
                    <label class="form-label">صورة المجموعة الحالية</label>

                    <div class="current-image-box">

                        @if($menuGroup->image)
                            <img
                                src="{{ asset('storage/' . $menuGroup->image) }}"
                                alt="{{ $menuGroup->name }}"
                                class="current-image"
                            >
                        @else
                            <div class="image-placeholder">
                                <i class="fa-regular fa-image"></i>
                            </div>
                        @endif

                        <div>
                            <div class="image-info-title">
                                {{ $menuGroup->name }}
                            </div>

                            <div class="image-info-text">
                                @if($menuGroup->image)
                                    الصورة الحالية محفوظة للمجموعة.
                                    <br>
                                    ارفع صورة جديدة بالأسفل لتغييرها.
                                @else
                                    لا توجد صورة مضافة لهذه المجموعة حاليًا.
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                {{-- New Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">
                        {{ $menuGroup->image ? 'تغيير صورة المجموعة' : 'إضافة صورة للمجموعة' }}
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    >

                    <div class="form-text">
                        الأنواع المسموحة: JPG وJPEG وPNG وWEBP.
                        الحد الأقصى لحجم الصورة 4 ميجابايت.
                        اترك الحقل فارغًا للاحتفاظ بالصورة الحالية.
                    </div>

                    @error('image')
                        <div class="text-danger small mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- New Image Preview --}}
                    <div class="preview-box" id="previewBox">
                        <div class="form-label mt-3">معاينة الصورة الجديدة</div>
                        <img src=""
                             alt="معاينة الصورة"
                             class="preview-image"
                             id="previewImage">
                    </div>
                </div>

                {{-- Actions --}}
                <div class="actions">

                    <button type="submit" class="btn-custom btn-red">
                        <i class="fa-solid fa-floppy-disk"></i>
                        حفظ التعديلات
                    </button>

                    <a href="{{ route('admin.menu-groups.index') }}"
                       class="btn-custom btn-outline">
                        <i class="fa-solid fa-xmark"></i>
                        إلغاء
                    </a>

                </div>

            </form>

        </div>
    </section>

    <div class="footer-note">
        AL SALAMA &copy; {{ date('Y') }}
    </div>

</div>

<script>
    const imageInput = document.getElementById('image');
    const previewBox = document.getElementById('previewBox');
    const previewImage = document.getElementById('previewImage');

    let previewUrl = null;

    imageInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) {
            previewBox.classList.remove('show');
            previewImage.removeAttribute('src');
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert('نوع الملف غير مدعوم. اختر JPG أو PNG أو WEBP.');
            this.value = '';
            previewBox.classList.remove('show');
            previewImage.removeAttribute('src');
            return;
        }

        if (file.size > 4 * 1024 * 1024) {
            alert('حجم الصورة يجب ألا يتجاوز 4 ميجابايت.');
            this.value = '';
            previewBox.classList.remove('show');
            previewImage.removeAttribute('src');
            return;
        }

        previewUrl = URL.createObjectURL(file);
        previewImage.src = previewUrl;
        previewBox.classList.add('show');
    });
</script>

</body>
</html>