<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تعديل التصنيف | AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --bg: #080b12;
            --card: #111722;
            --input: #0b1019;
            --border: rgba(255,255,255,.09);
            --red: #e63946;
            --text: #f5f7fa;
            --muted: #929baa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: 'Cairo', sans-serif;
        }

        .page {
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
            padding: 35px 18px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .title {
            margin: 0;
            font-size: 25px;
            font-weight: 800;
        }

        .subtitle {
            color: var(--muted);
            font-size: 13px;
            margin-top: 7px;
        }

        .card-box {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 27px;
        }

        .form-label {
            display: block;
            color: #e5e7eb;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 9px;
        }

        .form-control,
        .form-select {
            background-color: var(--input);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 10px;
            min-height: 47px;
            padding: 11px 14px;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: var(--input);
            color: var(--text);
            border-color: var(--red);
            box-shadow: 0 0 0 .2rem rgba(230,57,70,.13);
        }

        .form-control::placeholder {
            color: #707988;
        }

        .form-select option {
            background: var(--input);
            color: var(--text);
        }

        .form-control[type="file"] {
            padding: 9px 12px;
            cursor: pointer;
        }

        .form-control[type="file"]::file-selector-button {
            background: var(--red);
            color: white;
            border: none;
            border-radius: 7px;
            padding: 5px 12px;
            margin-inline-end: 12px;
            cursor: pointer;
            font-family: 'Cairo', sans-serif;
            font-weight: 700;
        }

        .form-control[type="file"]::file-selector-button:hover {
            background: #c92d3a;
        }

        textarea.form-control {
            min-height: 115px;
            resize: vertical;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 42px 14px 14px;
            background: var(--input);
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        .form-check-input {
            float: none !important;
            margin: 0 !important;
            width: 19px;
            height: 19px;
            flex-shrink: 0;
            background-color: var(--bg);
            border-color: #626b79;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--red);
            border-color: var(--red);
        }

        .form-check-label {
            cursor: pointer;
            font-weight: 600;
        }

        .btn-save {
            background: var(--red);
            color: white;
            border: 1px solid var(--red);
            border-radius: 10px;
            padding: 12px 23px;
            font-weight: 800;
            transition: .2s;
        }

        .btn-save:hover {
            background: #c92d3a;
            border-color: #c92d3a;
            color: white;
            transform: translateY(-1px);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #e5e7eb;
            background: #171e2a;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 11px 17px;
            text-decoration: none;
            font-weight: 700;
            transition: .2s;
        }

        .btn-back:hover {
            background: #222c3b;
            color: white;
        }

        .alert {
            border-radius: 10px;
        }

        .alert-danger {
            background: rgba(230,57,70,.1);
            color: #ffb4bb;
            border-color: rgba(230,57,70,.25);
        }

        .text-danger {
            font-size: 12px;
        }

        .image-section,
        .group-section {
            background: var(--input);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px;
        }

        .image-preview {
            display: block;
            width: 180px;
            height: 140px;
            max-width: 100%;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--card);
        }

        .image-caption {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .image-placeholder {
            width: 180px;
            height: 140px;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px dashed #495365;
            border-radius: 12px;
            background: #101722;
            color: var(--muted);
        }

        .image-placeholder i {
            color: var(--red);
            font-size: 30px;
        }

        .image-help {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.9;
            margin-top: 10px;
        }

        .section-heading {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .section-heading i {
            color: var(--red);
            margin-left: 5px;
        }

        .required-star {
            color: var(--red);
        }

        @media (max-width: 576px) {
            .page {
                padding: 22px 12px;
            }

            .card-box {
                padding: 18px;
            }

            .title {
                font-size: 21px;
            }

            .topbar {
                align-items: flex-start;
            }

            .topbar .btn-back {
                width: 100%;
            }

            .actions {
                display: flex;
                flex-direction: column;
                width: 100%;
            }

            .actions .btn,
            .actions .btn-back {
                width: 100%;
            }

            .image-section,
            .group-section {
                padding: 14px;
            }

            .image-preview,
            .image-placeholder {
                width: 100%;
                height: 180px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="topbar">
        <div>
            <h1 class="title">
                <i class="fa-solid fa-pen-to-square"
                   style="color: var(--red)"></i>
                تعديل التصنيف
            </h1>

            <div class="subtitle">
                عدّل بيانات التصنيف ومجموعته وصورته.
            </div>
        </div>

        <a href="{{ route('admin.category.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-right"></i>
            رجوع للتصنيفات
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <strong>
                <i class="fa-solid fa-circle-exclamation"></i>
                راجع البيانات التالية:
            </strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-box">

        <form
            action="{{ route('admin.category.update', $category->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- Category name --}}
            <div class="mb-4">
                <label for="name" class="form-label">
                    <i class="fa-solid fa-tag"
                       style="color: var(--red)"></i>
                    اسم التصنيف
                    <span class="required-star">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $category->name) }}"
                    placeholder="مثال: وجبات، مشروبات، حلويات"
                    required
                    maxlength="255"
                >

                @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Group --}}
            <div class="mb-4">
                <label for="group_id" class="form-label">
                    <i class="fa-solid fa-layer-group"
                       style="color: var(--red)"></i>
                    المجموعة
                    <span class="required-star">*</span>
                </label>

                <div class="group-section">

                    <div class="section-heading">
                        <i class="fa-solid fa-folder-tree"></i>
                        اختر المجموعة التابعة لها
                    </div>

                    <select
                        id="group_id"
                        name="group_id"
                        class="form-select"
                        required
                    >
                        <option value="">-- اختر المجموعة --</option>

                        @foreach ($groups as $group)
                            <option
                                value="{{ $group->id }}"
                                @selected(
                                    (string) old(
                                        'group_id',
                                        $category->group_id
                                    ) === (string) $group->id
                                )
                            >
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('group_id')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="image-help">
                        <i class="fa-solid fa-circle-info"
                           style="color: var(--red)"></i>
                        اختر المجموعة التي تريد إظهار التصنيف تحتها.
                    </div>

                    @if ($groups->isEmpty())
                        <div class="text-danger mt-2">
                            لا توجد مجموعات متاحة. أضف مجموعة أولاً.
                        </div>
                    @endif

                </div>
            </div>

            {{-- Category image --}}
            <div class="mb-4">
                <label for="image" class="form-label">
                    <i class="fa-solid fa-image"
                       style="color: var(--red)"></i>
                    صورة التصنيف
                </label>

                <div class="image-section">

                    <div class="row g-4">

                        <div class="col-12 col-md-6">
                            <div class="image-caption">
                                الصورة الحالية
                            </div>

                            @if ($category->image)
                                <img
                                    src="{{ asset('storage/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="image-preview"
                                    id="currentImage"
                                >
                            @else
                                <div class="image-placeholder">
                                    <i class="fa-regular fa-image"></i>
                                    <span>لا توجد صورة حالية</span>
                                </div>
                            @endif
                        </div>

                        <div class="col-12 col-md-6"
                             id="newImageColumn"
                             style="display: none;">

                            <div class="image-caption">
                                معاينة الصورة الجديدة
                            </div>

                            <img
                                src=""
                                alt="معاينة الصورة الجديدة"
                                class="image-preview"
                                id="imagePreview"
                            >

                            <div class="image-help">
                                <i class="fa-solid fa-circle-check"
                                   style="color: var(--red)"></i>
                                الصورة الجديدة جاهزة للمعاينة.
                            </div>
                        </div>

                    </div>

                    <hr style="border-color: var(--border); margin: 20px 0;">

                    <label for="image" class="form-label">
                        اختر صورة جديدة
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    >

                    <div class="image-help">
                        <i class="fa-solid fa-circle-info"
                           style="color: var(--red)"></i>
                        اترك الحقل فارغاً للاحتفاظ بالصورة الحالية.
                        الصيغ المدعومة: JPG و PNG و WEBP.
                    </div>

                    @error('image')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            {{-- Description --}}
            @if (isset($category->description))
                <div class="mb-4">
                    <label for="description" class="form-label">
                        <i class="fa-solid fa-align-right"
                           style="color: var(--red)"></i>
                        الوصف (اختياري)
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        placeholder="اكتب وصف التصنيف..."
                    >{{ old('description', $category->description) }}</textarea>

                    @error('description')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            {{-- Active status --}}
            @if (isset($category->is_active))
                <div class="mb-4">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            id="is_active"
                            name="is_active"
                            value="1"
                            class="form-check-input"
                            @checked((bool) old('is_active', $category->is_active))
                        >

                        <label for="is_active" class="form-check-label">
                            التصنيف نشط ومتاح
                        </label>
                    </div>
                </div>
            @endif

            {{-- Buttons --}}
            <div class="actions d-flex gap-2 flex-wrap mt-4">

                <button type="submit" class="btn btn-save">
                    <i class="fa-solid fa-floppy-disk"></i>
                    حفظ التعديلات
                </button>

                <a href="{{ route('admin.category.index') }}"
                   class="btn-back">
                    <i class="fa-solid fa-xmark"></i>
                    إلغاء
                </a>

            </div>

        </form>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const newImageColumn = document.getElementById('newImageColumn');

    let previewUrl = null;

    imageInput.addEventListener('change', function () {

        const file = this.files && this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) {
            newImageColumn.style.display = 'none';
            imagePreview.removeAttribute('src');
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            this.value = '';
            newImageColumn.style.display = 'none';

            alert('اختر صورة بصيغة JPG أو PNG أو WEBP.');
            return;
        }

        previewUrl = URL.createObjectURL(file);
        imagePreview.src = previewUrl;
        newImageColumn.style.display = 'block';
    });

});
</script>

</body>
</html>

