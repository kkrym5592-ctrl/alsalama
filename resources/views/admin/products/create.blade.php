<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Product - AL SALAMA</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        min-height: 100vh;
        background: #0b0b0b;
        color: #fff;
        font-family: Arial, sans-serif;
    }

    .page {
        width: 100%;
        min-height: 100vh;
        padding: 25px 30px;
    }

    /* =========================
       HEADER
    ========================= */

    .page-header {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 800;
        margin: 0;
    }

    .page-title i {
        color: #e63946;
        margin-right: 7px;
    }

    /* =========================
       BACK BUTTON
    ========================= */

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 15px;
        border: 1px solid #292929;
        border-radius: 8px;
        color: #fff;
        text-decoration: none;
        background: #181818;
        font-size: 13px;
        font-weight: 700;
    }

    .back-btn:hover {
        color: #fff;
        background: #181818;
        border-color: #292929;
    }

    /* =========================
       FORM CARD
    ========================= */

    .form-card {
        width: 100%;
        max-width: none;
        background: #121212;
        border: 1px solid #292929;
        border-radius: 10px;
        padding: 15px;
    }

    /* =========================
       LABEL
    ========================= */

    .form-label {
        color: #ddd;
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 7px;
    }

    /* =========================
       INPUTS
    ========================= */

    .form-control,
    .form-select {
        width: 100%;
        background: #181818;
        border: 1px solid #292929;
        color: #fff;
        border-radius: 8px;
        min-height: 42px;
        font-size: 13px;
    }

    .form-control:hover,
    .form-select:hover {
        border-color: #292929;
    }

    .form-control:focus,
    .form-select:focus {
        background: #181818;
        color: #fff;
        border-color: #e63946;
        box-shadow: 0 0 0 2px rgba(230, 57, 70, .10);
    }

    .form-control::placeholder {
        color: #666;
    }

    .form-select option {
        background: #181818;
        color: #fff;
    }

    textarea.form-control {
        min-height: 105px;
        resize: vertical;
    }

    /* =========================
       IMAGE
    ========================= */

    .image-box {
        width: 100%;
        border: 1px dashed #333;
        border-radius: 9px;
        padding: 14px;
        background: #181818;
    }

    .image-box .form-control {
        border: 0;
        padding: 5px;
        background: transparent;
    }

    /* =========================
       CHECKBOX
    ========================= */

    .form-check {
        padding: 12px 15px;
        background: #181818;
        border: 1px solid #292929;
        border-radius: 8px;
    }

    .form-check-input {
        background-color: #181818;
        border-color: #444;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #e63946;
        border-color: #e63946;
    }

    .form-check-label {
        color: #ddd;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    /* =========================
       SAVE BUTTON
    ========================= */

    .save-btn {
        border: 0;
        background: #e63946;
        color: #fff;
        padding: 11px 22px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 800;
    }

    .save-btn:hover {
        background: #e63946;
        color: #fff;
    }

    /* =========================
       CANCEL BUTTON
    ========================= */

    .cancel-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 22px;
        border: 1px solid #292929;
        background: #181818;
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
    }

    .cancel-btn:hover {
        background: #181818;
        color: #fff;
        border-color: #292929;
    }

    /* =========================
       ERRORS
    ========================= */

    .error-box {
        background: rgba(230, 57, 70, .10);
        border: 1px solid rgba(230, 57, 70, .35);
        color: #ff8b94;
        border-radius: 8px;
        padding: 12px 15px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .error-box ul {
        padding-left: 20px;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .page {
            padding: 15px;
        }

        .page-header {
            align-items: flex-start;
            gap: 15px;
        }

        .page-title {
            font-size: 20px;
        }

        .form-card {
            padding: 15px;
        }

    }

</style>

</head>

<body>

<div class="page">

<!-- =========================
     HEADER
========================= -->

<div class="page-header">

    <div>

        <h1 class="page-title">

            <i class="fa-solid fa-plus"></i>

            Add Product

        </h1>

    </div>


    <a
        href="{{ route('admin.dashboard') }}"
        class="back-btn"
    >

        <i class="fa-solid fa-arrow-left"></i>

        Dashboard

    </a>

</div>


<!-- =========================
     ERRORS
========================= -->

@if ($errors->any())

    <div class="error-box">

        <strong>
            Please fix the following errors:
        </strong>

        <ul class="mb-0 mt-2">

            @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


<!-- =========================
     FORM
========================= -->

<div class="form-card">

    <form
        action="{{ route('admin.products.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="row g-3">


            <!-- PRODUCT NAME -->

            <div class="col-md-6">

                <label class="form-label">
                    Product Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Enter product name"
                    required
                >

            </div>


            <!-- CATEGORY -->

            <div class="col-md-6">

                <label class="form-label">
                    Category
                </label>

                <select
                    name="category_id"
                    class="form-select"
                    required
                >

                    <option value="">
                        Select Category
                    </option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <!-- PRICE -->

            <div class="col-md-6">

                <label class="form-label">
                    Price
                </label>

                <input
                    type="number"
                    name="price"
                    class="form-control"
                    value="{{ old('price') }}"
                    min="0"
                    step="0.01"
                    placeholder="0.00"
                    required
                >

            </div>


            <!-- DISCOUNT -->

            <div class="col-md-6">

                <label class="form-label">
                    Discount Price
                </label>

                <input
                    type="number"
                    name="discount_price"
                    class="form-control"
                    value="{{ old('discount_price') }}"
                    min="0"
                    step="0.01"
                    placeholder="Optional"
                >

            </div>


            <!-- DESCRIPTION -->

            <div class="col-12">

                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    class="form-control"
                    placeholder="Enter product description"
                >{{ old('description') }}</textarea>

            </div>


            <!-- IMAGE -->

            <div class="col-12">

                <label class="form-label">
                    Product Image
                </label>

                <div class="image-box">

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept="image/*"
                    >

                </div>

            </div>


            


            <!-- BUTTONS -->

            <div class="col-12">

                <div class="d-flex gap-2 ">

                    <button
                        type="submit"
                        class="save-btn"
                    >

                        <i class="fa-solid fa-check"></i>

                        Create Product

                    </button>


                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="cancel-btn"
                    >

                        Cancel

                    </a>

                </div>

            </div>


        </div>

    </form>

</div>

</div>

</body>

</html>
