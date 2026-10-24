<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Dashboard') - AL SALAMA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
            color: #18212f;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
        }

       .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;

    width: 250px;
    height: 100vh;

    overflow-y: auto;
    overflow-x: hidden;

    background: #101827;
    z-index: 1000;

    scrollbar-width: thin;
    scrollbar-color: #e63946 #101827;
}

/* Scrollbar للـ Sidebar */
.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track {
    background: #101827;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #e63946;
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #c92f3b;
}

        .brand {
            height: 80px;
            display: flex;
            align-items: center;
            padding: 0 25px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #e63946;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            margin-right: 12px;
        }

        .brand-text h2 {
            font-size: 18px;
            font-weight: 800;
        }

        .brand-text span {
            display: block;
            font-size: 10px;
            color: #8e9aaa;
            margin-top: 2px;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            padding: 25px 14px;
            flex: 1;
        }

        .menu-title {
            color: #657084;
            text-transform: uppercase;
            font-size: 10px;
            font-weight: 700;
            padding: 0 12px;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            border-radius: 10px;
            color: #9da8b8;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 4px;
            transition: .2s;
        }

        .nav-item i {
            width: 18px;
            text-align: center;
        }

        .nav-item:hover {
            background: #182335;
            color: #fff;
        }

        .nav-item.active {
            background: #e63946;
            color: #fff;
            box-shadow: 0 8px 20px rgba(230, 57, 70, .18);
        }

        .sidebar-bottom {
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, .07);
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px;
            margin-bottom: 8px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #273449;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .admin-user strong {
            font-size: 12px;
            display: block;
            color: #fff;
        }

        .admin-user span {
            color: #788498;
            font-size: 10px;
        }

        .logout-btn {
            width: 100%;
            border: 0;
            background: transparent;
            color: #9da8b8;
            padding: 11px;
            text-align: left;
            cursor: pointer;
            border-radius: 8px;
            font-family: inherit;
        }

        .logout-btn:hover {
            background: #182335;
            color: #fff;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            height: 80px;
            background: #fff;
            border-bottom: 1px solid #e8ebf0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
        }

        .page-title h1 {
            font-size: 21px;
            font-weight: 800;
        }

        .page-title p {
            font-size: 12px;
            color: #8b95a5;
            margin-top: 4px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification {
            width: 38px;
            height: 38px;
            border: 1px solid #e5e9ef;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667085;
            position: relative;
        }

        .notification-dot {
            width: 7px;
            height: 7px;
            background: #e63946;
            border-radius: 50%;
            position: absolute;
            top: 8px;
            right: 8px;
        }

        .content {
            padding: 32px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {
            .sidebar {
                width: 75px;
            }

            .brand {
                justify-content: center;
                padding: 0;
            }

            .brand-text,
            .menu-title,
            .nav-item span,
            .admin-user div {
                display: none;
            }

            .brand-icon {
                margin: 0;
            }

            .nav-item {
                justify-content: center;
                padding: 14px 0;
            }

            .nav-item i {
                margin: 0;
            }

            .main {
                margin-left: 75px;
                width: calc(100% - 75px);
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="admin-wrapper">

        <!-- SIDEBAR -->

        <aside class="sidebar">

            <div class="brand">

                <div class="brand-icon">
                    <i class="fa-solid fa-utensils"></i>
                </div>

                <div class="brand-text">
                    <h2>AL SALAMA</h2>
                    <span>ADMIN PANEL</span>
                </div>

            </div>

            <div class="sidebar-menu">

                <div class="menu-title">
                    Main
                </div>

<a class="nav-item" href="{{ route('home') }}">home</a>

                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="nav-item">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Orders</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="nav-item">
                    <i class="fa-solid fa-burger"></i>
                    <span>Products</span>
                </a>

                <a href="{{ route('admin.category.index') }}" class="nav-item">
                     <i class="fa-solid fa-layer-group"></i>
                    <span>Categories</span>
                </a>
                <a href="{{ route('admin.menu-groups.index') }}" class="nav-item">
                     <i class="fa-solid fa-layer-group"></i>
                    <span>groups</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="nav-item">
                    <i class="fa-solid fa-users"></i>
                    <span>Customers</span>
                </a>

                
<a href="{{ route('admin.offers.index') }}" class="nav-item">
    <i class="fas fa-tags"></i>
    <span>Offers</span>
</a>

                <a  href="{{ route('settings') }}" class="nav-item">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>

            </div>

            <div class="sidebar-bottom">

                <div class="admin-user">

                    <div class="avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div>
                        <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                        <span>Administrator</span>
                    </div>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        &nbsp; Logout
                    </button>
                </form>

@php
    $license = \App\Models\License::first();
@endphp

@if($license && $license->expires_at)
    <span id="licenseBomb"
          data-expires="{{ $license->expires_at->timestamp * 1000 }}"
          style="font-size: 11px; color: #e63946; font-weight: 600; direction: ltr; white-space: nowrap;">
        --d --:--:--
    </span>

    <script>
        (() => {
            const bomb = document.getElementById('licenseBomb');
            if (!bomb) return;

            const expiresAt = Number(bomb.dataset.expires);

            function updateBomb() {
                const remaining = expiresAt - Date.now();

                if (remaining <= 0) {
                    bomb.textContent = 'EXPIRED';
                    return;
                }

                const total = Math.floor(remaining / 1000);
                const days = Math.floor(total / 86400);
                const hours = Math.floor((total % 86400) / 3600);
                const minutes = Math.floor((total % 3600) / 60);
                const seconds = total % 60;
                const pad = n => String(n).padStart(2, '0');

                bomb.textContent =
                    `${days}d ${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
            }

            updateBomb();
            setInterval(updateBomb, 1000);
        })();
    </script>
@endif

            </div>

        </aside>


        <!-- MAIN -->

        <main class="main">

            <header class="topbar">

                <div class="page-title">

                    <h1>@yield('page-title', 'Dashboard')</h1>

                    <p>Manage your restaurant from one place.</p>

                </div>

                <div class="topbar-right">

                    <div class="notification">

                        <i class="fa-regular fa-bell"></i>

                        <span class="notification-dot"></span>

                    </div>

                </div>

            </header>


            <section class="content">

                @yield('content')

            </section>

        </main>

    </div>

    @stack('scripts')

</body>

</html>