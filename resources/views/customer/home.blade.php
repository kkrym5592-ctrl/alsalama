 <!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#09090d">

    @include('customer.theme')

    <title>AL SALAMA — Discover Your Cravings</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @php
        $imageUrl = function ($path) {
            if (!$path) {
                return null;
            }

            if (
                str_starts_with($path, 'http://') ||
                str_starts_with($path, 'https://')
            ) {
                return $path;
            }

            if (
                str_starts_with($path, 'img/') ||
                str_starts_with($path, 'images/') ||
                str_starts_with($path, 'storage/')
            ) {
                return asset($path);
            }

            return asset('storage/' . ltrim($path, '/'));
        };

        $cartCount = array_sum(session('cart', []));
    @endphp

    <style>
        :root {
            color-scheme: dark;

            --red: #ff3548;
            --red-light: #ff6573;
            --red-dark: #a50e25;
            --red-soft: rgba(255, 53, 72, .12);
            --red-glow: rgba(255, 53, 72, .28);

            --bg: #09090d;
            --surface: #101016;
            --surface-2: #15151d;
            --surface-3: #1b1b24;

            --text: #faf8fa;
            --muted: #9998a6;
            --border: rgba(255, 255, 255, .085);
            --image-bg: #17151b;

            --radius: 22px;
            --shadow: 0 18px 55px rgba(0, 0, 0, .24);
        }

        [data-theme="light"] {
            color-scheme: light;

            --bg: #f6f5f7;
            --surface: #ffffff;
            --surface-2: #f1eff3;
            --surface-3: #e9e6eb;

            --text: #18151a;
            --muted: #77717c;
            --border: rgba(25, 15, 25, .09);
            --image-bg: #efedf0;

            --shadow: 0 15px 45px rgba(30, 10, 20, .07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 100px;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            padding-bottom: 85px;
            background:
                radial-gradient(ellipse at 10% 8%, rgba(135, 13, 38, .13), transparent 34%),
                radial-gradient(ellipse at 95% 35%, rgba(255, 53, 72, .055), transparent 30%),
                var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            transition: background .25s, color .25s;
        }

        body::before {
            content: "";
            position: fixed;
            z-index: -1;
            inset: 0;
            pointer-events: none;
            opacity: .22;
            background:
                radial-gradient(ellipse at 15% 0%, rgba(255, 53, 72, .09), transparent 38%),
                radial-gradient(ellipse at 85% 20%, rgba(110, 28, 66, .09), transparent 38%);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        button:focus-visible,
        a:focus-visible,
        input:focus-visible {
            outline: 2px solid var(--red-light);
            outline-offset: 4px;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .page-container {
            width: min(1320px, 100%);
            margin: auto;
            padding: 0 28px;
        }

        /* HEADER */

        .header {
            position: sticky;
            top: 0;
            z-index: 1000;
            margin: 0 -28px;
            padding: 15px 28px;
            border-bottom: 1px solid var(--border);
            background: color-mix(in srgb, var(--bg) 86%, transparent);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
            width: min(1264px, 100%);
            margin: auto;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .brand-icon {
            position: relative;
            width: 47px;
            height: 47px;
            display: grid;
            place-items: center;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 15px;
            background: linear-gradient(145deg, #ff5665, #b50e2b 75%);
            box-shadow: 0 7px 28px rgba(255, 53, 72, .24);
            color: #fff;
            font-size: 19px;
        }

        .brand-icon::after {
            content: "";
            position: absolute;
            inset: -60%;
            background: linear-gradient(110deg, transparent 35%, rgba(255, 255, 255, .2), transparent 65%);
            transform: rotate(20deg);
        }

        .brand h1 {
            font-size: 16px;
            font-weight: 900;
            letter-spacing: 1.1px;
        }

        .brand small {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 2.4px;
        }

        .header-icons {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .header-btn,
        .header-settings,
        .header-cart {
            position: relative;
            width: 43px;
            height: 43px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--surface);
            color: var(--text);
            transition: .25s ease;
        }

        .header-btn:hover,
        .header-settings:hover,
        .header-cart:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 53, 72, .5);
            background: var(--red-soft);
            color: var(--red-light);
        }

        .cart-count {
            position: absolute;
            top: -7px;
            right: -7px;
            min-width: 20px;
            height: 20px;
            padding: 0 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--bg);
            border-radius: 20px;
            background: var(--red);
            color: white;
            font-size: 10px;
            font-weight: 900;
        }

        .new-user-btn {
            min-height: 43px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 16px;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 14px;
            background: linear-gradient(135deg, #ff4658, #d51c36);
            box-shadow: 0 7px 22px rgba(255, 53, 72, .17);
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
            transition: .25s;
        }

        .new-user-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 53, 72, .3);
            color: white;
        }

        /* AURORA HERO */

        .hero {
            position: relative;
            isolation: isolate;
            min-height: 390px;
            margin-top: 30px;
            padding: 46px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 30px;
            background: #130b12;
            box-shadow: var(--shadow);
        }

        .hero::before {
            content: "";
            position: absolute;
            z-index: -2;
            inset: -35%;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(174, 17, 48, .85), transparent 35%),
                radial-gradient(ellipse at 65% 35%, rgba(255, 53, 72, .32), transparent 31%),
                radial-gradient(ellipse at 85% 70%, rgba(93, 15, 70, .48), transparent 35%),
                radial-gradient(ellipse at 50% 90%, rgba(47, 10, 30, .8), transparent 45%);
            filter: blur(12px);
            animation: auroraMove 13s ease-in-out infinite alternate;
        }

        .hero::after {
            content: "";
            position: absolute;
            z-index: -1;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(9, 5, 10, .68), rgba(9, 5, 10, .16) 70%),
                linear-gradient(0deg, rgba(9, 5, 10, .34), transparent 60%);
            pointer-events: none;
        }

        @keyframes auroraMove {
            0% {
                transform: translate3d(-3%, -2%, 0) rotate(-5deg) scale(1);
            }

            100% {
                transform: translate3d(3%, 2%, 0) rotate(5deg) scale(1.12);
            }
        }

        .offers-slider {
            display: block;
        }

        .hero-slide {
            display: none;
            align-items: center;
            justify-content: space-between;
            gap: 38px;
            min-height: 296px;
            animation: slideEnter .55s ease both;
        }

        .hero-slide.active {
            display: flex;
        }

        @keyframes slideEnter {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            flex: 1;
            min-width: 0;
            max-width: 660px;
        }

        .hero-label {
            width: fit-content;
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 23px;
            padding: 9px 13px;
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 30px;
            background: rgba(255, 255, 255, .08);
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            backdrop-filter: blur(10px);
        }

        .hero-label i {
            color: #ff6573;
            filter: drop-shadow(0 0 8px rgba(255, 53, 72, .65));
        }

        .hero h2 {
            max-width: 650px;
            margin-bottom: 17px;
            color: #fff;
            font-size: clamp(34px, 4.5vw, 58px);
            font-weight: 900;
            line-height: 1.08;
            letter-spacing: -2.1px;
            overflow-wrap: anywhere;
        }

        .hero h2 .hero-highlight {
            color: #ff6676;
            text-shadow: 0 0 32px rgba(255, 53, 72, .2);
        }

        .hero p {
            max-width: 480px;
            margin-bottom: 24px;
            color: rgba(255, 255, 255, .74);
            font-size: 13px;
            line-height: 1.9;
        }

        .hero-btn {
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 11px;
            padding: 0 19px;
            border: 1px solid rgba(255, 255, 255, .13);
            border-radius: 13px;
            background: linear-gradient(135deg, #ff4b5e, #d91e38);
            box-shadow: 0 8px 25px rgba(255, 53, 72, .23);
            color: #fff;
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            transition: transform .22s, box-shadow .22s, background .22s;
        }

        .hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(255, 53, 72, .34);
            color: #fff;
        }

        .hero-btn:disabled {
            cursor: wait;
            opacity: .65;
            transform: none;
        }

        .offer-preview {
            position: relative;
            z-index: 2;
            width: min(37%, 320px);
            height: 265px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 27px;
            background:
                radial-gradient(circle at 50% 50%, rgba(255, 53, 72, .2), transparent 70%),
                rgba(255, 255, 255, .055);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .25), inset 0 0 30px rgba(255, 255, 255, .035);
            backdrop-filter: blur(8px);
        }

        .offer-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .offer-preview .offer-emoji {
            font-size: 100px;
            filter: drop-shadow(0 15px 20px rgba(0, 0, 0, .25));
        }

        .offer-discount {
            position: absolute;
            top: 13px;
            right: 13px;
            padding: 9px 11px;
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 10px;
            background: rgba(255, 53, 72, .94);
            box-shadow: 0 7px 20px rgba(0, 0, 0, .2);
            color: #fff;
            font-size: 11px;
            font-weight: 900;
        }

        .offer-prices {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 13px;
            margin: 0 0 23px;
        }

        .offer-old-price {
            color: rgba(255, 255, 255, .53);
            font-size: 14px;
            text-decoration: line-through;
        }

        .offer-new-price {
            color: #fff;
            font-size: 24px;
            font-weight: 900;
        }

        .offer-controls {
            position: relative;
            z-index: 5;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 14px;
        }

        .offer-nav-btn {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 50%;
            background: rgba(255, 255, 255, .07);
            color: #fff;
            font-size: 11px;
            cursor: pointer;
            transition: .2s;
        }

        .offer-nav-btn:hover {
            border-color: var(--red);
            background: var(--red);
        }

        .offer-dots {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .offer-dot {
            width: 7px;
            height: 7px;
            padding: 0;
            border: 0;
            border-radius: 20px;
            background: rgba(255, 255, 255, .35);
            cursor: pointer;
            transition: .25s;
        }

        .offer-dot.active {
            width: 23px;
            background: var(--red-light);
            box-shadow: 0 0 12px rgba(255, 53, 72, .5);
        }

        /* SECTIONS */

        .section {
            margin-top: 47px;
            scroll-margin-top: 105px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 20px;
        }

        .section-eyebrow {
            display: block;
            margin-bottom: 8px;
            color: var(--red-light);
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 2.4px;
            text-transform: uppercase;
        }

        .section-title {
            font-size: clamp(20px, 2.5vw, 26px);
            font-weight: 900;
            letter-spacing: -.8px;
        }

        .section-subtitle {
            margin-top: 7px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
        }

        .section-link {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--red-light);
            font-size: 11px;
            font-weight: 800;
            transition: gap .2s;
        }

        .section-link:hover {
            gap: 12px;
        }

        /* CATEGORIES */

        .categories {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            padding: 3px 2px 15px;
            scrollbar-width: thin;
            scrollbar-color: var(--red) transparent;
        }

        .categories::-webkit-scrollbar,
        .products-scroll::-webkit-scrollbar {
            height: 4px;
        }

        .categories::-webkit-scrollbar-thumb,
        .products-scroll::-webkit-scrollbar-thumb {
            border-radius: 20px;
            background: var(--red);
        }

        .category {
            position: relative;
            flex: 0 0 128px;
            min-width: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 11px;
            padding: 14px 10px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 19px;
            background: var(--surface);
            text-align: center;
            transition: transform .25s, border-color .25s, background .25s;
        }

        .category:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 53, 72, .45);
        }

        .category.active {
            border-color: rgba(255, 53, 72, .65);
            background: linear-gradient(145deg, rgba(255, 53, 72, .13), var(--surface) 75%);
            box-shadow: inset 0 0 25px rgba(255, 53, 72, .035);
        }

        .category-image {
            width: 76px;
            height: 76px;
            display: grid;
            place-items: center;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: var(--image-bg);
            color: var(--red-light);
            font-size: 25px;
        }

        .category-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-name {
            max-width: 100%;
            font-size: 11px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .category-count {
            margin-top: -5px;
            color: var(--muted);
            font-size: 9px;
        }

        /* PRODUCT CARDS */

        .products-scroll {
            display: flex;
            gap: 17px;
            overflow-x: auto;
            padding: 3px 2px 18px;
            scroll-snap-type: x proximity;
            scrollbar-width: thin;
            scrollbar-color: var(--red) transparent;
        }

        .product-card {
            position: relative;
            flex: 0 0 258px;
            width: 258px;
            min-width: 0;
            overflow: hidden;
            scroll-snap-align: start;
            border: 1px solid var(--border);
            border-radius: 21px;
            background: var(--surface);
            box-shadow: var(--shadow);
            transition: transform .28s ease, border-color .28s ease, box-shadow .28s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 53, 72, .45);
            box-shadow: 0 20px 55px rgba(0, 0, 0, .26), 0 0 28px rgba(255, 53, 72, .045);
        }

        .product-image {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            display: grid;
            place-items: center;
            overflow: hidden;
            background:
                radial-gradient(circle at 50% 50%, rgba(255, 53, 72, .09), transparent 70%),
                var(--image-bg);
            color: var(--muted);
            font-size: 42px;
        }

        .product-image::after {
            content: "";
            position: absolute;
            inset: 45% 0 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, .28));
            pointer-events: none;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.065);
        }

        .product-image > i {
            color: var(--red-light);
        }

        .product-badge {
            position: absolute;
            z-index: 2;
            top: 12px;
            left: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 9px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 8px;
            background: rgba(170, 15, 39, .9);
            color: #fff;
            font-size: 8px;
            font-weight: 900;
            letter-spacing: .6px;
            backdrop-filter: blur(8px);
        }

        .product-info {
            padding: 16px;
        }

        .product-name {
            display: -webkit-box;
            min-height: 20px;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .product-description {
            display: -webkit-box;
            min-height: 34px;
            margin-top: 7px;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .product-price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            min-height: 42px;
            margin-top: 13px;
        }

        .product-price {
            color: var(--red-light);
            font-size: 17px;
            font-weight: 900;
            white-space: nowrap;
        }

        .product-old-price {
            display: block;
            margin-top: 4px;
            color: var(--muted);
            font-size: 10px;
            text-decoration: line-through;
        }

        .product-category {
            max-width: 100px;
            color: var(--muted);
            font-size: 9px;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .product-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 15px;
        }

        .product-btn {
            min-width: 0;
            min-height: 39px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px;
            border: 1px solid var(--border);
            border-radius: 11px;
            font-size: 10px;
            font-weight: 800;
            text-align: center;
            cursor: pointer;
            transition: .2s;
        }

        .product-btn-details {
            background: var(--surface-2);
            color: var(--text);
        }

        .product-btn-details:hover {
            border-color: var(--red);
            background: var(--red-soft);
            color: var(--red-light);
        }

        .product-btn-order {
            border-color: transparent;
            background: linear-gradient(135deg, #ff4b5e, #d91e38);
            box-shadow: 0 5px 16px rgba(255, 53, 72, .13);
            color: #fff;
        }

        .product-btn-order:hover {
            box-shadow: 0 8px 23px rgba(255, 53, 72, .25);
            color: #fff;
        }

        .product-order-form {
            min-width: 0;
        }

        .product-order-form .product-btn {
            width: 100%;
        }

        /* EMPTY STATES */

        .empty-state {
            width: 100%;
            padding: 42px 20px;
            border: 1px dashed var(--border);
            border-radius: 20px;
            background: var(--surface);
            color: var(--muted);
            text-align: center;
        }

        .empty-state > i {
            display: block;
            margin-bottom: 16px;
            color: var(--red-light);
            font-size: 34px;
        }

        .empty-state h4 {
            margin-bottom: 8px;
            color: var(--text);
            font-size: 15px;
        }

        .empty-state p {
            font-size: 11px;
            line-height: 1.8;
        }

        /* TOAST FEEDBACK */

        .toast-container {
            position: fixed;
            z-index: 5000;
            top: 90px;
            right: 22px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: min(360px, calc(100% - 32px));
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 15px 16px;
            border: 1px solid var(--border);
            border-radius: 15px;
            background: var(--surface-2);
            box-shadow: var(--shadow);
            color: var(--text);
            font-size: 12px;
            line-height: 1.6;
            animation: toastEnter .25s ease both;
            pointer-events: auto;
        }

        .toast i {
            margin-top: 2px;
            color: #46d6a0;
            font-size: 16px;
        }

        .toast.error i {
            color: var(--red-light);
        }

        @keyframes toastEnter {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* FLYING CART ITEM */

        .flying-product {
            position: fixed;
            z-index: 99999;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, .55);
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .35), 0 0 20px rgba(255, 53, 72, .2);
            pointer-events: none;
            object-fit: cover;
            will-change: transform, opacity;
        }

        .header-cart.cart-added {
            animation: cartPulse .4s ease;
        }

        @keyframes cartPulse {
            50% {
                transform: scale(1.16);
                border-color: var(--red);
                color: var(--red-light);
                box-shadow: 0 0 24px rgba(255, 53, 72, .22);
            }
        }

        /* BOTTOM NAVIGATION */

        .bottom-nav {
            position: fixed;
            z-index: 2000;
            right: 12px;
            bottom: 12px;
            left: 12px;
            height: 67px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 20px;
            background: color-mix(in srgb, var(--surface) 90%, transparent);
            box-shadow: 0 12px 45px rgba(0, 0, 0, .28);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
        }

        .bottom-item {
            position: relative;
            width: 25%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 800;
            transition: color .2s;
        }

        .bottom-item i {
            font-size: 17px;
        }

        .bottom-item.active,
        .bottom-item:hover {
            color: var(--red-light);
        }

        .bottom-item.active::before {
            content: "";
            position: absolute;
            top: 0;
            width: 27px;
            height: 2px;
            border-radius: 3px;
            background: var(--red);
            box-shadow: 0 0 12px var(--red);
        }

        /* RESPONSIVE */

        @media (min-width: 800px) {
            body {
                padding-bottom: 35px;
            }

            .bottom-nav {
                display: none;
            }
        }

        @media (max-width: 799px) {
            .page-container {
                padding: 0 20px;
            }

            .header {
                margin: 0 -20px;
                padding: 13px 20px;
            }

            .hero {
                min-height: 0;
                padding: 30px;
            }

            .hero-slide {
                min-height: 265px;
                gap: 20px;
            }

            .offer-preview {
                width: 34%;
                height: 210px;
            }

            .hero h2 {
                font-size: clamp(29px, 5vw, 42px);
            }

            .section {
                margin-top: 37px;
            }
        }

        @media (max-width: 520px) {
            .page-container {
                padding: 0 13px;
            }

            .header {
                margin: 0 -13px;
                padding: 11px 13px;
            }

            .header-top {
                gap: 8px;
            }

            .brand {
                gap: 8px;
            }

            .brand-icon {
                width: 38px;
                height: 38px;
                border-radius: 12px;
                font-size: 15px;
            }

            .brand h1 {
                font-size: 13px;
                letter-spacing: .6px;
            }

            .brand small {
                margin-top: 3px;
                font-size: 7px;
                letter-spacing: 1.4px;
            }

            .header-icons {
                gap: 5px;
            }

            .header-btn,
            .header-settings,
            .header-cart {
                width: 34px;
                height: 34px;
                border-radius: 11px;
                font-size: 12px;
            }

            .new-user-btn {
                min-height: 34px;
                gap: 5px;
                padding: 0 9px;
                border-radius: 10px;
                font-size: 9px;
            }

            .cart-count {
                top: -6px;
                right: -6px;
                min-width: 17px;
                height: 17px;
                font-size: 9px;
            }

            .hero {
                margin-top: 17px;
                padding: 23px 19px 19px;
                border-radius: 23px;
            }

            .hero-slide,
            .hero-slide.active {
                flex-direction: column;
                align-items: stretch;
                gap: 21px;
            }

            .hero-content {
                width: 100%;
                max-width: none;
            }

            .hero-label {
                margin-bottom: 16px;
                padding: 7px 10px;
                font-size: 8px;
                letter-spacing: 1.2px;
            }

            .hero h2 {
                margin-bottom: 12px;
                font-size: clamp(29px, 8vw, 39px);
                letter-spacing: -1.2px;
            }

            .hero p {
                margin-bottom: 17px;
                font-size: 11px;
                line-height: 1.8;
            }

            .hero-btn {
                min-height: 42px;
                padding: 0 15px;
                font-size: 10px;
            }

            .offer-preview {
                width: 100%;
                height: 190px;
                border-radius: 19px;
            }

            .offer-preview .offer-emoji {
                font-size: 76px;
            }

            .offer-discount {
                top: 9px;
                right: 9px;
                padding: 7px 9px;
                font-size: 9px;
            }

            .offer-prices {
                gap: 10px;
                margin-bottom: 18px;
            }

            .offer-new-price {
                font-size: 21px;
            }

            .offer-old-price {
                font-size: 12px;
            }

            .offer-controls {
                margin-top: 18px;
            }

            .section {
                margin-top: 31px;
            }

            .section-header {
                margin-bottom: 15px;
                align-items: center;
                gap: 10px;
            }

            .section-eyebrow {
                margin-bottom: 6px;
                font-size: 8px;
                letter-spacing: 1.8px;
            }

            .section-title {
                font-size: 19px;
            }

            .section-subtitle {
                font-size: 10px;
            }

            .section-link {
                gap: 5px;
                font-size: 10px;
            }

            .categories {
                gap: 10px;
            }

            .category {
                flex-basis: 101px;
                gap: 9px;
                padding: 10px 7px;
                border-radius: 16px;
            }

            .category-image {
                width: 65px;
                height: 65px;
                border-radius: 13px;
            }

            .category-name {
                font-size: 10px;
            }

            .products-scroll {
                gap: 12px;
            }

            .product-card {
                flex-basis: 218px;
                width: 218px;
                border-radius: 18px;
            }

            .product-info {
                padding: 13px;
            }

            .product-name {
                font-size: 12px;
            }

            .product-description {
                font-size: 9px;
            }

            .product-price {
                font-size: 15px;
            }

            .product-btn {
                min-height: 37px;
                gap: 5px;
                padding: 6px;
                font-size: 9px;
            }

            .toast-container {
                top: 72px;
                right: 12px;
                width: calc(100% - 24px);
            }

            .bottom-nav {
                right: 9px;
                bottom: 8px;
                left: 9px;
                height: 63px;
                border-radius: 18px;
            }
        }

        @media (max-width: 360px) {
            .brand {
                gap: 6px;
            }

            .brand h1 {
                font-size: 11px;
            }

            .brand small {
                font-size: 6px;
                letter-spacing: 1px;
            }

            .brand-icon {
                width: 33px;
                height: 33px;
            }

            .header-icons {
                gap: 4px;
            }

            .header-btn,
            .header-settings,
            .header-cart {
                width: 31px;
                height: 32px;
            }

            .new-user-btn {
                width: 32px;
                padding: 0;
            }

            .new-user-btn span {
                display: none;
            }

            .hero {
                padding: 19px 15px 16px;
            }

            .product-card {
                flex-basis: 205px;
                width: 205px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }

        
/* Hide scrollbars but keep scrolling functional */
html,
body,
.categories,
.products-scroll {
    scrollbar-width: none;
    -ms-overflow-style: none;
}

html::-webkit-scrollbar,
body::-webkit-scrollbar,
.categories::-webkit-scrollbar,
.products-scroll::-webkit-scrollbar {
    display: none;
    width: 0;
    height: 0;
}

/* Prevent horizontal page overflow */
html,
body {
    overflow-x: hidden;
}

    </style>
</head>

<body>

    <div class="page-container">

        {{-- HEADER --}}
        <header class="header">
            <div class="header-top">

                <a href="{{ route('home') }}" class="brand" aria-label="AL SALAMA Home">
                    <div class="brand-icon">
                        <i class="fa-solid fa-utensils"></i>
                    </div>

                    <div>
                        <h1>AL SALAMA</h1>
                        <small>FOOD & DELIVERY</small>
                    </div>
                </a>

                <div class="header-icons">

                    <a href="{{ route('cart') }}" class="header-cart" aria-label="Shopping cart">
                        <i class="fa-solid fa-bag-shopping"></i>

                        <span class="cart-count" id="cartCount"
                            @if($cartCount < 1) style="display:none" @endif>
                            {{ $cartCount }}
                        </span>
                    </a>

                    @auth
                        @if(auth()->user()->role === 'customer')
                            <a href="{{ route('customer.checkout') }}" class="new-user-btn" title="View My Orders">
                                <i class="fa-solid fa-receipt"></i>
                                <span>My Orders</span>
                            </a>
                        @endif
                    @endauth

                    <a href="{{ route('menu') }}" class="header-btn" aria-label="Explore menu">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>

                    @guest
                        <a href="{{ route('register') }}" class="new-user-btn">
                            <i class="fa-solid fa-user-plus"></i>
                            <span>Join Us</span>
                        </a>
                    @endguest

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="header-settings"
                                aria-label="Admin Dashboard">
                                <i class="fa-solid fa-gear"></i>
                            </a>
                        @else
                            <a href="{{ route('settings') }}" class="header-settings" aria-label="Settings">
                                <i class="fa-solid fa-gear"></i>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="header-settings" aria-label="Login">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </a>
                    @endauth

                </div>
            </div>
        </header>

        {{-- AURORA OFFERS --}}
        <section class="hero offers-slider" id="offersSlider" aria-label="Special offers">

            @if($offerProducts->isNotEmpty())

                @foreach($offerProducts as $offerProduct)

                    @php
                        $discountPercent = (float) $offerProduct->price > 0
                            ? max(0, round(
                                (
                                    ((float) $offerProduct->price -
                                        (float) $offerProduct->discount_price)
                                    / (float) $offerProduct->price
                                ) * 100
                            ))
                            : 0;
                    @endphp

                    <div class="hero-slide {{ $loop->first ? 'active' : '' }}">

                        <div class="hero-content">

                            <div class="hero-label">
                                <i class="fa-solid fa-fire-flame-curved"></i>
                                LIMITED-TIME SPECIAL
                            </div>

                            <h2>
                                A little more
                                <span class="hero-highlight">delicious.</span>
                                <br>
                                {{ $offerProduct->name }}
                            </h2>

                            <p>
                                {{ $offerProduct->description ?: 'Discover something delicious today. Fresh flavors, special prices, and a meal worth looking forward to.' }}
                            </p>

                            <div class="offer-prices">
                                <span class="offer-old-price">
                                    {{ number_format((float) $offerProduct->price, 2) }} EGP
                                </span>

                                <strong class="offer-new-price">
                                    {{ number_format((float) $offerProduct->discount_price, 2) }} EGP
                                </strong>
                            </div>

                            <form method="POST"
                                action="{{ route('cart.add', $offerProduct->id) }}"
                                class="hero-order-form">
                                @csrf

                                <button type="submit" class="hero-btn">
                                    Get This Offer
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </form>

                        </div>

                        <div class="offer-preview">

                            @if($offerProduct->image)
                                <img
                                    src="{{ $imageUrl($offerProduct->image) }}"
                                    alt="{{ $offerProduct->name }}"
                                    @if(!$loop->first) loading="lazy" @else fetchpriority="high" @endif
                                    decoding="async"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">

                                <span class="offer-emoji" style="display:none;">🍔</span>
                            @else
                                <span class="offer-emoji">🍔</span>
                            @endif

                            <span class="offer-discount">
                                {{ $discountPercent }}% OFF
                            </span>

                        </div>

                    </div>

                @endforeach

                @if($offerProducts->count() > 1)
                    <div class="offer-controls">

                        <button type="button" class="offer-nav-btn" id="prevOffer"
                            aria-label="Previous offer">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <div class="offer-dots">
                            @foreach($offerProducts as $offerProduct)
                                <button type="button"
                                    class="offer-dot {{ $loop->first ? 'active' : '' }}"
                                    data-offer-dot="{{ $loop->index }}"
                                    aria-label="Go to offer {{ $loop->iteration }}">
                                </button>
                            @endforeach
                        </div>

                        <button type="button" class="offer-nav-btn" id="nextOffer"
                            aria-label="Next offer">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>

                    </div>
                @endif

            @else

                <div class="hero-slide active">

                    <div class="hero-content">
                        <div class="hero-label">
                            <i class="fa-solid fa-sparkles"></i>
                            WELCOME TO AL SALAMA
                        </div>

                        <h2>
                            Your cravings.
                            <br>
                            <span class="hero-highlight">Our passion.</span>
                        </h2>

                        <p>
                            Great food makes ordinary moments special.
                            Explore our menu and discover your next favorite meal.
                        </p>

                        <a href="{{ route('menu') }}" class="hero-btn">
                            Explore Our Menu
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="offer-preview">
                        <span class="offer-emoji">🍔</span>
                    </div>

                </div>

            @endif

        </section>

        {{-- CATEGORIES --}}
        <section class="section" aria-labelledby="categoriesTitle">

            <div class="section-header">
                <div>
                    <span class="section-eyebrow">Find your favorite</span>
                    <h3 class="section-title" id="categoriesTitle">Explore Categories</h3>
                    <p class="section-subtitle">Something delicious for every craving.</p>
                </div>

                <a href="{{ route('menu') }}" class="section-link">
                    Full Menu <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="categories">

                <a href="{{ route('home') }}#products"
                    class="category {{ !$selectedCategory ? 'active' : '' }}">

                    <div class="category-image">
                        <i class="fa-solid fa-utensils"></i>
                    </div>

                    <span class="category-name">Everything</span>
                    <span class="category-count">All meals</span>
                </a>

                @forelse($categories as $category)

                    <a href="{{ route('home', ['category' => $category->id]) }}#products"
                        class="category {{ $selectedCategory && $selectedCategory->id === $category->id ? 'active' : '' }}">

                        <div class="category-image">

                            @if($category->image)
                                <img
                                    src="{{ $imageUrl($category->image) }}"
                                    alt="{{ $category->name }}"
                                    loading="lazy"
                                    decoding="async"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">

                                <span
                                    style="display:none;width:100%;height:100%;place-items:center;color:var(--red-light);">
                                    <i class="fa-solid fa-utensils"></i>
                                </span>
                            @else
                                <i class="fa-solid fa-utensils"></i>
                            @endif

                        </div>

                        <span class="category-name">{{ $category->name }}</span>

                        <span class="category-count">
                            {{ $category->products_count }} products
                        </span>

                    </a>

                @empty
                    <div class="empty-state">
                        <p>No categories available yet.</p>
                    </div>
                @endforelse

            </div>
        </section>

        {{-- PRODUCTS --}}
        <section class="section" id="products" aria-labelledby="productsTitle">

            <div class="section-header">
                <div>
                    <span class="section-eyebrow">
                        {{ $selectedCategory ? 'Selected for you' : 'Made to satisfy' }}
                    </span>

                    <h3 class="section-title" id="productsTitle">
                        @if($selectedCategory)
                            {{ $selectedCategory->name }}
                        @else
                            Discover Our Menu
                        @endif
                    </h3>

                    <p class="section-subtitle">
                        @if($selectedCategory)
                            Explore the delicious choices in this category.
                        @else
                            Delicious choices, made for your next craving.
                        @endif
                    </p>
                </div>

                @if($selectedCategory)
                    <a href="{{ route('home') }}#products" class="section-link">
                        <i class="fa-solid fa-arrow-left"></i>
                        All Products
                    </a>
                @else
                    <a href="{{ route('menu') }}" class="section-link">
                        View Menu <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endif
            </div>

            <div class="products-scroll">

                @forelse($products as $product)

                    @php
                        $hasDiscount = $product->discount_price !== null
                            && (float) $product->discount_price < (float) $product->price;

                        $currentPrice = $hasDiscount
                            ? $product->discount_price
                            : $product->price;
                    @endphp

                    <article class="product-card">

                        <div class="product-image">

                            @if($product->image)
                                <img
                                    src="{{ $imageUrl($product->image) }}"
                                    alt="{{ $product->name }}"
                                    loading="lazy"
                                    decoding="async"
                                    width="400"
                                    height="300"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">

                                <i class="fa-solid fa-utensils" style="display:none;"></i>
                            @else
                                <i class="fa-solid fa-utensils"></i>
                            @endif

                            @if($hasDiscount)
                                <span class="product-badge">
                                    <i class="fa-solid fa-bolt"></i>
                                    SPECIAL OFFER
                                </span>
                            @elseif($product->is_featured)
                                <span class="product-badge">
                                    <i class="fa-solid fa-star"></i>
                                    CUSTOMER FAVORITE
                                </span>
                            @endif

                        </div>

                        <div class="product-info">

                            <h4 class="product-name">{{ $product->name }}</h4>

                            <p class="product-description">
                                {{ $product->description ?: 'Delicious food prepared fresh for you.' }}
                            </p>

                            <div class="product-price-row">

                                <div>
                                    <div class="product-price">
                                        {{ number_format((float) $currentPrice, 2) }} EGP
                                    </div>

                                    @if($hasDiscount)
                                        <span class="product-old-price">
                                            {{ number_format((float) $product->price, 2) }} EGP
                                        </span>
                                    @endif
                                </div>

                                @if($product->category)
                                    <span class="product-category">
                                        {{ $product->category->name }}
                                    </span>
                                @endif

                            </div>

                            <div class="product-actions">

                                <a href="{{ route('details', ['product' => $product->id]) }}"
                                    class="product-btn product-btn-details">
                                    <i class="fa-regular fa-eye"></i>
                                    Details
                                </a>

                                <form method="POST"
                                    action="{{ route('cart.add', $product->id) }}"
                                    class="product-order-form">
                                    @csrf

                                    <button type="submit" class="product-btn product-btn-order">
                                        <i class="fa-solid fa-plus"></i>
                                        Add to Cart
                                    </button>
                                </form>

                            </div>

                        </div>

                    </article>

                @empty

                    <div class="empty-state">
                        <i class="fa-solid fa-burger"></i>

                        <h4>Nothing on the menu just yet</h4>

                        <p>
                            @if($selectedCategory)
                                There are no available products in this category yet.
                            @else
                                Our delicious selection will appear here soon.
                            @endif
                        </p>

                        @if($selectedCategory)
                            <a href="{{ route('home') }}"
                                class="section-link"
                                style="display:inline-flex;margin-top:16px;">
                                <i class="fa-solid fa-arrow-left"></i>
                                Browse all products
                            </a>
                        @endif
                    </div>

                @endforelse

            </div>
        </section>

        {{-- SMALL FOOTER --}}
        <footer style="padding:35px 0 20px;text-align:center;color:var(--muted);font-size:10px;">
            <span style="color:var(--red-light);font-weight:900;letter-spacing:1.5px;">AL SALAMA</span>
            <span style="margin:0 8px;opacity:.4;">•</span>
            Made for your cravings.
        </footer>

    </div>

    {{-- TOASTS --}}
    <div class="toast-container" id="toastContainer" aria-live="polite"></div>

    {{-- MOBILE NAVIGATION --}}
    <nav class="bottom-nav" aria-label="Mobile navigation">

        <a href="{{ route('home') }}" class="bottom-item active">
            <i class="fa-solid fa-house"></i>
            Home
        </a>

        <a href="{{ route('menu') }}" class="bottom-item">
            <i class="fa-solid fa-utensils"></i>
            Menu
        </a>

        <a href="{{ route('cart') }}" class="bottom-item">
            <i class="fa-solid fa-bag-shopping"></i>
            Cart
        </a>

        @auth
            <a href="{{ route('customer.orders') }}" class="bottom-item">
                <i class="fa-solid fa-receipt"></i>
                Orders
            </a>
        @else
            <a href="{{ route('login') }}" class="bottom-item">
                <i class="fa-regular fa-user"></i>
                Login
            </a>
        @endauth

    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.getElementById('offersSlider');

            if (!slider) return;

            const slides = Array.from(slider.querySelectorAll('.hero-slide'));
            const dots = Array.from(slider.querySelectorAll('.offer-dot'));
            const prevButton = document.getElementById('prevOffer');
            const nextButton = document.getElementById('nextOffer');

            if (slides.length <= 1) return;

            let currentIndex = Math.max(
                0,
                slides.findIndex(slide => slide.classList.contains('active'))
            );

            let timer = null;

            function showOffer(index) {
                currentIndex = (index + slides.length) % slides.length;

                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === currentIndex);
                });

                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentIndex);
                });
            }

            function stopAutoScroll() {
                if (timer) {
                    clearInterval(timer);
                    timer = null;
                }
            }

            function startAutoScroll() {
                stopAutoScroll();

                if (document.hidden) return;

                timer = setInterval(() => {
                    showOffer(currentIndex + 1);
                }, 5000);
            }

            prevButton?.addEventListener('click', () => {
                showOffer(currentIndex - 1);
                startAutoScroll();
            });

            nextButton?.addEventListener('click', () => {
                showOffer(currentIndex + 1);
                startAutoScroll();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showOffer(index);
                    startAutoScroll();
                });
            });

            slider.addEventListener('mouseenter', stopAutoScroll);
            slider.addEventListener('mouseleave', startAutoScroll);
            slider.addEventListener('focusin', stopAutoScroll);
            slider.addEventListener('focusout', startAutoScroll);

            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    stopAutoScroll();
                } else {
                    startAutoScroll();
                }
            });

            showOffer(currentIndex);
            startAutoScroll();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cartLink = document.querySelector('.header-cart');
            const cartCount = document.getElementById('cartCount');
            const toastContainer = document.getElementById('toastContainer');

            function showToast(message, isError = false) {
                if (!toastContainer) return;

                const toast = document.createElement('div');
                toast.className = 'toast' + (isError ? ' error' : '');

                const icon = document.createElement('i');
                icon.className = isError
                    ? 'fa-solid fa-circle-exclamation'
                    : 'fa-solid fa-circle-check';

                const text = document.createElement('span');
                text.textContent = message;

                toast.append(icon, text);
                toastContainer.appendChild(toast);

                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(-6px)';

                    setTimeout(() => toast.remove(), 250);
                }, 2800);
            }

            function animateToCart(source, fallbackButton) {
                if (!cartLink || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    return;
                }

                const startElement = source || fallbackButton;
                const start = startElement.getBoundingClientRect();
                const end = cartLink.getBoundingClientRect();

                if (!start.width || !start.height || !end.width || !end.height) {
                    return;
                }

                const flyer = document.createElement('div');
                flyer.className = 'flying-product';

                if (source && source.tagName === 'IMG' && source.src) {
                    flyer.style.backgroundImage = `url("${source.src}")`;
                    flyer.style.backgroundSize = 'cover';
                    flyer.style.backgroundPosition = 'center';
                } else {
                    flyer.textContent = source?.textContent?.trim() || '🍔';
                    flyer.style.display = 'grid';
                    flyer.style.placeItems = 'center';
                    flyer.style.background = '#251019';
                    flyer.style.fontSize = '28px';
                }

                const size = Math.min(75, Math.max(45, Math.min(start.width, start.height)));

                flyer.style.left = (start.left + start.width / 2 - size / 2) + 'px';
                flyer.style.top = (start.top + start.height / 2 - size / 2) + 'px';
                flyer.style.width = size + 'px';
                flyer.style.height = size + 'px';

                document.body.appendChild(flyer);

                const dx = end.left + end.width / 2 - (start.left + start.width / 2);
                const dy = end.top + end.height / 2 - (start.top + start.height / 2);

                const animation = flyer.animate([
                    {
                        transform: 'translate(0, 0) scale(1)',
                        opacity: 1
                    },
                    {
                        transform: `translate(${dx}px, ${dy}px) scale(.18)`,
                        opacity: .2
                    }
                ], {
                    duration: 600,
                    easing: 'cubic-bezier(.45, 0, .8, .5)',
                    fill: 'forwards'
                });

                animation.onfinish = () => flyer.remove();

                cartLink.classList.remove('cart-added');
                void cartLink.offsetWidth;
                cartLink.classList.add('cart-added');

                setTimeout(() => cartLink.classList.remove('cart-added'), 450);
            }

            document.querySelectorAll('.hero-order-form, .product-order-form')
                .forEach(form => {
                    form.addEventListener('submit', async function (event) {
                        event.preventDefault();

                        const button = form.querySelector('button[type="submit"]');

                        if (!button || button.disabled) return;

                        const originalHTML = button.innerHTML;
                        button.disabled = true;

                        try {
                            const response = await fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: new FormData(form),
                                credentials: 'same-origin'
                            });

                            const contentType = response.headers.get('content-type') || '';

                            if (!contentType.includes('application/json')) {
                                throw new Error(
                                    response.status === 401 || response.redirected
                                        ? 'Your session may have expired. Refresh the page and try again.'
                                        : 'Unexpected server response. Please refresh the page and try again.'
                                );
                            }

                            const data = await response.json();

                            if (!response.ok || !data.success) {
                                throw new Error(data.message || 'Could not add this product to your cart.');
                            }

                            const slide = form.closest('.hero-slide');
                            const card = form.closest('.product-card');

                            let source = null;

                            if (slide) {
                                const preview = slide.querySelector('.offer-preview');

                                source = preview?.querySelector('img:not([style*="display: none"])')
                                    || preview?.querySelector('.offer-emoji')
                                    || null;
                            } else if (card) {
                                source = Array.from(card.querySelectorAll('.product-image img'))
                                    .find(img =>
                                        img.getBoundingClientRect().width > 0 &&
                                        getComputedStyle(img).display !== 'none' &&
                                        getComputedStyle(img).visibility !== 'hidden'
                                    ) || card.querySelector('.product-image i');
                            }

                            animateToCart(source, button);

                            if (cartCount && data.cart_count !== undefined) {
                                cartCount.textContent = data.cart_count;
                                cartCount.style.display =
                                    Number(data.cart_count) > 0 ? 'inline-flex' : 'none';
                            }

                            button.innerHTML = '<i class="fa-solid fa-check"></i> Added';
                            showToast(data.message || 'Added to your cart.');

                            setTimeout(() => {
                                button.innerHTML = originalHTML;
                            }, 1100);

                        } catch (error) {
                            console.error('Add-to-cart error:', error);
                            showToast(error.message || 'Could not add the product. Please try again.', true);

                        } finally {
                            button.disabled = false;
                        }
                    });
                });
        });
    </script>

</body>
</html>
