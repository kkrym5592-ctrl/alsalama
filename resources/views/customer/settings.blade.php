<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('customer.theme')

    <title>Settings - AL SALAMA</title>

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
            --primary-hover: #cf3040;
            --primary-dark: #a51d2d;

            --primary-soft: rgba(230, 57, 70, .08);
            --primary-shadow: rgba(230, 57, 70, .18);

            --page-bg: #f7f7f7;
            --card-bg: #ffffff;
            --header-bg: #ffffff;

            --text: #171717;
            --text-secondary: #666666;
            --text-muted: #8b8b8b;
            --icon: #9a9a9a;

            --border: #eeeeee;
            --white: #ffffff;
            --shadow: rgba(0, 0, 0, .05);
        }

        [data-theme="dark"] {
            --primary: #e63946;
            --primary-hover: #ff4d5a;
            --primary-dark: #b92332;

            --primary-soft: rgba(230, 57, 70, .12);
            --primary-shadow: rgba(230, 57, 70, .25);

            --page-bg: #0b0d10;
            --card-bg: #15181d;
            --header-bg: #111418;

            --text: #f5f5f5;
            --text-secondary: #a7adb8;
            --text-muted: #8d95a3;
            --icon: #d5d9df;

            --border: #272c34;
            --white: #ffffff;
            --shadow: rgba(0, 0, 0, .30);
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

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        /* HEADER */
        .header {
            height: 68px;
            background: var(--header-bg);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-inner {
            width: 100%;
            max-width: 1100px;
            margin: auto;
            padding: 0 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .back-btn {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            background: var(--page-bg);
            border: 1px solid var(--border);
            transition: .2s;
            flex-shrink: 0;
        }

        .back-btn:hover {
            color: var(--primary);
            border-color: var(--primary);
        }

        .header-title {
            flex: 1;
        }

        .header-title h1 {
            font-size: 16px;
            font-weight: 800;
        }

        .header-title p {
            margin-top: 2px;
            font-size: 9px;
            color: var(--text-muted);
        }

        .header-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-soft);
            color: var(--primary);
            flex-shrink: 0;
        }

        /* PAGE */
        .page {
            width: 100%;
            max-width: 700px;
            margin: auto;
            padding: 22px 18px 40px;
        }

        .section {
            margin-bottom: 22px;
        }

        .section-title {
            font-size: 11px;
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 9px;
            padding-left: 3px;
        }

        /* SETTINGS CARD */
        .settings-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px var(--shadow);
        }

        /* THEME OPTIONS */
        .theme-option {
            width: 100%;
            border: none;
            border-bottom: 1px solid var(--border);
            background: transparent;
            color: var(--text);
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 13px;
            text-align: left;
            cursor: pointer;
            transition: .2s;
        }

        .theme-option:last-of-type {
            border-bottom: none;
        }

        .theme-option:hover {
            background: var(--primary-soft);
        }

        .theme-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--page-bg);
            color: var(--icon);
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .theme-option.active .theme-icon {
            background: var(--primary-soft);
            color: var(--primary);
            border-color: var(--primary);
        }

        .theme-info {
            flex: 1;
        }

        .theme-name {
            display: block;
            font-size: 12px;
            font-weight: 700;
        }

        .theme-description {
            display: block;
            margin-top: 3px;
            font-size: 9px;
            color: var(--text-muted);
        }

        .check {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: transparent;
            font-size: 10px;
            flex-shrink: 0;
        }

        .theme-option.active .check {
            background: var(--primary);
            color: var(--white);
        }

        /* LOGOUT */
        .logout-form {
            margin: 12px;
        }

        .logout-btn {
            width: 100%;
            border: 1px solid rgba(230, 57, 70, .18);
            background: var(--card-bg);
            border-radius: 15px;
            padding: 13px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
            cursor: pointer;
            color: var(--text);
            transition: .2s ease;
        }

        .logout-btn:hover {
            border-color: var(--primary);
            background: var(--primary-soft);
        }

        .logout-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--primary-soft);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .logout-text {
            flex: 1;
        }

        .logout-text strong {
            display: block;
            color: var(--text);
            font-size: 13px;
            font-weight: 800;
        }

        .logout-text small {
            display: block;
            margin-top: 3px;
            color: var(--text-muted);
            font-size: 9px;
        }

        .logout-arrow {
            color: var(--text-muted);
            font-size: 11px;
        }

        /* ABOUT */
        .info-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 17px;
            display: flex;
            align-items: center;
            gap: 13px;
            box-shadow: 0 10px 30px var(--shadow);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--primary-soft);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-text strong {
            display: block;
            font-size: 11px;
        }

        .info-text span {
            display: block;
            margin-top: 3px;
            font-size: 9px;
            color: var(--text-muted);
        }

        /* GS WEB SITES CONTACT */
        .gs-contact {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 16px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 30px var(--shadow);
            transition: .2s ease;
        }

        .gs-contact:hover {
            border-color: #1683ff;
            background: var(--primary-soft);
        }

        .gs-contact-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(0, 132, 255, .12);
            color: #1683ff;
            font-size: 20px;
        }

        .gs-contact-info {
            flex: 1;
            min-width: 0;
        }

        .gs-contact-info strong {
            display: block;
            font-size: 12px;
            font-weight: 800;
            color: var(--text);
        }

        .gs-contact-info span {
            display: block;
            margin-top: 4px;
            font-size: 10px;
            line-height: 1.5;
            color: var(--text-muted);
        }

        .gs-contact-arrow {
            color: var(--text-muted);
            font-size: 12px;
            flex-shrink: 0;
        }

        /* DESKTOP */
        @media (min-width: 700px) {
            .page {
                padding-top: 35px;
            }

            .header-inner {
                padding: 0 25px;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="header">
        <div class="header-inner">

            <a href="{{ route('home') }}" class="back-btn" aria-label="Go back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="header-title">
                <h1>Settings</h1>
                <p>Customize your AL SALAMA experience</p>
            </div>

            <div class="header-icon">
                <i class="fa-solid fa-gear"></i>
            </div>

        </div>
    </header>

    <main class="page">

        <!-- APPEARANCE -->
        <div class="section">

            <div class="section-title">Appearance</div>

            <div class="settings-card">

                <!-- LIGHT MODE -->
                <button
                    type="button"
                    class="theme-option"
                    data-theme-option="light"
                >
                    <div class="theme-icon">
                        <i class="fa-solid fa-sun"></i>
                    </div>

                    <div class="theme-info">
                        <span class="theme-name">Light Mode</span>
                        <span class="theme-description">
                            Clean and bright appearance
                        </span>
                    </div>

                    <div class="check">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </button>

                <!-- DARK MODE -->
                <button
                    type="button"
                    class="theme-option"
                    data-theme-option="dark"
                >
                    <div class="theme-icon">
                        <i class="fa-solid fa-moon"></i>
                    </div>

                    <div class="theme-info">
                        <span class="theme-name">Dark Mode</span>
                        <span class="theme-description">
                            Easier on the eyes in low light
                        </span>
                    </div>

                    <div class="check">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </button>

                <!-- LOG OUT -->
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf

                    <button type="submit" class="logout-btn">
                        <span class="logout-icon">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>

                        <span class="logout-text">
                            <strong>Log Out</strong>
                            <small>Sign out of your account</small>
                        </span>

                        <i class="fa-solid fa-chevron-right logout-arrow"></i>
                    </button>
                </form>

            </div>
        </div>

        <!-- CONTACT GS WEB SITES -->
        <div class="section">

            <div class="section-title">Website Development</div>

            <a
                href="https://m.me/61594264811868"
                target="_blank"
                rel="noopener noreferrer"
                class="gs-contact"
            >
                <div class="gs-contact-icon">
                    <i class="fa-brands fa-facebook-messenger"></i>
                </div>

                <div class="gs-contact-info">
                    <strong>تواصل مع المبرمجين</strong>
                    <span> GS official</span>
                </div>

                <i class="fa-solid fa-chevron-right gs-contact-arrow"></i>
            </a>

        </div>

        <!-- ABOUT -->
        <div class="section">

            <div class="section-title">About</div>

            <div class="info-card">
                <div class="info-icon">
                    <i class="fa-solid fa-utensils"></i>
                </div>

                <div class="info-text">
                    <strong>AL SALAMA</strong>
                    <span>Fresh • Fast • Delicious</span>
                </div>
            </div>

        </div>

    </main>

    <script>
        /* THEME SYSTEM */
        const html = document.documentElement;

        const themeOptions = document.querySelectorAll('[data-theme-option]');

        function applyTheme(theme) {
            html.setAttribute('data-theme', theme);

            try {
                localStorage.setItem('alsalama-theme', theme);
            } catch (error) {
                // The selected theme still applies for this page.
            }

            themeOptions.forEach(option => {
                option.classList.toggle(
                    'active',
                    option.dataset.themeOption === theme
                );
            });
        }

        let savedTheme = 'dark';

        try {
            savedTheme = localStorage.getItem('alsalama-theme') || 'dark';
        } catch (error) {
            savedTheme = 'dark';
        }

        applyTheme(savedTheme);

        themeOptions.forEach(option => {
            option.addEventListener('click', function () {
                applyTheme(this.dataset.themeOption);
            });
        });
    </script>

</body>
</html>
