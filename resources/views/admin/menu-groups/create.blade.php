<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Create New Group | AL SALAMA</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: #0b0d12;
            color: #f5f5f5;
        }

        .group-page {
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .group-container {
            width: 100%;
            max-width: 720px;
        }

        .group-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }

        .group-header-icon {
            width: 58px;
            height: 58px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: rgba(220, 38, 38, 0.13);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #ef4444;
            font-size: 24px;
        }

        .group-header h2 {
            margin: 0 0 7px;
            font-size: 27px;
            font-weight: 800;
            color: #fff;
        }

        .group-header p {
            margin: 0;
            color: #9298a5;
            font-size: 14px;
            line-height: 1.6;
        }

        .group-back {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: #b7bdc8;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 22px;
            transition: color 0.2s;
        }

        .group-back:hover {
            color: #ef4444;
        }

        .group-card {
            background: #12151d;
            border: 1px solid #252a35;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.25);
        }

        .group-card-heading {
            margin: 0 0 25px;
            padding-bottom: 18px;
            border-bottom: 1px solid #252a35;
            font-size: 17px;
            font-weight: 700;
            color: #fff;
        }

        .group-form label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: 700;
            color: #e6e8ed;
        }

        .group-required {
            color: #ef4444;
        }

        .group-input {
            width: 100%;
            height: 49px;
            padding: 0 15px;
            border-radius: 10px;
            border: 1px solid #303644;
            background: #0b0d12;
            color: #fff;
            outline: none;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .group-input::placeholder {
            color: #646b79;
        }

        .group-input:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .group-help {
            margin-top: 10px;
            color: #858c9a;
            font-size: 12px;
            line-height: 1.6;
        }

        .group-image-picker {
            min-height: 180px;
            width: 100%;
            padding: 24px;
            display: flex !important;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-align: center;
            border: 1px dashed #3a414f;
            border-radius: 12px;
            background: #0d1017;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }

        .group-image-picker:hover {
            border-color: #ef4444;
            background: rgba(239, 68, 68, 0.035);
        }

        .group-image-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(239, 68, 68, 0.12);
            color: #ef4444;
            font-size: 22px;
        }

        .group-image-picker strong {
            display: block;
            margin-bottom: 7px;
            color: #f1f2f5;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .group-image-picker span {
            display: block;
            color: #858c9a;
            font-size: 12px;
        }

        .group-image-picker input[type="file"] {
            display: none;
        }

        .group-image-preview {
            display: none;
            width: 150px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #343b49;
        }

        .group-image-preview.visible {
            display: block;
        }

        .group-alert {
            padding: 14px 16px;
            margin-bottom: 22px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.6;
        }

        .group-alert.success {
            color: #86efac;
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.25);
        }

        .group-alert.error {
            color: #fca5a5;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .group-error {
            display: block;
            margin-top: 8px;
            color: #f87171;
            font-size: 12px;
        }

        .group-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #252a35;
        }

        .group-btn {
            min-height: 45px;
            padding: 0 20px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 9px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .group-btn-secondary {
            color: #d0d4dc;
            background: #1b1f29;
            border: 1px solid #343a47;
        }

        .group-btn-secondary:hover {
            color: #fff;
            background: #252a35;
        }

        .group-btn-primary {
            color: #fff;
            background: #dc2626;
            border: 1px solid #dc2626;
        }

        .group-btn-primary:hover {
            background: #b91c1c;
            border-color: #b91c1c;
        }

        .group-btn-primary:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        @media (max-width: 600px) {
            .group-page {
                padding: 24px 14px;
            }

            .group-header h2 {
                font-size: 22px;
            }

            .group-card {
                padding: 21px 17px;
            }

            .group-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .group-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="group-page">
    <div class="group-container">

        <a href="{{ route('admin.dashboard') }}" class="group-back">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Dashboard
        </a>

        <div class="group-header">
            <div class="group-header-icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>

            <div>
                <h2>Create New Group</h2>
                <p>Create a menu group to organize your restaurant categories.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="group-alert success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="group-alert error">
                <strong>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Please fix the following errors:
                </strong>

                <ul style="margin:10px 0 0; padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="group-card">

            <h3 class="group-card-heading">
                <i class="fa-solid fa-pen-to-square" style="color:#ef4444;margin-right:8px;"></i>
                Group Information
            </h3>

            <form
                action="{{ route('admin.menu-groups.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="group-form"
                id="group-form"
            >
                @csrf

                <div style="margin-bottom:26px;">
                    <label for="name">
                        Group Name <span class="group-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="group-input"
                        value="{{ old('name') }}"
                        placeholder="e.g. Meals, Grills, Drinks"
                        maxlength="255"
                        required
                        autofocus
                    >

                    @error('name')
                        <span class="group-error">{{ $message }}</span>
                    @enderror

                    <div class="group-help">
                        This group will contain related menu categories.
                    </div>
                </div>

                <div>
                    <label for="image">
                        Group Image
                        <span style="color:#858c9a;font-weight:400;">(Optional)</span>
                    </label>

                    <label for="image" class="group-image-picker">

                        <img
                            id="image-preview"
                            class="group-image-preview"
                            alt="Group image preview"
                        >

                        <div class="group-image-icon" id="upload-icon">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>

                        <div>
                            <strong id="upload-title">Click to upload an image</strong>
                            <span id="upload-description">JPG, PNG or WEBP · Maximum 4 MB</span>
                        </div>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        >
                    </label>

                    @error('image')
                        <span class="group-error">{{ $message }}</span>
                    @enderror

                    <div class="group-help">
                        Choose an image that represents this menu group.
                    </div>
                </div>

                <div class="group-actions">
                    <a href="{{ route('admin.dashboard') }}" class="group-btn group-btn-secondary">
                        <i class="fa-solid fa-xmark"></i>
                        Cancel
                    </a>

                    <button type="submit" class="group-btn group-btn-primary" id="submit-btn">
                        <i class="fa-solid fa-plus"></i>
                        Create Group
                    </button>
                </div>
            </form>

        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('image');
    const preview = document.getElementById('image-preview');
    const title = document.getElementById('upload-title');
    const description = document.getElementById('upload-description');
    const icon = document.getElementById('upload-icon');
    const form = document.getElementById('group-form');
    const submitButton = document.getElementById('submit-btn');

    input.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) {
            preview.removeAttribute('src');
            preview.classList.remove('visible');
            title.textContent = 'Click to upload an image';
            description.textContent = 'JPG, PNG or WEBP · Maximum 4 MB';
            icon.style.display = 'flex';
            return;
        }

        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!allowedTypes.includes(file.type)) {
            this.value = '';
            alert('Please choose a JPG, PNG, or WEBP image.');
            return;
        }

        if (file.size > 4 * 1024 * 1024) {
            this.value = '';
            alert('The image must not exceed 4 MB.');
            return;
        }

        if (preview.dataset.objectUrl) {
            URL.revokeObjectURL(preview.dataset.objectUrl);
        }

        const objectUrl = URL.createObjectURL(file);
        preview.src = objectUrl;
        preview.dataset.objectUrl = objectUrl;
        preview.classList.add('visible');

        title.textContent = file.name;
        description.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        icon.style.display = 'none';
    });

    form.addEventListener('submit', function () {
        submitButton.disabled = true;
        submitButton.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin"></i> Creating...';
    });
});
</script>

</body>
</html>