@php
    $walkInCustomer = \App\Models\User::firstOrCreate(
        ['email' => 'walkin@alsalama.local'],
        [
            'name' => 'Walk-in',
            'password' => \Illuminate\Support\Facades\Hash::make(
                \Illuminate\Support\Str::random(32)
            ),
        ]
    );

    $selectedCustomer = request('customer_id')
        ? (\App\Models\User::find(request('customer_id')) ?? $walkInCustomer)
        : $walkInCustomer;
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AL SALAMA - New Order</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --red: #e63946;
            --red-dark: #c92d39;
            --bg: #0b0b0b;
            --white: #fff;
            --text: #fff;
            --muted: #888;
            --border: #292929;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            margin: 0;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: Tahoma, Arial, sans-serif;
            overflow: hidden;
        }

        a {
            text-decoration: none;
        }

        .container {
            width: 100%;
            max-width: none;
            height: 100vh;
            padding-top: 10px !important;
            padding-bottom: 10px;
            display: flex;
            flex-direction: column;
        }

        .container>.row {
            flex: 1;
            min-height: 0;
            height: calc(100vh - 55px);
        }

        .container>.row>[class*="col-"] {
            height: 100%;
            min-height: 0;
        }

        .product-buttons {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 7px;
            width: 100%;
        }

        .product-card {
            width: 100%;
            min-width: 0;
            padding: 5px;
            background: #181818;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            text-align: center;
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 38, 38, .2);
            border-color: var(--red) !important;
        }

        .product-card.active {
            border-color: var(--red);
            background: rgba(230, 57, 70, .1);
        }

        .product-card-image {
            width: 100%;
            height: 65px;
            border-radius: 7px;
            overflow: hidden;
            background: #101010;
            margin-bottom: 5px;
        }

        .product-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-card-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .product-card-name {
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
        }

        .product-card-price {
            color: var(--red);
            font-size: 10px;
            font-weight: 900;
        }

        .category-search {
            flex-shrink: 0;
            width: 100%;
            height: 38px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            background: #181818;
            border: 1px solid var(--border);
            border-radius: 9px;
            margin-bottom: 10px;
        }

        .category-search i {
            color: var(--red);
        }

        .category-search input {
            width: 100%;
            height: 100%;
            border: 0;
            outline: none;
            background: transparent;
            color: #fff;
            font-size: 11px;
        }

        .category-search input::placeholder {
            color: #777;
        }

        .gray-border {
            height: 100%;
            min-height: 0;
            border: 1px solid #666;
            padding: 10px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .gray-border:hover {
            border-color: #666 !important;
        }

        #category-area {
            flex: 1;
            min-height: 0;
        }

        #categories-view,
        #products-view {
            width: 100%;
        }

        .is-hidden {
            display: none !important;
        }

        .order-area {
            height: 100%;
            min-height: 0;
            background: #101010;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .order-top {
            flex-shrink: 0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
        }

        .order-type {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .order-type-btn {
            min-width: 95px;
            height: 38px;
            border: 1px solid #303030;
            background: #181818;
            border-radius: 9px;
            color: #888;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        .order-type-btn:hover,
        .order-type-btn.active {
            border-color: var(--red);
            color: var(--red);
            background: rgba(230, 57, 70, .1);
        }

        .customer-order-card {
            background: #101010;
            border: 1px solid var(--border);
            border-radius: 12px;
            width: 235px;
            min-width: 200px;
            padding: 8px;
            color: #fff;
        }

        .customer-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .customer-icon {
            width: 30px;
            height: 30px;
            border-radius: 9px;
            background: rgba(230, 57, 70, .12);
            border: 1px solid rgba(230, 57, 70, .25);
            color: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .customer-content {
            flex: 1;
            min-width: 0;
        }

        .customer-label {
            font-size: 10px;
            color: #888;
            margin-bottom: 3px;
        }

        .select-customer-btn {
            width: 100%;
            border: 0;
            background: transparent;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11px;
            font-weight: 800;
            color: #fff;
            cursor: pointer;
        }

        .select-customer-btn:hover {
            color: var(--red) !important;
        }

        .phone-section,
        .payment-section {
            margin-top: 7px;
        }

        .field-label {
            font-size: 10px;
            font-weight: 800;
            color: #ddd;
            margin-bottom: 4px;
        }

        .field-label i {
            color: var(--red);
            margin-left: 3px;
        }

        .phone-input {
            width: 100%;
            height: 28px;
            background: #181818;
            border: 1px solid #303030;
            border-radius: 7px;
            padding: 0 8px;
            outline: none;
            font-size: 10px;
            color: #fff;
        }

        .phone-input:focus {
            border-color: var(--red);
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 5px;
        }

        .payment-btn {
            min-height: 27px;
            border: 1px solid #303030;
            background: #181818;
            border-radius: 7px;
            color: #999;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            cursor: pointer;
            font-size: 9px;
            font-weight: 800;
            padding: 3px;
        }

        .payment-btn:hover,
        .payment-btn.active {
            border-color: var(--red);
            color: var(--red);
            background: rgba(230, 57, 70, .1);
        }

        .products-table-wrapper {
            width: 100%;
            flex: 1 1 0;
            min-height: 90px;
            overflow: auto;
            overscroll-behavior: contain;
            scrollbar-width: thin;
            scrollbar-color: var(--red) #171717;
            background: #101010;
            border: 1px solid var(--border);
            border-radius: 12px;
            margin: 0 0 10px;
        }

        .products-table-wrapper::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .products-table-wrapper::-webkit-scrollbar-track {
            background: #171717;
        }

        .products-table-wrapper::-webkit-scrollbar-thumb {
            background: var(--red);
            border: 2px solid #171717;
            border-radius: 10px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            color: #fff;
            font-size: 10px;
        }

        .products-table thead {
            background: #181818;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        .products-table thead th {
            padding: 8px 6px;
            text-align: center;
            color: var(--red);
            font-size: 9px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .products-table tbody tr {
            height: 40px;
            border-bottom: 1px solid #242424;
        }

        .products-table td {
            text-align: center;
            padding: 5px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .product-image {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            overflow: hidden;
            background: #181818;
            border: 1px solid #303030;
            margin: 0 auto;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-name {
            font-weight: 800;
            color: #fff;
        }

        .product-price {
            color: #aaa;
        }

        .product-total {
            color: var(--red);
            font-weight: 900;
        }

        .quantity-control {
            display: inline-flex;
            align-items: center;
            height: 25px;
            background: #181818;
            border: 1px solid #303030;
            border-radius: 6px;
            overflow: hidden;
        }

        .quantity-control button {
            width: 25px;
            height: 25px;
            border: 0;
            background: transparent;
            color: var(--red);
            cursor: pointer;
            font-weight: 900;
        }

        .quantity-control span {
            min-width: 23px;
            text-align: center;
            color: #fff;
        }

        .order-bottom {
            flex: 0 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            gap: 10px;
            margin-bottom: 10px;
        }

        .order-summary {
            width: 250px;
            max-width: 50%;
            padding: 8px;
            background: #101010;
            border: 1px solid var(--border);
            border-radius: 12px;
            color: #fff;
        }

        .summary-image {
            width: 100%;
            margin-bottom: 10px;
            flex-shrink: 0;
        }

        .summary-image img {
            width: 100%;
            height: 90px;
            height: 80px !important;
            object-fit: cover;
            display: block;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            min-height: 23px;
        }

        .summary-row span {
            color: #aaa;
            font-size: 10px;
        }

        .summary-row strong {
            color: var(--red);
            font-size: 11px;
        }

        .summary-divider {
            height: 1px;
            background: var(--border);
            margin: 4px 0;
        }

        .summary-final strong {
            font-size: 14px;
        }

        .calculator {
            width: 300px;
            max-width: 50%;
            height: 230px;
            height: 170px !important;
            flex-shrink: 0;
            padding: 7px;
            background: #101010;
            border: 1px solid var(--border);
            border-radius: 14px;
            color: #fff;
        }

        .calculator-display {
            margin-top: 5px;
            height: 42px;
            padding: 4px 9px;
            margin-bottom: 6px;
            background: #181818;
            border: 1px solid var(--border);
            border-radius: 9px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            text-align: right;
            overflow: hidden;
        }

        .calculator-expression {
            min-height: 9px;
            color: #777;
            font-size: 9px;
        }

        .calculator-result {
            color: #fff;
            font-size: 17px;
            font-weight: 800;
            line-height: 19px;
        }

        .calculator-buttons {
            height: 180px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            grid-template-rows: repeat(4, minmax(0, 1fr));
            gap: 4px;
        }

        .calc-btn {
            min-width: 0;
            min-height: 0;
            padding: 0;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: #1b1b1b;
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .calc-btn.operator {
            color: var(--red);
        }

        .calc-btn.clear {
            background: var(--red);
            border-color: var(--red);
        }

        .calc-btn.equals {
            grid-row: span 2;
            background: #d4a017;
            color: #111;
            border-color: #d4a017;
        }

        .calc-btn.zero {
            grid-column: span 2;
        }

        .order-actions {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            margin-top: auto;
            padding-top: 8px;
            background: #101010;
            position: relative;
            z-index: 5;
        }

        .order-btn {
            height: 38px;
            border-radius: 9px;
            padding: 0 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
        }

        .confirm-order {
            flex: 1;
            background: #151515;
            border: 1px solid #303030;
            color: var(--red);
        }

        .confirm-order:hover {
            border-color: var(--red);
            background: rgba(230, 57, 70, .1);
        }

        .confirm-order:disabled {
            opacity: .6;
            cursor: wait;
        }

        .cancel-order {
            width: 100px;
            flex-shrink: 0;
            background: var(--red);
            border: 1px solid var(--red);
            color: #fff;
        }

        .cancel-order:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
        }

        .back-btn {
            flex: 0 0 auto;
            height: 25px;
            color: #aaa;
            padding: 5px;
            margin-top: 4px !important;
            font-size: 11px;
        }

        .back-btn:hover {
            color: var(--red);
        }

        @media(max-width:1000px) {
            body {
                overflow: auto;
            }

            .container {
                height: auto;
                min-height: 100vh;
            }

            .container>.row {
                height: auto;
                flex: initial;
            }

            .container>.row>[class*="col-"] {
                height: auto;
                margin-bottom: 15px;
            }

            .gray-border {
                height: auto;
                min-height: 350px;
                overflow: visible;
            }

            .order-area {
                height: auto;
                min-height: 650px;
                overflow: visible;
            }

            .products-table-wrapper {
                flex: initial;
                height: 180px;
                min-height: 180px;
            }

            .order-actions {
                margin-top: 0;
            }

            .back-btn {
                margin-bottom: 10px;
            }
        }

        @media(max-width:650px) {
            .product-buttons {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .order-top {
                flex-direction: column;
            }

            .customer-order-card {
                width: 100%;
                max-width: none;
            }

            .order-bottom {
                flex-direction: column;
            }

            .order-summary,
            .calculator {
                width: 100%;
                max-width: none;
            }

            .calculator {
                height: 185px;
            }

            .products-table {
                min-width: 440px;
            }

            .order-actions {
                position: sticky;
                bottom: 0;
                padding: 8px 0;
            }
        }

        @media(max-width:420px) {
            .product-buttons {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .order-area {
                padding: 9px;
            }

            .order-type-btn {
                min-width: 90px;
            }

            .order-btn {
                padding: 0 8px;
            }

            .cancel-order {
                width: 85px;
            }
        }

        @media(min-width:1001px) and (max-height:750px) {
            .order-area {
                padding: 8px;
            }

            .order-top {
                gap: 7px;
                margin-bottom: 7px;
            }

            .customer-order-card {
                padding: 6px;
            }

            .phone-section,
            .payment-section {
                margin-top: 5px;
            }

            .order-bottom {
                gap: 7px;
                margin-bottom: 7px;
            }

            .calculator {
                height: 155px;
            }

            .calculator-display {
                height: 32px;
            }

            .calculator-buttons {
                height: 101px;
            }

            .summary-image {
                margin-bottom: 3px;
            }

            .summary-image img {
                height: 30px;
            }

            .summary-row {
                min-height: 20px;
            }

            .order-btn {
                height: 34px;
            }
        }
    </style>

    <style>
        .order-extra-fields {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .order-field {
            width: 100%;
        }

        .order-field label {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 4px;
            color: #f5f5f5;
            font-size: 10px;
            font-weight: 700;
        }

        .order-field label>i {
            color: #e63946;
            font-size: 10px;
        }

        .optional-label {
            margin-left: auto;
            color: #999;
            font-size: 9px;
            font-weight: 400;
        }

        .order-input-wrapper {
            display: flex;
            align-items: center;
            width: 100%;
            height: 30px;
            min-height: 30px;
            background: #151515;
            border: 1px solid #383838;
            border-radius: 6px;
            overflow: hidden;
            box-sizing: border-box;
            transition: border-color .2s, box-shadow .2s;
        }

        .order-input-wrapper:focus-within {
            border-color: #e63946;
            box-shadow: 0 0 0 2px rgba(230, 57, 70, .10);
        }

        .order-input-wrapper .input-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 100%;
            flex-shrink: 0;
            color: #e63946;
            font-size: 10px;
        }

        .order-input-wrapper input,
        .order-input-wrapper textarea {
            flex: 1;
            width: 100%;
            min-width: 0;
            height: 100%;
            padding: 0 6px;
            background: transparent;
            border: none;
            outline: none;
            color: #fff;
            font-family: inherit;
            font-size: 10px;
            box-sizing: border-box;
        }

        .order-input-wrapper input::placeholder,
        .order-input-wrapper textarea::placeholder {
            color: #777;
            font-size: 10px;
        }

        .order-input-wrapper input:focus,
        .order-input-wrapper textarea:focus {
            outline: none;
            box-shadow: none;
        }

        .input-suffix {
            padding: 0 7px;
            color: #e63946;
            font-size: 9px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .note-wrapper {
            height: 30px;
            min-height: 30px;
            align-items: center;
        }

        .note-wrapper .input-icon {
            padding-top: 0;
        }

        .order-input-wrapper textarea {
            resize: vertical;
            min-height: 30px;
            height: 30px;
            padding: 7px 6px;
            line-height: 1.4;
        }

        #delivery-fee-field.is-hidden {
            display: none;
        }

        /* =========================================
   AL SALAMA - DARK RED DELIVERY SELECT
========================================= */

        .order-input-wrapper select {
            flex: 1;
            width: 100%;
            min-width: 0;
            height: 100%;
            padding: 0 8px;
            background-color: #151515;
            color: #ffffff;
            border: none;
            outline: none;
            font-family: Tahoma, Arial, sans-serif;
            font-size: 10px;
            cursor: pointer;
            color-scheme: dark;
        }

        /* Select focus */
        .order-input-wrapper select:focus {
            outline: none;
            box-shadow: none;
            background-color: #151515;
            color: #ffffff;
        }

        /* Dropdown options */
        .order-input-wrapper select option {
            background-color: #151515;
            color: #ffffff;
            padding: 10px;
        }

        /* Selected option */
        .order-input-wrapper select option:checked {
            background-color: #e63946;
            color: #ffffff;
        }

        /* Hover and focus on wrapper */
        .order-input-wrapper:has(select:focus) {
            border-color: #e63946;
            box-shadow: 0 0 0 2px rgba(230, 57, 70, 0.10);
        }

        /* Placeholder option */
        .order-input-wrapper select option[value=""] {
            color: #888888;
        }

.quick-menu-filters {
    display: flex;
    gap: 12px;
    margin-bottom: 18px;
    flex-wrap: wrap;
}

.quick-menu-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 12px 20px;
    border: 1px solid rgba(230, 57, 70, .45);
    border-radius: 12px;
    background: #171b25;
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    transition: .2s ease;
}

.quick-menu-btn:hover,
.quick-menu-btn.active {
    background: #e63946;
    border-color: #e63946;
    color: #fff;
}

.quick-menu-btn i {
    color: inherit;
}
.quick-card-offers {
    background: linear-gradient(135deg, #713f12, #eab308);
    color: #fff;
    font-size: 35px;
}

.quick-card-settlements {
    background: linear-gradient(135deg, #4a1017, #e63946);
    color: #fff;
    font-size: 35px;
}

#today-offers-btn,
#settlements-btn {
    cursor: pointer;
}

    </style>


</head>

<body>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-6">
                <div class="product-card gray-border">
                    <div class="category-search">
                        <i class="fas fa-search"></i>
                        <input type="text" id="categorySearch" placeholder="Search categories...">
                    </div>

                    <div class="d-flex w-75">


                        {{-- QUICK MENU CARDS --}}
                        
                            <div class="product-card" id="today-offers-btn">
    <div class="product-card-image quick-card-offers">
        <i class="fas fa-tags"></i>
    </div>

    <div class="product-card-info">
        <span class="product-card-name">عروض اليوم</span>
    </div>
</div>  
                        
                            <div class="product-card" id="settlements-btn">
                                <div class="product-card-image quick-card-settlements">
                                    <i class="fas fa-receipt"></i>
                                </div>
                        
                                <div class="product-card-info">
                                    <span class="product-card-name">تسويات</span>
                                </div>
                            </div>
                        
                        
                                            {{-- GROUPS VIEW --}}
                        
                                                @foreach($groups as $group)
                                                    <div class="product-card group-card" data-group-id="{{ $group->id }}"
                                                        data-group-name="{{ $group->name }}">
                                                        <div class="product-card-image">
                                                            <img src="{{ $group->image ? asset('storage/' . $group->image) : asset('img/products/burger.jpg') }}"
                                                                alt="{{ $group->name }}">
                                                        </div>
                        
                                                        <div class="product-card-info">
                                                            <span class="product-card-name">
                                                                {{ $group->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                        

                    </div>
<hr>
                    {{-- CATEGORIES VIEW --}}
                    <div id="categories-view" class="is-hidden">

                        <div id="categories-grid" class="product-buttons">

                            {{-- BACK CARD --}}
                            <div class="product-card back-menu-btn" id="back-to-groups">
                                <div class="product-card-image back-card-image">
                                    <i class="fas fa-arrow-left"></i>
                                </div>

                                <div class="product-card-info">
                                    <span class="product-card-name">Back</span>
                                </div>
                            </div>

                            @foreach($categories as $category)
                                <div class="product-card category-card is-hidden" data-category-id="{{ $category->id }}"
                                    data-category-name="{{ $category->name }}" data-group-id="{{ $category->group_id }}">
                                    <div class="product-card-image">
                                        <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('img/products/burger.jpg') }}"
                                            alt="{{ $category->name }}">
                                    </div>

                                    <div class="product-card-info">
                                        <span class="product-card-name">
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>


                    {{-- PRODUCTS VIEW --}}
                    <div id="products-view" class="is-hidden">

                        <div id="products-grid" class="product-buttons">

                            {{-- BACK CARD --}}
                            <div class="product-card back-menu-btn" id="back-to-categories">
                                <div class="product-card-image back-card-image">
                                    <i class="fas fa-arrow-left"></i>
                                </div>

                                <div class="product-card-info">
                                    <span class="product-card-name">Back</span>
                                </div>
                            </div>

                        </div>
                    </div>


                    <a href="{{ route('admin.orders.index') }}" class="btn-orders">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Orders</span>
                    </a>

                    <style>
                        .btn-orders {
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            gap: 10px;
                            padding: 12px 22px;
                            background: #e63946;
                            color: #fff;
                            border: 1px solid #e63946;
                            border-radius: 10px;
                            font-size: 14px;
                            font-weight: 700;
                            text-decoration: none;
                            transition: all .25s ease;
                            box-shadow: 0 4px 14px rgba(230, 57, 70, .18);
                        }

                        .btn-orders:hover {
                            background: #080e1b;
                            color: #e63946;
                            border-color: #e63946;
                            transform: translateY(-2px);
                            box-shadow: 0 6px 20px rgba(230, 57, 70, .25);
                        }

                        .btn-orders i {
                            transition: transform .25s ease;
                        }

                        .btn-orders:hover i {
                            transform: translateX(-4px);
                        }
                    </style>


                    <style>
                        .is-hidden {
                            display: none !important;
                        }

                        #groups-view,
                        #categories-view,
                        #products-view,
                        #categories-grid,
                        #products-grid {
                            width: 100%;
                        }

                        .group-card,
                        .category-card,
                        .back-menu-btn,
                        .product-item {
                            cursor: pointer;
                        }

                        /* BACK CARD: SAME SIZE AND DESIGN AS OTHER CARDS */
                        .back-menu-btn {
                            overflow: hidden;
                            border: 1px solid #303030;
                            border-radius: 10px;
                            background: #181818;
                            color: #fff;
                            transition: border-color .2s, transform .2s;
                        }

                        .back-menu-btn:hover {
                            border-color: #e63946;
                            transform: translateY(-2px);
                        }

                        .back-card-image {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            background: #202020;
                            color: #e63946;
                            font-size: 24px;
                        }

                        .back-menu-btn:hover .back-card-image {
                            color: #fff;
                            background: #e63946;
                        }

                        /* ===== SCROLL FIX ===== */

                        html,
                        body {
                            scroll-behavior: auto !important;
                            overflow-anchor: none !important;
                        }

                        .gray-border {
                            height: 100%;
                            min-height: 0;
                            overflow-y: auto !important;
                            overflow-x: hidden !important;
                            overscroll-behavior-y: contain;
                            scroll-behavior: auto !important;
                            overflow-anchor: none !important;
                        }

                        /* منع القفز أثناء التنقل بين الأقسام */
                        #groups-view,
                        #categories-view,
                        #products-view {
                            overflow-anchor: none !important;
                            scroll-behavior: auto !important;
                        }

                        /* شكل الـ Scrollbar */
                        .gray-border::-webkit-scrollbar {
                            width: 7px;
                        }

                        .gray-border::-webkit-scrollbar-track {
                            background: #080808;
                            border-radius: 10px;
                        }

                        .gray-border::-webkit-scrollbar-thumb {
                            background: #e63946;
                            border-radius: 10px;
                        }

                        .gray-border::-webkit-scrollbar-thumb:hover {
                            background: #ff5964;
                        }

                        /* Firefox */
                        .gray-border {
                            scrollbar-width: thin;
                            scrollbar-color: #e63946 #080808;
                        }
                    </style>

                </div>
            </div>

            <div class="col-md-6">
                <div class="order-area">
                    <div class="order-top">
                        <div class="order-type">

                            <div class="d-flex">

                                <button type="button" class="order-type-btn active" data-type="delivery">
                                    <i class="fa-solid fa-motorcycle"></i><span>Delivery</span>
                                </button>
                                <button type="button" class="order-type-btn" data-type="takeaway">
                                    <i class="fa-solid fa-bag-shopping"></i><span>Takeaway</span>
                                </button>
                            </div>

                            <br>

                            <div class="order-extra-fields">

                                <div class="d-flex justify-content-between">

                                    <div class="order-field" id="delivery-fee-field"> <label for="delivery_fee"> <i
                                                class="fa-solid fa-motorcycle"></i> Delivery Fee </label>
                                        <div class="order-input-wrapper"> <span class="input-icon"> <i
                                                    class="fa-solid fa-coins"></i> </span> <input type="text"
                                                id="delivery_fee" name="delivery_fee" placeholder="Enter delivery fee">
                                            <span class="input-suffix">EGP</span>
                                        </div>
                                    </div>

                                    <div class="order-field" id="delivery-user-field">
                                        <label for="delivery_user_id">
                                            <i class="fa-solid fa-motorcycle"></i>
                                            Delivery Person
                                        </label>

                                        <div class="order-input-wrapper">
                                            <span class="input-icon">
                                                <i class="fa-solid fa-user"></i>
                                            </span>

                                            <select id="delivery_user_id" name="delivery_user_id">
                                                <option value="">Select delivery person</option>

                                                @foreach($deliveryUsers as $deliveryUser)
                                                    <option value="{{ $deliveryUser->id }}">
                                                        {{ $deliveryUser->name }}
                                                        {{ $deliveryUser->phone ? ' - ' . $deliveryUser->phone : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="order-field"> <label for="order_notes"> 
                                    <i class="fa-solid fa-note-sticky"></i>
                                        Order Note <span class="optional-label">Optional</span> </label>
                                    <div class="order-input-wrapper note-wrapper"> <span class="input-icon"> <i
                                                class="fa-solid fa-pen"></i> </span> <textarea id="order_notes"
                                            name="notes" rows="3" placeholder="Add a note"></textarea>

                                    </div>
                                </div>

                            </div>

                        </div>



                        <div class="customer-order-card">
                            <div class="customer-row">
                                <div class="customer-icon"><i class="fa-solid fa-user"></i></div>
                                <div class="customer-content">
                                    <div class="customer-label">Customer</div>
                                    <a href="{{ route('admin.orders.selectUser', ['order_type' => request('order_type', 'delivery')]) }}"
                                        class="select-customer-btn">
                                        {{ $selectedCustomer->name ?? 'Walk-in' }}
                                    </a>
                                    <input type="hidden" id="customer_id" value="{{ $selectedCustomer->id ?? '' }}">
                                </div>
                            </div>

                            <div class="phone-section">
                                <div class="field-label"><i class="fa-solid fa-phone"></i> Phone</div>
                                <input type="text" id="customer_phone" class="phone-input"
                                    placeholder="Customer phone number" value="{{ $selectedCustomer->phone ?? '' }}">
                            </div>

                            <div class="payment-section">
                                <div class="field-label">Payment Method</div>
                                <div class="payment-methods">
                                    <button type="button" class="payment-btn active" data-payment="cash">
                                        <i class="fa-solid fa-money-bill-wave"></i> Cash
                                    </button>
                                    <button type="button" class="payment-btn" data-payment="card">
                                        <i class="fa-solid fa-credit-card"></i> Card
                                    </button>
                                    <button type="button" class="payment-btn" data-payment="wallet">
                                        <i class="fa-solid fa-wallet"></i> Wallet
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products-table-wrapper">
                        <table class="products-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="order-items-body">
                                <tr id="empty-order-row">
                                    <td colspan="5" style="text-align:center;color:#777;padding:35px;">No products added
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="order-bottom">
                        <div class="order-summary">
                            <div class="summary-image">
                                <img src="{{ asset('img/black-fire-red-sport-car-wallpaper-smoke-background_796580-1816.avif') }}"
                                    alt="Logo">
                            </div>
                            <div class="summary-row"><span>Subtotal</span><strong id="subtotal">0.00 EGP</strong></div>
                            <div class="summary-row"><span>Discount</span><strong id="discount">0.00 EGP</strong></div>
                            <div class="summary-divider"></div>
                            <div class="summary-row summary-final"><span>Total Amount</span><strong id="total">0.00
                                    EGP</strong></div>
                        </div>

                        <div class="calculator">
                            <div class="calculator-display">
                                <div class="calculator-expression" id="expression"></div>
                                <div class="calculator-result" id="display">0</div>
                            </div>
                            <div class="calculator-buttons">
                                <button type="button" class="calc-btn clear" onclick="clearCalculator()">C</button>
                                <button type="button" class="calc-btn operator" onclick="chooseOperator('/')">÷</button>
                                <button type="button" class="calc-btn operator" onclick="chooseOperator('*')">×</button>
                                <button type="button" class="calc-btn operator" onclick="chooseOperator('-')">−</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('7')">7</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('8')">8</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('9')">9</button>
                                <button type="button" class="calc-btn operator" onclick="chooseOperator('+')">+</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('4')">4</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('5')">5</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('6')">6</button>
                                <button type="button" class="calc-btn equals" onclick="calculateResult()">=</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('1')">1</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('2')">2</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('3')">3</button>
                                <button type="button" class="calc-btn zero" onclick="appendNumber('0')">0</button>
                                <button type="button" class="calc-btn" onclick="appendNumber('.')">.</button>
                            </div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <button type="button" class="order-btn confirm-order" id="confirm-order">
                            <i class="fas fa-check"></i><span>Confirm Order</span>
                        </button>
                        <button type="button" class="order-btn cancel-order" onclick="window.location.reload()">
                            <i class="fas fa-times"></i><span>Cancel</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Elements
    const groupsView = document.getElementById('groups-view');
    const categoriesView = document.getElementById('categories-view');
    const productsView = document.getElementById('products-view');
    const quickMenuView = document.getElementById('quick-menu-view');
    const productsGrid = document.getElementById('products-grid');
    const orderItemsBody = document.getElementById('order-items-body');
    const categorySearch = document.getElementById('categorySearch');
    const confirmButton = document.getElementById('confirm-order');

    const deliveryFeeInput = document.getElementById('delivery_fee');
    const deliveryField = document.getElementById('delivery-fee-field');
    const deliveryUserField = document.getElementById('delivery-user-field');
    const orderNotesInput = document.getElementById('order_notes');

    const productsUrl = @json(route('admin.orders.category.products', ':id'));
    const searchProductsUrl = @json(route('admin.orders.products.search'));
    const storeUrl = @json(route('admin.orders.store'));
    const kitchenReceiptUrlTemplate = @json(route('admin.orders.kitchen-receipt', ['order' => '__ORDER_ID__']));
    const settlementsUrl = @json(route('admin.orders.settlements.create'));
    const todayOffersUrl = @json(route('admin.orders.todayOffers'));

    const csrfToken = document.querySelector('meta[name="csrf-token"]');

    let allProductsCache = null;
    let searchRequestNumber = 0;
    let selectedOrderType = @json(request('order_type', 'delivery'));
    let selectedPayment = 'cash';
    let isSubmitting = false;
    let currentViewMode = 'categories';

    if (!['delivery', 'takeaway', 'تسوية'].includes(selectedOrderType)) {
        selectedOrderType = 'delivery';
    }

    // Views
    function showView(view) {
        [groupsView, categoriesView, productsView].forEach(function (element) {
            if (element) {
                element.classList.add('is-hidden');
            }
        });

        if (view) {
            view.classList.remove('is-hidden');
        }
    }

    function showGroups() {
        currentViewMode = 'groups';
        showView(groupsView);

        if (quickMenuView) {
            quickMenuView.classList.remove('is-hidden');
        }
    }

    function showCategories() {
        currentViewMode = 'categories';
        showView(categoriesView);

        if (quickMenuView) {
            quickMenuView.classList.add('is-hidden');
        }
    }

    function showProducts() {
        showView(productsView);

        if (quickMenuView) {
            quickMenuView.classList.add('is-hidden');
        }
    }

    // Quick menu buttons
    const settlementsButton = document.getElementById('settlements-btn');
    const todayOffersButton = document.getElementById('today-offers-btn');

    if (settlementsButton) {
        settlementsButton.addEventListener('click', function () {
            window.location.href = settlementsUrl;
        });
    }

    // Today's offers
    if (todayOffersButton) {
        todayOffersButton.addEventListener('click', async function () {
            if (categorySearch) {
                categorySearch.value = '';
            }

            currentViewMode = 'offers';
            const requestNumber = ++searchRequestNumber;

            showProducts();

            if (productsGrid) {
                productsGrid.innerHTML = `
                    <div style="grid-column:1/-1;padding:30px;text-align:center;color:#aaa;">
                        Loading today's offers...
                    </div>`;
            }

            try {
                const response = await fetch(todayOffersUrl, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error("Failed to load today's offers.");
                }

                const data = await response.json();

                if (requestNumber !== searchRequestNumber) {
                    return;
                }

                renderProducts(data, 'offers');
            } catch (error) {
                console.error('Today Offers Error:', error);

                if (requestNumber !== searchRequestNumber || !productsGrid) {
                    return;
                }

                productsGrid.innerHTML = `
                    <div style="grid-column:1/-1;padding:30px;text-align:center;color:#e63946;">
                        Failed to load today's offers. Please try again.
                    </div>`;
            }
        });
    }

    // Order type
    function updateOrderFields(type) {
        selectedOrderType = type;

        const isDelivery = type === 'delivery';

        if (deliveryField) {
            deliveryField.classList.toggle('is-hidden', !isDelivery);
        }

        if (deliveryUserField) {
            deliveryUserField.classList.toggle('is-hidden', !isDelivery);
        }

        if (!isDelivery && deliveryFeeInput) {
            deliveryFeeInput.value = '0';
        }

        document.querySelectorAll('.order-type-btn').forEach(function (button) {
            button.classList.toggle('active', button.dataset.type === type);
        });

        updateSummary();
    }

    document.querySelectorAll('.order-type-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            updateOrderFields(this.dataset.type);
        });
    });

    // Product prices
    function getProductPrice(product) {
        const original = Number(product.price || 0);
        const discount = Number(product.discount_price || 0);

        if (discount > 0 && discount < original) {
            return discount;
        }

        return original;
    }

    function getProductImage(product) {
        if (!product.image) {
            return @json(asset('img/product/default.png'));
        }

        if (/^https?:\/\//i.test(product.image)) {
            return product.image;
        }

        return @json(asset('storage')) + '/' +
            String(product.image).replace(/^\/+/, '');
    }

    // Order summary
    function getSubtotal() {
        let subtotal = 0;

        if (!orderItemsBody) {
            return subtotal;
        }

        orderItemsBody.querySelectorAll('tr[data-product-id]').forEach(function (row) {
            const quantityElement = row.querySelector('.quantity-value');

            subtotal += Number(row.dataset.price || 0) *
                Number(quantityElement ? quantityElement.textContent : 1);
        });

        return subtotal;
    }

    function getDeliveryFee() {
        if (selectedOrderType !== 'delivery' || !deliveryFeeInput) {
            return 0;
        }

        const fee = Number(deliveryFeeInput.value || 0);

        return Number.isFinite(fee) && fee > 0 ? fee : 0;
    }

    function updateSummary() {
        const subtotal = getSubtotal();
        const deliveryFee = getDeliveryFee();
        const total = subtotal + deliveryFee;

        const subtotalElement = document.getElementById('subtotal');
        const discountElement = document.getElementById('discount');
        const totalElement = document.getElementById('total');

        if (subtotalElement) {
            subtotalElement.textContent = subtotal.toFixed(2) + ' EGP';
        }

        if (discountElement) {
            discountElement.textContent = '0.00 EGP';
        }

        if (totalElement) {
            totalElement.textContent = total.toFixed(2) + ' EGP';
        }
    }

    function checkEmptyOrder() {
        if (!orderItemsBody) {
            return;
        }

        if (!orderItemsBody.querySelector('tr[data-product-id]')) {
            orderItemsBody.innerHTML = `
                <tr id="empty-order-row">
                    <td colspan="5"
                        style="text-align:center;color:#777;padding:35px;">
                        No products added
                    </td>
                </tr>`;
        }

        updateSummary();
    }

    function updateProductTotal(row) {
        const quantityElement = row.querySelector('.quantity-value');
        const quantity = Number(quantityElement.textContent || 1);
        const price = Number(row.dataset.price || 0);
        const totalElement = row.querySelector('.product-total');

        if (totalElement) {
            totalElement.textContent = (price * quantity).toFixed(2) + ' EGP';
        }

        updateSummary();
    }

    // Add product to order
    function addProductToOrder(product) {
        if (!orderItemsBody || !product || !product.id) {
            return;
        }

        const emptyRow = document.getElementById('empty-order-row');

        if (emptyRow) {
            emptyRow.remove();
        }

        const existingRow = orderItemsBody.querySelector(
            'tr[data-product-id="' + product.id + '"]'
        );

        if (existingRow) {
            const quantity = existingRow.querySelector('.quantity-value');
            quantity.textContent = Number(quantity.textContent) + 1;
            updateProductTotal(existingRow);
            return;
        }

        const price = getProductPrice(product);
        const row = document.createElement('tr');

        row.dataset.productId = product.id;
        row.dataset.price = price;

        const imageCell = document.createElement('td');
        const imageWrapper = document.createElement('div');
        imageWrapper.className = 'product-image';

        const img = document.createElement('img');
        img.src = getProductImage(product);
        img.alt = product.name || 'Product';

        imageWrapper.appendChild(img);
        imageCell.appendChild(imageWrapper);

        const nameCell = document.createElement('td');
        nameCell.className = 'product-name';
        nameCell.textContent = product.name || 'Product';

        const priceCell = document.createElement('td');
        priceCell.className = 'product-price';
        priceCell.textContent = price.toFixed(2) + ' EGP';

        const quantityCell = document.createElement('td');
        const quantityControl = document.createElement('div');
        quantityControl.className = 'quantity-control';

        const minusButton = document.createElement('button');
        minusButton.type = 'button';
        minusButton.textContent = '−';

        const quantitySpan = document.createElement('span');
        quantitySpan.className = 'quantity-value';
        quantitySpan.textContent = '1';

        const plusButton = document.createElement('button');
        plusButton.type = 'button';
        plusButton.textContent = '+';

        quantityControl.append(minusButton, quantitySpan, plusButton);
        quantityCell.appendChild(quantityControl);

        const totalCell = document.createElement('td');
        totalCell.className = 'product-total';
        totalCell.textContent = price.toFixed(2) + ' EGP';

        row.append(imageCell, nameCell, priceCell, quantityCell, totalCell);
        orderItemsBody.appendChild(row);

        minusButton.addEventListener('click', function () {
            const quantity = Number(quantitySpan.textContent);

            if (quantity > 1) {
                quantitySpan.textContent = quantity - 1;
                updateProductTotal(row);
            } else {
                row.remove();
                checkEmptyOrder();
            }
        });

        plusButton.addEventListener('click', function () {
            quantitySpan.textContent = Number(quantitySpan.textContent) + 1;
            updateProductTotal(row);
        });

        updateSummary();
    }

    // Render products
    function renderProducts(data, mode) {
        if (!productsGrid) {
            return;
        }

        productsGrid.innerHTML = '';

        const products = Array.isArray(data)
            ? data
            : (Array.isArray(data.products) ? data.products : []);

        const currentMode = mode || currentViewMode;

        const backCard = document.createElement('div');
        backCard.className = 'product-card';

        backCard.innerHTML = `
            <div class="product-card-image"
                style="display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-arrow-left" style="font-size:24px;"></i>
            </div>
            <div class="product-card-info">
                <span class="product-card-name">Back</span>
            </div>`;

        backCard.addEventListener('click', function () {
            if (categorySearch && categorySearch.value.trim()) {
                categorySearch.value = '';
                categorySearch.dispatchEvent(new Event('input'));
                return;
            }

            if (currentMode === 'offers' || currentMode === 'search') {
                showCategories();
            } else {
                showCategories();
            }
        });

        productsGrid.appendChild(backCard);

        if (!products.length) {
            const empty = document.createElement('div');
            empty.style.cssText =
                'grid-column:1/-1;padding:30px 10px;text-align:center;color:#aaa;';
            empty.textContent = currentMode === 'offers'
                ? 'No discounted products available today.'
                : 'No products found.';

            productsGrid.appendChild(empty);
            return;
        }

        products.forEach(function (product) {
            const card = document.createElement('div');
            card.className = 'product-card product-item';

            const imageWrapper = document.createElement('div');
            imageWrapper.className = 'product-card-image';

            const img = document.createElement('img');
            img.src = getProductImage(product);
            img.alt = product.name || 'Product';

            imageWrapper.appendChild(img);

            const info = document.createElement('div');
            info.className = 'product-card-info';

            const name = document.createElement('span');
            name.className = 'product-card-name';
            name.textContent = product.name || 'Product';

            const price = document.createElement('div');
            price.className = 'product-card-price';

            const originalPrice = Number(product.price || 0);
            const discountPrice = Number(product.discount_price || 0);
            const hasDiscount =
                discountPrice > 0 && discountPrice < originalPrice;

            if (hasDiscount) {
                const oldPrice = document.createElement('span');
                oldPrice.style.cssText =
                    'text-decoration:line-through;color:#888;margin-right:6px;';
                oldPrice.textContent = originalPrice.toFixed(2);

                const newPrice = document.createElement('span');
                newPrice.style.cssText = 'color:#e63946;font-weight:700;';
                newPrice.textContent = discountPrice.toFixed(2);

                price.append(oldPrice, newPrice);
            } else {
                price.textContent = originalPrice.toFixed(2);
            }

            info.append(name, price);
            card.append(imageWrapper, info);

            card.addEventListener('click', function () {
                addProductToOrder(product);
            });

            productsGrid.appendChild(card);
        });
    }

    // Load products by category
    async function loadProductsByCategory(categoryId) {
        currentViewMode = 'category';
        showProducts();

        if (productsGrid) {
            productsGrid.innerHTML = `
                <div style="grid-column:1/-1;padding:30px;text-align:center;color:#aaa;">
                    Loading...
                </div>`;
        }

        const requestNumber = ++searchRequestNumber;

        try {
            const response = await fetch(
                productsUrl.replace(':id', encodeURIComponent(categoryId)),
                {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }
            );

            if (!response.ok) {
                throw new Error('Failed to load products.');
            }

            const data = await response.json();

            if (requestNumber !== searchRequestNumber) {
                return;
            }

            renderProducts(data, 'category');
        } catch (error) {
            console.error('Products Error:', error);

            if (requestNumber !== searchRequestNumber || !productsGrid) {
                return;
            }

            productsGrid.innerHTML = `
                <div style="grid-column:1/-1;padding:30px;text-align:center;color:#dc2626;">
                    Failed to load products.
                </div>`;
        }
    }

    // Groups -> categories
    const groupCards = document.querySelectorAll('.group-card');
    const categoryCards = document.querySelectorAll('.category-card');

    groupCards.forEach(function (card) {
        card.addEventListener('click', function () {
            const groupId = this.dataset.groupId;

            categoryCards.forEach(function (category) {
                const belongsToGroup = category.dataset.groupId === groupId;

                category.classList.toggle('is-hidden', !belongsToGroup);
                category.style.display = '';
            });

            showCategories();
        });
    });

    // Category cards
    document.querySelectorAll('.category-card[data-category-id]').forEach(function (category) {
        category.addEventListener('click', function () {
            loadProductsByCategory(this.dataset.categoryId);
        });
    });

    const backToGroups = document.getElementById('back-to-groups');
    const backToCategories = document.getElementById('back-to-categories');

    if (backToGroups) {
        backToGroups.addEventListener('click', function () {
            showGroups();
        });
    }

    if (backToCategories) {
        backToCategories.addEventListener('click', function () {
            showCategories();
        });
    }

    // Search products
    if (categorySearch) {
        categorySearch.placeholder = 'Search products...';

        categorySearch.addEventListener('input', async function () {
            const query = this.value.trim().toLowerCase();
            const requestNumber = ++searchRequestNumber;

            if (!query) {
                showCategories();

                document.querySelectorAll('#categories-view .category-card')
                    .forEach(function (card) {
                        card.style.display = '';
                    });

                return;
            }

            currentViewMode = 'search';
            showProducts();

            if (productsGrid) {
                productsGrid.innerHTML = `
                    <div style="grid-column:1/-1;padding:30px;text-align:center;color:#aaa;">
                        Searching products...
                    </div>`;
            }

            try {
                if (!allProductsCache) {
                    const response = await fetch(searchProductsUrl, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Failed to load products.');
                    }

                    const data = await response.json();

                    allProductsCache = Array.isArray(data)
                        ? data
                        : (Array.isArray(data.products) ? data.products : []);
                }

                if (requestNumber !== searchRequestNumber) {
                    return;
                }

                const filteredProducts = allProductsCache.filter(function (product) {
                    return String(product.name || '')
                        .toLowerCase()
                        .includes(query);
                });

                renderProducts(filteredProducts, 'search');
            } catch (error) {
                console.error('Product Search Error:', error);

                if (requestNumber !== searchRequestNumber) {
                    return;
                }

                if (productsGrid) {
                    productsGrid.innerHTML = `
                        <div style="grid-column:1/-1;padding:30px;text-align:center;color:#e63946;">
                            Failed to search products. Please try again.
                        </div>`;
                }
            }
        });
    }

    // Payment buttons
    document.querySelectorAll('.payment-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            document.querySelectorAll('.payment-btn').forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');
            selectedPayment = this.dataset.payment;
        });
    });

    if (deliveryFeeInput) {
        deliveryFeeInput.addEventListener('input', updateSummary);
    }

    // Calculator
    let currentValue = '0';
    let previousValue = null;
    let operator = null;

    const display = document.getElementById('display');
    const expression = document.getElementById('expression');

    function updateDisplay() {
        if (display) {
            display.textContent = currentValue;
        }
    }

    window.appendNumber = function (number) {
        if (number === '.' && currentValue.includes('.')) {
            return;
        }

        if (currentValue === 'Error') {
            currentValue = '0';
        }

        currentValue = currentValue === '0' && number !== '.'
            ? String(number)
            : currentValue + String(number);

        updateDisplay();
    };

    window.chooseOperator = function (selectedOperator) {
        if (currentValue === 'Error') {
            return;
        }

        if (operator !== null) {
            window.calculateResult();
        }

        previousValue = parseFloat(currentValue);
        operator = selectedOperator;

        if (expression) {
            expression.textContent = previousValue + ' ' + selectedOperator;
        }

        currentValue = '0';
        updateDisplay();
    };

    window.calculateResult = function () {
        if (operator === null || previousValue === null) {
            return;
        }

        const current = parseFloat(currentValue);
        let result;

        switch (operator) {
            case '+':
                result = previousValue + current;
                break;
            case '-':
                result = previousValue - current;
                break;
            case '*':
                result = previousValue * current;
                break;
            case '/':
                result = current === 0 ? 'Error' : previousValue / current;
                break;
            default:
                return;
        }

        if (expression) {
            expression.textContent =
                previousValue + ' ' + operator + ' ' + current + ' =';
        }

        currentValue = typeof result === 'number'
            ? String(Number(result.toFixed(8)))
            : result;

        previousValue = null;
        operator = null;

        updateDisplay();
    };

    window.clearCalculator = function () {
        currentValue = '0';
        previousValue = null;
        operator = null;

        if (expression) {
            expression.textContent = '';
        }

        updateDisplay();
    };

    // Confirm order
    if (confirmButton) {
        confirmButton.addEventListener('click', async function () {
            if (isSubmitting) {
                return;
            }

            if (!orderItemsBody) {
                alert('Order items are unavailable.');
                return;
            }

            const rows = Array.from(
                orderItemsBody.querySelectorAll('tr[data-product-id]')
            );

            if (!rows.length) {
                alert('Please add at least one product.');
                return;
            }

            const items = rows.map(function (row) {
                return {
                    product_id: Number(row.dataset.productId),
                    quantity: Number(
                        row.querySelector('.quantity-value').textContent
                    )
                };
            });

            const customerElement = document.getElementById('customer_id');
            const deliveryUserElement = document.getElementById('delivery_user_id');

            const customerId = customerElement
                ? customerElement.value || null
                : null;

            const deliveryUserId = deliveryUserElement
                ? deliveryUserElement.value
                : '';

            const notes = orderNotesInput ? orderNotesInput.value.trim() : '';
            const deliveryFee = getDeliveryFee();

            if (selectedOrderType === 'delivery' && !deliveryUserId) {
                alert('Please select a delivery person.');

                if (deliveryUserElement) {
                    deliveryUserElement.focus();
                }

                return;
            }

            const payload = {
                user_id: customerId,
                order_type: selectedOrderType === 'takeaway'
                    ? 'pickup'
                    : selectedOrderType === 'تسوية'
                        ? 'تسوية'
                        : 'delivery',
                payment_method: selectedPayment,
                delivery_user_id: selectedOrderType === 'delivery'
                    ? Number(deliveryUserId)
                    : null,
                delivery_fee: deliveryFee,
                notes: notes,
                items: items
            };

            isSubmitting = true;
            confirmButton.disabled = true;

            const buttonText = confirmButton.querySelector('span');
            const originalText = buttonText ? buttonText.textContent : '';

            if (buttonText) {
                buttonText.textContent = 'Creating Order...';
            }

            try {
                const headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                };

                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken.content;
                }

                const response = await fetch(storeUrl, {
                    method: 'POST',
                    headers: headers,
                    body: JSON.stringify(payload)
                });

                const rawResponse = await response.text();
                let result = {};

                try {
                    result = rawResponse ? JSON.parse(rawResponse) : {};
                } catch (error) {
                    result = {};
                }

                if (!response.ok) {
                    const validationMessage = result.errors
                        ? Object.values(result.errors).flat().join('\n')
                        : (result.message ||
                            'Server error (' + response.status + '). Check Laravel logs.');

                    throw new Error(validationMessage);
                }

                if (!result.success || !result.order_id) {
                    console.error('Unexpected server response:', rawResponse);

                    throw new Error(
                        result.message ||
                        'Order response is missing the order ID. Check the orders list before trying again.'
                    );
                }

                const receiptUrl = kitchenReceiptUrlTemplate.replace(
                    '__ORDER_ID__',
                    encodeURIComponent(String(result.order_id))
                );

                window.location.assign(receiptUrl + '?print=1');
            } catch (error) {
                console.error('Create Order Error:', error);

                alert(error.message || 'Something went wrong while creating the order.');

                isSubmitting = false;
                confirmButton.disabled = false;

                if (buttonText) {
                    buttonText.textContent = originalText;
                }
            }
        });
    }

    // Initial state
    const activeOrderType = document.querySelector('.order-type-btn.active');

    updateOrderFields(
        activeOrderType ? activeOrderType.dataset.type : selectedOrderType
    );

    updateDisplay();
    checkEmptyOrder();
});
</script>



</body>

</html>