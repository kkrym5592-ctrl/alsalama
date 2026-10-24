<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('customer.theme')

    <title>My Cart - AL SALAMA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>
        :root {
            --primary: #e63946;
            --primary-hover: #ff4d5a;
            --primary-soft: rgba(230, 57, 70, .12);

            --page-bg: #0b0d10;
            --card-bg: #15181d;
            --header-bg: #111418;
            --text: #f5f5f5;
            --text-secondary: #a7adb8;
            --text-muted: #8d95a3;
            --border: #272c34;
            --shadow: rgba(0, 0, 0, .25);
            --success: #27c982;
        }

        [data-theme="light"] {
            --page-bg: #f7f7f7;
            --card-bg: #ffffff;
            --header-bg: #ffffff;
            --text: #171717;
            --text-secondary: #666666;
            --text-muted: #8b8b8b;
            --border: #eeeeee;
            --shadow: rgba(0, 0, 0, .05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: var(--page-bg);
            color: var(--text);
            transition: background .25s ease, color .25s ease;
        }

        button,
        input {
            font: inherit;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            -webkit-tap-highlight-color: transparent;
        }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            height: 70px;
            background: var(--header-bg);
            border-bottom: 1px solid var(--border);
        }

        .header-inner {
            max-width: 1120px;
            height: 100%;
            margin: auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .back-btn {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            background: var(--card-bg);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s;
        }

        .back-btn:hover {
            color: var(--primary);
            border-color: var(--primary);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            box-shadow: 0 6px 18px rgba(230, 57, 70, .23);
        }

        .brand-text strong {
            display: block;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .2px;
        }

        .brand-text span {
            display: block;
            margin-top: 3px;
            color: var(--text-muted);
            font-size: 9px;
        }

        .header-spacer {
            flex: 1;
        }

        .header-cart {
            position: relative;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: var(--card-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: .2s;
        }

        .header-cart:hover,
        .header-cart.cart-added {
            border-color: var(--primary);
            color: var(--primary);
        }

        .cart-count {
            position: absolute;
            top: -7px;
            right: -7px;
            min-width: 19px;
            height: 19px;
            padding: 0 5px;
            border-radius: 20px;
            background: var(--primary);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 900;
            border: 2px solid var(--header-bg);
        }

        .page {
            width: 100%;
            max-width: 1120px;
            margin: auto;
            padding: 34px 20px 60px;
        }

        .page-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--primary);
            text-transform: uppercase;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .page-heading h1 {
            font-size: clamp(26px, 4vw, 36px);
            font-weight: 900;
            letter-spacing: -1.2px;
        }

        .page-heading p {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 9px;
            line-height: 1.6;
        }

        .continue-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
            transition: color .2s;
        }

        .continue-link:hover {
            color: var(--primary);
        }

        .alert {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid var(--border);
            background: var(--card-bg);
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.6;
        }

        .alert-success {
            border-color: rgba(39, 201, 130, .25);
            color: var(--success);
            background: rgba(39, 201, 130, .07);
        }

        .alert-error {
            border-color: rgba(230, 57, 70, .3);
            color: var(--primary);
            background: var(--primary-soft);
        }

        .cart-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 330px;
            align-items: start;
            gap: 22px;
        }

        .cart-main {
            min-width: 0;
        }

        .cart-section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 13px;
        }

        .cart-section-heading h2 {
            font-size: 14px;
            font-weight: 900;
        }

        .item-count-label {
            color: var(--text-muted);
            font-size: 10px;
            font-weight: 700;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .cart-item {
            min-width: 0;
            display: grid;
            grid-template-columns: 112px minmax(0, 1fr);
            gap: 17px;
            padding: 15px;
            border: 1px solid var(--border);
            background: var(--card-bg);
            border-radius: 17px;
            box-shadow: 0 7px 23px var(--shadow);
            transition: border-color .2s;
        }

        .cart-item:hover {
            border-color: rgba(230, 57, 70, .35);
        }

        .product-image {
            width: 112px;
            height: 112px;
            background: var(--page-bg);
            border: 1px solid var(--border);
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: var(--text-muted);
            font-size: 28px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-content {
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 13px;
        }

        .product-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .product-name {
            font-size: 14px;
            line-height: 1.5;
            font-weight: 900;
            overflow-wrap: anywhere;
        }

        .product-description {
            margin-top: 5px;
            max-width: 460px;
            color: var(--text-muted);
            font-size: 10px;
            line-height: 1.6;
        }

        .remove-form {
            flex-shrink: 0;
        }

        .remove-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text-muted);
            background: transparent;
            cursor: pointer;
            transition: .2s;
        }

        .remove-btn:hover {
            color: var(--primary);
            background: var(--primary-soft);
            border-color: var(--primary);
        }

        .product-bottom {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 12px;
        }

        .product-price {
            font-size: 15px;
            font-weight: 900;
            color: var(--primary);
            white-space: nowrap;
        }

        .price-old {
            display: block;
            margin-bottom: 4px;
            color: var(--text-muted);
            font-size: 10px;
            font-weight: 600;
            text-decoration: line-through;
        }

        .quantity-control {
            height: 36px;
            display: inline-flex;
            align-items: center;
            gap: 13px;
            padding: 0 5px;
            border: 1px solid var(--border);
            border-radius: 11px;
            background: var(--page-bg);
        }

        .quantity-form {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .quantity-btn {
            width: 26px;
            height: 26px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: var(--text);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s;
        }

        .quantity-btn:hover:not(:disabled) {
            background: var(--primary);
            color: white;
        }

        .quantity-btn:disabled {
            opacity: .3;
            cursor: not-allowed;
        }

        .quantity-number {
            min-width: 14px;
            text-align: center;
            font-size: 12px;
            font-weight: 900;
        }

        .unavailable-label {
            color: var(--primary);
            font-size: 10px;
            font-weight: 800;
        }

        .summary-card {
            position: sticky;
            top: 90px;
            padding: 21px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 10px 30px var(--shadow);
        }

        .summary-heading {
            font-size: 16px;
            font-weight: 900;
            margin-bottom: 20px;
        }

        .summary-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 16px;
            color: var(--text-secondary);
            font-size: 11px;
        }

        .summary-line strong {
            color: var(--text);
            font-size: 11px;
            font-weight: 800;
            text-align: right;
        }

        .summary-divider {
            height: 1px;
            background: var(--border);
            margin: 20px 0;
        }

        .summary-total {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 20px;
        }

        .summary-total span {
            font-size: 13px;
            font-weight: 800;
        }

        .summary-total strong {
            color: var(--primary);
            font-size: 21px;
            font-weight: 900;
            white-space: nowrap;
        }

        .checkout-btn {
            min-height: 48px;
            width: 100%;
            padding: 0 15px;
            border: 0;
            border-radius: 12px;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
            transition: background .2s, transform .2s, opacity .2s;
        }

        .checkout-btn:hover:not(:disabled) {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .checkout-btn:disabled {
            opacity: .4;
            cursor: not-allowed;
        }

        .secure-note {
            margin-top: 14px;
            text-align: center;
            color: var(--text-muted);
            font-size: 9px;
            line-height: 1.7;
        }

        .secure-note i {
            color: var(--success);
            margin-right: 4px;
        }

        .order-note {
            margin-top: 18px;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--page-bg);
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .order-note i {
            color: var(--primary);
            margin-top: 2px;
        }

        .order-note p {
            color: var(--text-muted);
            font-size: 10px;
            line-height: 1.7;
        }

        .empty-cart {
            padding: 55px 20px;
            border: 1px dashed var(--border);
            border-radius: 20px;
            background: var(--card-bg);
            text-align: center;
        }

        .empty-icon {
            width: 82px;
            height: 82px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 25px;
            color: var(--primary);
            background: var(--primary-soft);
            font-size: 30px;
        }

        .empty-cart h2 {
            font-size: 20px;
            font-weight: 900;
        }

        .empty-cart p {
            max-width: 340px;
            margin: 10px auto 22px;
            color: var(--text-muted);
            font-size: 12px;
            line-height: 1.8;
        }

        .browse-btn {
            min-height: 44px;
            padding: 0 19px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border-radius: 12px;
            color: #fff;
            background: var(--primary);
            font-size: 11px;
            font-weight: 900;
            transition: .2s;
        }

        .browse-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .site-footer {
            padding: 22px 20px;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 10px;
            text-align: center;
        }

        @media (max-width: 800px) {
            .cart-layout {
                grid-template-columns: minmax(0, 1fr);
            }

            .summary-card {
                position: static;
            }
        }

        @media (max-width: 520px) {
            .site-header {
                height: 64px;
            }

            .header-inner {
                padding: 0 13px;
                gap: 10px;
            }

            .brand-icon {
                width: 36px;
                height: 36px;
            }

            .brand-text strong {
                font-size: 11px;
            }

            .brand-text span {
                font-size: 8px;
            }

            .page {
                padding: 25px 13px 40px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 13px;
                margin-bottom: 21px;
            }

            .page-heading h1 {
                font-size: 28px;
            }

            .cart-item {
                grid-template-columns: 88px minmax(0, 1fr);
                gap: 12px;
                padding: 11px;
                border-radius: 14px;
            }

            .product-image {
                width: 88px;
                height: 94px;
                border-radius: 11px;
                font-size: 23px;
            }

            .product-name {
                font-size: 12px;
            }

            .product-description {
                font-size: 9px;
            }

            .product-bottom {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }

            .product-price {
                font-size: 13px;
            }

            .quantity-control {
                height: 32px;
                gap: 10px;
            }

            .quantity-btn {
                width: 24px;
                height: 24px;
            }

            .summary-card {
                padding: 17px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }

     .cart-note-box {
    margin-bottom: 18px;
    padding: 16px;
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 14px;
}

.cart-note-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 10px;
    color: var(--text);
    font-size: 12px;
    font-weight: 800;
}

.cart-note-label i {
    color: var(--primary);
    margin-right: 6px;
}

.cart-note-label small {
    color: var(--text-muted);
    font-size: 10px;
    font-weight: 600;
}

.cart-note-box textarea {
    display: block;
    width: 100%;
    min-height: 100px;
    padding: 13px 14px;
    resize: vertical;
    border: 1px solid var(--border);
    border-radius: 11px;
    outline: none;
    background: var(--page-bg);
    color: var(--text);
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    line-height: 1.8;
    transition: border-color .2s, box-shadow .2s;
}

.cart-note-box textarea::placeholder {
    color: var(--text-muted);
    opacity: .8;
}

.cart-note-box textarea:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(230, 57, 70, .10);
}

.cart-note-box textarea:focus-visible {
    outline: none;
}

@media (max-width: 520px) {
    .cart-note-box {
        padding: 13px;
    }

    .cart-note-box textarea {
        min-height: 90px;
        font-size: 12px;
    }
}

.cart-note-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    margin-bottom: 9px;
    font-size: 11px;
    font-weight: 800;
    color: var(--text);
}

.cart-note-label i {
    color: var(--primary);
    margin-right: 5px;
}

.cart-note-label small {
    color: var(--text-muted);
    font-size: 9px;
    font-weight: 600;
}

.cart-note-form textarea {
    width: 100%;
    min-height: 85px;
    resize: vertical;
    padding: 12px;
    border: 1px solid var(--border);
    border-radius: 11px;
    outline: none;
    background: var(--page-bg);
    color: var(--text);
    font-family: inherit;
    font-size: 11px;
    line-height: 1.7;
    transition: border-color .2s;
}

.cart-note-form textarea:focus {
    border-color: var(--primary);
}

.cart-note-form textarea::placeholder {
    color: var(--text-muted);
}

.save-note-btn {
    margin-top: 8px;
    width: 100%;
    min-height: 36px;
    border: 1px solid rgba(230, 57, 70, .3);
    border-radius: 10px;
    background: var(--primary-soft);
    color: var(--primary);
    font-size: 10px;
    font-weight: 800;
    cursor: pointer;
    transition: .2s;
}

.save-note-btn:hover {
    background: var(--primary);
    color: #fff;
}

.payment-label {
    margin-top: 18px;
}

.payment-select-wrap {
    position: relative;
}

.payment-select-wrap select {
    appearance: none;
    -webkit-appearance: none;
    width: 100%;
    min-height: 47px;
    padding: 0 42px 0 13px;
    border: 1px solid var(--border);
    border-radius: 11px;
    outline: none;
    background: var(--page-bg);
    color: var(--text);
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: border-color .2s, box-shadow .2s;
}

.payment-select-wrap select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(230, 57, 70, .10);
}

.payment-select-wrap select option {
    background: var(--card-bg);
    color: var(--text);
}

.payment-select-arrow {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    color: var(--primary);
    font-size: 11px;
    pointer-events: none;
}

.payment-hint {
    margin-top: 9px;
    color: var(--text-muted);
    font-size: 9px;
    line-height: 1.7;
}

.payment-hint i {
    color: var(--primary);
    margin-right: 4px;
}

    </style>
</head>

<body>

@php
    $cartItems = $cartItems ?? [];
    $cartCount = $cartCount ?? 0;
    $cartSubtotal = $cartSubtotal ?? 0;
    $canCheckout = $canCheckout ?? false;
@endphp

<header class="site-header">
    <div class="header-inner">

        <a href="{{ route('home') }}" class="back-btn" aria-label="Back to home">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <a href="{{ route('home') }}" class="brand">
            <span class="brand-icon">
                <i class="fa-solid fa-utensils"></i>
            </span>

            <span class="brand-text">
                <strong>AL SALAMA</strong>
                <span>Fresh · Fast · Delicious</span>
            </span>
        </a>

        <div class="header-spacer"></div>

        <a href="{{ route('cart') }}" class="header-cart" aria-label="Shopping cart">
            <i class="fa-solid fa-cart-shopping"></i>

            <span
                class="cart-count"
                id="cartCount"
                @if($cartCount < 1) style="display: none;" @endif
            >{{ $cartCount }}</span>
        </a>

    </div>
</header>


<main class="page">

    <div class="page-heading">
        <div>
            <span class="eyebrow">
                <i class="fa-solid fa-bag-shopping"></i>
                YOUR ORDER
            </span>

            <h1>My Cart<span style="color: var(--primary);">.</span></h1>

            <p>
                Review your items, adjust quantities, and get ready to order.
            </p>
        </div>

        <a href="{{ route('home') }}" class="continue-link">
            <i class="fa-solid fa-arrow-left"></i>
            Continue shopping
        </a>
    </div>


    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif


    @if(count($cartItems) > 0)

        <div class="cart-layout">

            {{-- CART ITEMS --}}
            <section class="cart-main">

                <div class="cart-section-heading">
                    <h2>Your Items</h2>

                    <span class="item-count-label">
                        {{ $cartCount }} {{ $cartCount === 1 ? 'item' : 'items' }}
                    </span>
                </div>


                <div class="cart-items">

                    @foreach($cartItems as $item)

                        @php
                            $product = $item['product'];
                            $quantity = $item['quantity'];

                            $rawImage = trim((string) ($product->image ?? ''));
                            $imageUrl = null;

                            if ($rawImage !== '') {
                                if (preg_match('/^https?:\/\//i', $rawImage)) {
                                    $imageUrl = $rawImage;
                                } elseif (str_starts_with($rawImage, '/')) {
                                    $imageUrl = $rawImage;
                                } elseif (
                                    str_starts_with($rawImage, 'img/') ||
                                    str_starts_with($rawImage, 'storage/')
                                ) {
                                    $imageUrl = asset($rawImage);
                                } else {
                                    $imageUrl = asset('storage/' . ltrim($rawImage, '/'));
                                }
                            }
                        @endphp

                        <article class="cart-item">

                            <div class="product-image">

                                @if($imageUrl)
                                    <img
                                        src="{{ $imageUrl }}"
                                        alt="{{ $product->name }}"
                                        loading="lazy"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                    >

                                    <span style="display:none; align-items:center; justify-content:center; width:100%; height:100%;">
                                        <i class="fa-solid fa-utensils"></i>
                                    </span>
                                @else
                                    <i class="fa-solid fa-utensils"></i>
                                @endif

                            </div>


                            <div class="product-content">

                                <div class="product-top">

                                    <div>
                                        <h3 class="product-name">
                                            {{ $product->name }}
                                        </h3>

                                        @if($product->description)
                                            <p class="product-description">
                                                {{ \Illuminate\Support\Str::limit($product->description, 95) }}
                                            </p>
                                        @endif
                                    </div>


                                    <form
                                        method="POST"
                                        action="{{ route('cart.remove', $product->id) }}"
                                        class="remove-form"
                                        onsubmit="return confirm('Remove this product from your cart?');"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="remove-btn"
                                            aria-label="Remove {{ $product->name }}"
                                            title="Remove item"
                                        >
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>

                                </div>


                                <div class="product-bottom">

                                    <div class="product-price">

                                        @if($item['has_discount'])
                                            <span class="price-old">
                                                EGP {{ number_format($item['original_price'], 2) }}
                                            </span>
                                        @endif

                                        EGP {{ number_format($item['unit_price'], 2) }}

                                    </div>


                                    @if($product->is_available)

                                        <div class="quantity-control">

                                            {{-- DECREASE QUANTITY --}}
                                            <form
                                                method="POST"
                                                action="{{ route('cart.update', $product->id) }}"
                                                class="quantity-form"
                                            >
                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="quantity"
                                                    value="{{ $quantity - 1 }}"
                                                >

                                                <button
                                                    type="submit"
                                                    class="quantity-btn"
                                                    aria-label="Decrease quantity"
                                                    @if($quantity <= 1) disabled @endif
                                                >
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                            </form>


                                            <span class="quantity-number">
                                                {{ $quantity }}
                                            </span>


                                            {{-- INCREASE QUANTITY --}}
                                            <form
                                                method="POST"
                                                action="{{ route('cart.update', $product->id) }}"
                                                class="quantity-form"
                                            >
                                                @csrf

                                                <input
                                                    type="hidden"
                                                    name="quantity"
                                                    value="{{ $quantity + 1 }}"
                                                >

                                                <button
                                                    type="submit"
                                                    class="quantity-btn"
                                                    aria-label="Increase quantity"
                                                    @if($quantity >= 99) disabled @endif
                                                >
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </form>

                                        </div>

                                    @else

                                        <span class="unavailable-label">
                                            Currently unavailable
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            </section>


            {{-- ORDER SUMMARY --}}
            <aside class="summary-card">

                <h2 class="summary-heading">Order Summary</h2>


                <div class="summary-line">
                    <span>Items ({{ $cartCount }})</span>

                    <strong>
                        EGP {{ number_format($cartSubtotal, 2) }}
                    </strong>
                </div>


{{-- Form submitted only when clicking checkout --}}
<form
    id="cartCheckoutForm"
    method="POST"
    action="{{ route('cart.checkout') }}"
>
    @csrf
</form>


<div class="cart-note-box">

    <label for="cartNotes" class="cart-note-label">
        <span>
            <i class="fa-regular fa-note-sticky"></i>
            Order Note
        </span>
        <small>Optional</small>
    </label>

    <textarea
        id="cartNotes"
        name="notes"
        form="cartCheckoutForm"
        rows="3"
        maxlength="1000"
        placeholder="Any special instructions for your order?"
    >{{ old('notes', session('cart_note', '')) }}</textarea>


    <label for="paymentMethod" class="cart-note-label payment-label">
        <span>
            <i class="fa-solid fa-credit-card"></i>
            Payment Method
        </span>
        <small>Required</small>
    </label>

    <div class="payment-select-wrap">
        <select
            id="paymentMethod"
            name="payment_method"
            form="cartCheckoutForm"
            required
        >
            <option
                value="cash"
                @selected(old('payment_method', session('cart_payment_method', 'cash')) === 'cash')
            >
                Cash
            </option>

            <option
                value="wallet"
                @selected(old('payment_method', session('cart_payment_method', 'cash')) === 'wallet')
            >
                Wallet
            </option>

            <option
                value="card"
                @selected(old('payment_method', session('cart_payment_method', 'cash')) === 'card')
            >
                Card
            </option>
        </select>

        <i class="fa-solid fa-chevron-down payment-select-arrow"></i>
    </div>

    <p class="payment-hint">
        <i class="fa-solid fa-circle-info"></i>
        Choose how you intend to pay for your order.
    </p>

</div>



                <div class="summary-divider"></div>


                <div class="summary-total">
                    <span>Subtotal</span>

                    <strong>
                        EGP {{ number_format($cartSubtotal, 2) }}
                    </strong>
                </div>


                @if($canCheckout)

                    <button
    type="submit"
    form="cartCheckoutForm"
    class="checkout-btn"
>
     تاكيد الطلب
    <i class="fa-solid fa-arrow-right"></i>
</button>

                @else

                    <button type="button" class="checkout-btn" disabled>
                        @if($cartCount > 0)
                            Remove unavailable items first
                        @else
                            Your cart is empty
                        @endif
                    </button>

                @endif


                <div class="secure-note">
                    <i class="fa-solid fa-shield-halved"></i>
                    Your order will be reviewed before preparation.
                </div>


                <div class="order-note">
                    <i class="fa-solid fa-circle-info"></i>

                    <p>
                        Pickup is the default order type. The cashier can adjust
                        the order type later if needed. Add any special requests
                        on the checkout page.
                    </p>
                </div>

            </aside>

        </div>

    @else

        {{-- EMPTY CART --}}
        <section class="empty-cart">

            <div class="empty-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>

            <h2>Your cart is empty</h2>

            <p>
                Looks like you haven't added anything yet.
                Discover something delicious from our menu.
            </p>

            <a href="{{ route('home') }}" class="browse-btn">
                <i class="fa-solid fa-utensils"></i>
                Explore Menu
            </a>

        </section>

    @endif

</main>


<footer class="site-footer">
    © {{ date('Y') }} AL SALAMA. Fresh · Fast · Delicious.
</footer>


</body>
</html>