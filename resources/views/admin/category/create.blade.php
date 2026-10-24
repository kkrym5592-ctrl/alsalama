<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category - AL SALAMA</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            background: #0b0b0b;
            color: #fff;
            font-family: Arial, Helvetica, sans-serif;
        }

        .create-category-page {
            min-height: 100vh;
            background: #0b0b0b;
            color: #fff;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-form-card {
            width: 100%;
            max-width: 600px;
            background: #101010;
            border: 1px solid #292929;
            border-radius: 16px;
            padding: 16px 22px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .35);
        }

        .back-dashboard {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            height: 30px;
            padding: 0 12px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: 1px solid #303030;
            background: #181818;
            color: #aaa;
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
            transition: .2s;
        }

        .back-dashboard:hover {
            border-color: #e63946;
            color: #e63946;
            background: #1d1d1d;
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .category-header-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(230, 57, 70, .12);
            border: 1px solid rgba(230, 57, 70, .25);
            color: #e63946;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .category-header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
        }

        .category-header p {
            margin: 3px 0 0;
            color: #777;
            font-size: 10px;
        }

        .form-group {
            margin-bottom: 11px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #ddd;
            font-size: 10px;
            font-weight: 800;
        }

        .form-group label i {
            color: #e63946;
            margin-right: 4px;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 36px;
            background: #181818;
            border: 1px solid #303030;
            border-radius: 9px;
            padding: 0 12px;
            color: #fff;
            outline: none;
            font-size: 11px;
        }

        select.form-control {
            cursor: pointer;
            color-scheme: dark;
        }

        textarea.form-control {
            height: 55px;
            padding: 9px 12px;
            resize: none;
        }

        .form-control:focus {
            border-color: #e63946;
            box-shadow: 0 0 0 2px rgba(230, 57, 70, .10);
        }

        .form-control::placeholder {
            color: #666;
        }

        .image-input {
            height: 37px;
            padding: 8px;
            cursor: pointer;
        }

        .active-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #181818;
            border: 1px solid #292929;
            border-radius: 9px;
            padding: 8px 12px;
        }

        .active-info strong {
            display: block;
            font-size: 10px;
            color: #fff;
        }

        .active-info span {
            display: block;
            margin-top: 3px;
            color: #666;
            font-size: 9px;
        }

        .active-row input {
            width: 16px;
            height: 16px;
            accent-color: #e63946;
            cursor: pointer;
        }

        .form-actions {
            display: flex;
            gap: 8px;
            margin-top: 14px;
        }

        .form-btn {
            height: 36px;
            border-radius: 9px;
            padding: 0 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            transition: .2s;
        }

        .save-btn {
            flex: 1;
            border: 1px solid #e63946;
            background: #e63946;
            color: #fff;
        }

        .save-btn:hover {
            background: #c92f3b;
            border-color: #c92f3b;
        }

        .cancel-btn {
            width: 100px;
            border: 1px solid #303030;
            background: #181818;
            color: #aaa;
        }

        .cancel-btn:hover {
            border-color: #e63946;
            color: #e63946;
        }

        .error-message {
            margin: 0 0 10px;
            padding: 8px 10px;
            color: #e63946;
            background: rgba(230, 57, 70, .08);
            border: 1px solid rgba(230, 57, 70, .2);
            border-radius: 8px;
            font-size: 10px;
        }

        @media (max-height: 650px) and (min-width: 601px) {
            .create-category-page {
                align-items: flex-start;
            }
        }

        @media (max-width: 600px) {
            .create-category-page {
                padding: 10px;
                align-items: flex-start;
            }

            .category-form-card {
                padding: 14px;
            }

            .form-actions {
                flex-direction: row;
            }

            .save-btn {
                width: auto;
            }

            .cancel-btn {
                width: 90px;
            }
        }
    </style>
</head>

<body>

<div class="create-category-page">
    <div class="category-form-card">

        <a href="{{ route('admin.dashboard') }}" class="back-dashboard">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Dashboard
        </a>

        <div class="category-header">
            <div class="category-header-icon">
                <i class="fas fa-layer-group"></i>
            </div>

            <div>
                <h2>Create Category</h2>
                <p>Add a new menu category</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form
            action="{{ route('admin.category.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            {{-- Group Selection --}}
            <div class="form-group">
                <label for="group_id">
                    <i class="fas fa-folder-open"></i>
                    Select Group
                </label>

                <select
                    name="group_id"
                    id="group_id"
                    class="form-control"
                    required
                >
                    <option value="">-- Select a Group --</option>

                    @foreach ($groups as $group)
                        <option
                            value="{{ $group->id }}"
                            {{ old('group_id') == $group->id ? 'selected' : '' }}
                        >
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Category Name --}}
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-tag"></i>
                    Category Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    placeholder="Enter category name"
                    value="{{ old('name') }}"
                    required
                >
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label for="description">
                    <i class="fas fa-align-left"></i>
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    placeholder="Enter category description..."
                >{{ old('description') }}</textarea>
            </div>

            {{-- Image --}}
            <div class="form-group">
                <label for="image">
                    <i class="fas fa-image"></i>
                    Category Image
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    class="form-control image-input"
                    accept="image/*"
                >
            </div>

            {{-- Active --}}
            <div class="form-group">
                <div class="active-row">
                    <div class="active-info">
                        <strong>Active Category</strong>
                        <span>Make this category visible to customers</span>
                    </div>

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', '1') ? 'checked' : '' }}
                    >
                </div>
            </div>

            {{-- Buttons --}}
            <div class="form-actions">
                <button type="submit" class="form-btn save-btn">
                    <i class="fas fa-check"></i>
                    Create Category
                </button>

                <a href="{{ route('admin.dashboard') }}" class="form-btn cancel-btn">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

</body>
</html>