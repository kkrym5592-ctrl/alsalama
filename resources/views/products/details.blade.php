<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --red: #e63946;
            --red-dark: #c1121f;
            --bg: #101114;
            --card: #191a1f;
            --border: #2b2c33;
            --muted: #a5a6ad;
            --white: #f8f9fa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--white);
            font-family: Arial, sans-serif;
        }

        a {
            text-decoration: none;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #15161a;
            border-bottom: 1px solid var(--border);
            padding: 15px 0;
        }

        .brand {
            color: var(--white);
            font-size: 23px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand span {
            color: var(--red);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .back-link {
            color: #ddd;
            font-size: 14px;
            transition: .2s;
        }

        .back-link:hover {
            color: var(--red);
        }

        .header-cart {
            position: relative;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--card);
            color: var(--white);
            font-size: 17px;
            transition: .2s;
        }

        .header-cart:hover {
            color: var(--red);
            border-color: var(--red);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            min-width: 19px;
            height: 19px;
            padding: 0 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
            background: var(--red);
            color: white;
            font-size: 11px;
            font-weight: 800;
            line-height: 1;
        }

        .header-cart.cart-added {
            animation: cartPulse .4s ease;
        }

        @keyframes cartPulse {
            50% {
                transform: scale(1.15);
                color: var(--red);
                border-color: var(--red);
            }
        }

        .details-wrapper {
            max-width: 1100px;
            margin: 45px auto;
            padding: 0 18px;
        }

        .details-card {
            overflow: hidden;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, .25);
        }

        .product-image-wrapper {
            position: relative;
            height: 100%;
            min-height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #222329;
        }

        .product-image {
            width: 100%;
            height: 100%;
            min-height: 350px;
            max-height: 480px;
            display: block;
            object-fit: cover;
        }

        .image-placeholder {
            width: 100%;
            min-height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555660;
            font-size: 75px;
        }

        .product-info {
            padding: 40px 35px;
        }

        .eyebrow {
            margin-bottom: 15px;
            color: var(--red);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .product-title {
            margin-bottom: 20px;
            font-size: clamp(27px, 4vw, 38px);
            font-weight: 800;
            line-height: 1.25;
            overflow-wrap: anywhere;
        }

        .price {
            margin-bottom: 25px;
            color: var(--red);
            font-size: 30px;
            font-weight: 800;
        }

        .price small {
            color: var(--muted);
            font-size: 14px;
            font-weight: 400;
        }

        .section-label {
            margin-bottom: 12px;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
        }

        .description {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.9;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .divider {
            height: 1px;
            margin: 25px 0;
            background: var(--border);
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            color: #d6d6dc;
            font-size: 14px;
        }

        .info-icon {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(230, 57, 70, .12);
            color: var(--red);
        }

        .btn-red,
        .hero-btn {
            min-height: 43px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0 17px;
            border: 1px solid var(--red);
            border-radius: 10px;
            background: var(--red);
            color: white;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        .btn-red:hover {
            transform: translateY(-2px);
            border-color: var(--red-dark);
            background: var(--red-dark);
            color: white;
        }

        .hero-btn {
            border-color: transparent;
            background: white;
            color: var(--red-dark);
        }

        .hero-btn:hover {
            transform: translateY(-2px);
            background: #f1f1f1;
            color: var(--red);
        }

        .hero-btn:active {
            transform: scale(.94);
        }

        .hero-btn:disabled {
            cursor: wait;
            opacity: .7;
        }

        .product-order-form {
            margin: 0;
        }

        .action-buttons {
            align-items: center;
        }

        .flying-product {
            position: fixed;
            z-index: 99999;
            pointer-events: none;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .35);
            will-change: transform, opacity;
        }

        footer {
            margin-top: 50px;
            padding: 22px 15px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
            text-align: center;
        }

        footer span {
            color: var(--red);
            font-weight: 800;
        }

        @media (max-width: 767px) {
            .navbar .container {
                gap: 10px;
            }

            .brand {
                font-size: 19px;
            }

            .header-actions {
                gap: 12px;
            }

            .back-link {
                font-size: 12px;
            }

            .details-wrapper {
                margin: 25px auto;
                padding: 0 12px;
            }

            .product-image-wrapper,
            .product-image {
                min-height: 260px;
                max-height: 320px;
            }

            .image-placeholder {
                min-height: 260px;
            }

            .product-info {
                padding: 27px 22px;
            }

            .product-title {
                font-size: 28px;
            }

            .price {
                font-size: 27px;
            }

            .action-buttons {
                align-items: stretch;
                flex-direction: column;
            }

            .action-buttons > a,
            .action-buttons > form,
            .action-buttons .hero-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="container d-flex justify-content-between align-items-center">

            <a href="{{ route('home') }}" class="brand">
                AL <span>SALAMA</span>
            </a>

            <div class="header-actions">

                @php
                    $cartCount = array_sum(session('cart', []));
                @endphp

                <a href="{{ route('cart') }}" class="header-cart" id="headerCart"
                   aria-label="Shopping cart">
                    <i class="fa-solid fa-cart-shopping"></i>

                    <span class="cart-count" id="cartCount"
                          @if($cartCount < 1) style="display:none" @endif>
                        {{ $cartCount }}
                    </span>
                </a>

                <a href="{{ route('home') }}" class="back-link">
                    <i class="fa-solid fa-arrow-left me-2"></i>
                    Back
                </a>

            </div>
        </div>
    </nav>

    <main class="details-wrapper">
        <div class="details-card">
            <div class="row g-0">

                <div class="col-md-6">
                    <div class="product-image-wrapper">

                        @if($product->image)
                            <img
                                id="details-product-image"
                                src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
                                alt="{{ $product->name }}"
                                class="product-image"
                                onerror="this.style.display='none'; document.getElementById('details-image-placeholder').style.display='flex';"
                            >
                            <div class="image-placeholder" id="details-image-placeholder"
                                 style="display:none;">
                                <i class="fa-solid fa-utensils"></i>
                            </div>
                        @else
                            <div class="image-placeholder" id="details-image-placeholder">
                                <i class="fa-solid fa-utensils"></i>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="product-info">

                        <div class="eyebrow">
                            <i class="fa-solid fa-fire me-1"></i>
                            AL SALAMA MENU
                        </div>

                        <h1 class="product-title">
                            {{ $product->name }}
                        </h1>

                        <div class="price">
                            {{ number_format((float) $product->price, 2) }}
                            <small>EGP</small>
                        </div>

                        <div class="section-label">
                            <i class="fa-regular fa-rectangle-list me-2"
                               style="color:var(--red)"></i>
                            Product Description
                        </div>

                        <p class="description">
                            {{ $product->description ?: 'Enjoy one of our delicious menu items, freshly prepared for you.' }}
                        </p>

                        <div class="divider"></div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <span>Freshly prepared with care</span>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                            <span>Delivery and pickup options</span>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa-solid fa-heart"></i>
                            </div>
                            <span>Made for your satisfaction</span>
                        </div>

                        <div class="divider"></div>

                        <div class="action-buttons d-flex flex-wrap gap-3">

                            <a href="{{ route('home') }}" class="btn-red">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back to Menu
                            </a>

                            <form method="POST"
                                  action="{{ route('cart.add', $product->id) }}"
                                  class="product-order-form">
                                @csrf

                                <button type="submit" class="hero-btn">
                                    Order Now
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer>
        © {{ date('Y') }} <span>AL SALAMA</span> — Made with care.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.product-order-form');
            const productImage = document.getElementById('details-product-image');
            const cartLink = document.getElementById('headerCart');
            const cartCount = document.getElementById('cartCount');

            if (!form) return;

            form.addEventListener('submit', async function (event) {
                event.preventDefault();

                const button = form.querySelector('button[type="submit"]');

                if (!button || button.disabled) return;

                const originalButtonHTML = button.innerHTML;
                button.disabled = true;

                try {
                    // Add the product using the same AJAX approach as Home.
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
                            'The cart endpoint did not return JSON. Check the cart.add controller response.'
                        );
                    }

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Could not add product to cart.');
                    }

                    // Animate this product image toward the cart icon.
                    if (cartLink) {
                        const startElement =
                            productImage &&
                            productImage.getBoundingClientRect().width > 0
                                ? productImage
                                : button;

                        const start = startElement.getBoundingClientRect();
                        const end = cartLink.getBoundingClientRect();

                        const flyer = document.createElement('div');
                        flyer.className = 'flying-product';

                        if (
                            startElement === productImage &&
                            productImage.currentSrc
                        ) {
                            flyer.style.backgroundImage =
                                `url("${productImage.currentSrc}")`;
                            flyer.style.backgroundSize = 'cover';
                            flyer.style.backgroundPosition = 'center';
                        } else {
                            flyer.innerHTML = '<i class="fa-solid fa-burger"></i>';
                            flyer.style.display = 'flex';
                            flyer.style.alignItems = 'center';
                            flyer.style.justifyContent = 'center';
                            flyer.style.background = '#fff';
                            flyer.style.color = '#e63946';
                            flyer.style.fontSize = '30px';
                        }

                        const size = 75;

                        flyer.style.left =
                            (start.left + start.width / 2 - size / 2) + 'px';
                        flyer.style.top =
                            (start.top + start.height / 2 - size / 2) + 'px';
                        flyer.style.width = size + 'px';
                        flyer.style.height = size + 'px';

                        document.body.appendChild(flyer);

                        const dx =
                            end.left + end.width / 2 -
                            (start.left + start.width / 2);

                        const dy =
                            end.top + end.height / 2 -
                            (start.top + start.height / 2);

                        const animation = flyer.animate([
                            {
                                transform: 'translate(0, 0) scale(1)',
                                opacity: 1
                            },
                            {
                                transform: `translate(${dx}px, ${dy}px) scale(.2)`,
                                opacity: .25
                            }
                        ], {
                            duration: 650,
                            easing: 'cubic-bezier(.45, 0, .8, .5)',
                            fill: 'forwards'
                        });

                        animation.onfinish = function () {
                            flyer.remove();
                        };

                        cartLink.classList.add('cart-added');

                        setTimeout(function () {
                            cartLink.classList.remove('cart-added');
                        }, 450);
                    }

                    // Update the cart badge returned by the server.
                    if (cartCount && data.cart_count !== undefined) {
                        cartCount.textContent = data.cart_count;
                        cartCount.style.display =
                            Number(data.cart_count) > 0 ? 'inline-flex' : 'none';
                    }

                    button.innerHTML =
                        '<i class="fa-solid fa-check"></i> Added';

                    setTimeout(function () {
                        button.innerHTML = originalButtonHTML;
                    }, 1000);

                } catch (error) {
                    console.error('Add to cart error:', error);
                    alert(error.message || 'Could not add the product to your cart. Please try again.');
                } finally {
                    button.disabled = false;
                }
            });
        });
    </script>

</body>
</html>
