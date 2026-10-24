<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - AL SALAMA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        /* =========================
           THEME VARIABLES
        ========================= */

        :root {

            --primary: #e63946;
            --primary-hover: #cf3040;

            --primary-soft: rgba(230, 57, 70, .08);
            --primary-shadow: rgba(230, 57, 70, .18);

            --page-bg: #f7f7f7;
            --card-bg: #ffffff;
            --input-bg: #ffffff;

            --text: #171717;
            --text-dark: #252525;
            --text-secondary: #666666;
            --text-muted: #8b8b8b;
            --text-light: #909090;
            --icon: #a0a0a0;

            --border: #eeeeee;
            --input-border: #e5e5e5;

            --white: #ffffff;

            --error: #dc2626;

            --shadow: rgba(0,0,0,.05);

        }


        /* =========================
           RESET
        ========================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: var(--page-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text);
        }


        a {
            text-decoration: none;
            color: inherit;
        }


        /* =========================
           CONTAINER
        ========================= */

        .auth-container {
            width: 100%;
            max-width: 420px;
        }


        /* =========================
           BRAND
        ========================= */

        .brand {
            text-align: center;
            margin-bottom: 25px;
        }


        .brand-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 12px;
            border-radius: 17px;
            background: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 10px 25px var(--primary-shadow);
        }


        .brand h1 {
            font-size: 23px;
            font-weight: 900;
            letter-spacing: -.7px;
        }


        .brand p {
            color: var(--text-light);
            font-size: 11px;
            margin-top: 5px;
        }


        /* =========================
           CARD
        ========================= */

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 28px 24px;
            box-shadow: 0 15px 40px var(--shadow);
        }


        .card h2 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 6px;
        }


        .card-subtitle {
            color: var(--text-muted);
            font-size: 11px;
            margin-bottom: 24px;
        }


        /* =========================
           FORM
        ========================= */

        .form-group {
            margin-bottom: 17px;
        }


        label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 7px;
        }


        .input-wrapper {
            position: relative;
        }


        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--icon);
            font-size: 13px;
            pointer-events: none;
        }


        input {
            width: 100%;
            height: 47px;
            border: 1px solid var(--input-border);
            border-radius: 11px;
            outline: none;
            padding: 0 14px 0 40px;
            font-family: inherit;
            font-size: 12px;
            background: var(--input-bg);
            color: var(--text);
            transition: .2s;
        }


        input::placeholder {
            color: var(--text-light);
        }


        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-soft);
        }


        .error {
            color: var(--error);
            font-size: 10px;
            margin-top: 5px;
        }


        /* =========================
           REMEMBER
        ========================= */

        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 5px 0 20px;
        }


        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 10px;
            color: var(--text-secondary);
            margin: 0;
        }


        .remember input {
            width: 14px;
            height: 14px;
            padding: 0;
            accent-color: var(--primary);
        }


        .forgot {
            font-size: 10px;
            color: var(--primary);
            font-weight: 700;
        }


        /* =========================
           LOGIN BUTTON
        ========================= */

        .login-btn {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 11px;
            background: var(--primary);
            color: var(--white);
            font-family: inherit;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }


        .login-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }


        /* =========================
           REGISTER
        ========================= */

        .register-link {
            text-align: center;
            margin-top: 21px;
            font-size: 10px;
            color: var(--text-muted);
        }


        .register-link a {
            color: var(--primary);
            font-weight: 800;
        }


        /* =========================
           BACK HOME
        ========================= */

        .back-home {
            display: block;
            text-align: center;
            margin-top: 17px;
            color: var(--text-secondary);
            font-size: 10px;
        }


        .back-home i {
            margin-right: 5px;
        }


    </style>
</head>


<body>


<div class="auth-container">


    <!-- BRAND -->

    <div class="brand">

        <div class="brand-icon">

            <i class="fa-solid fa-utensils"></i>

        </div>


        <h1>
            AL SALAMA
        </h1>


        <p>
            Fresh • Fast • Delicious
        </p>

    </div>


    <!-- LOGIN CARD -->

    <div class="card">

        <h2>
            Welcome Back
        </h2>


        <p class="card-subtitle">
            Login to continue your order.
        </p>


        <form method="POST" action="{{ route('login') }}">

            @csrf


            <!-- EMAIL -->

            <div class="form-group">

                <label for="email">
                    Email Address
                </label>


                <div class="input-wrapper">

                    <i class="fa-regular fa-envelope"></i>


                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Enter your email"
                    >

                </div>


                @error('email')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- PASSWORD -->

            <div class="form-group">

                <label for="password">
                    Password
                </label>


                <div class="input-wrapper">

                    <i class="fa-solid fa-lock"></i>


                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your password"
                    >

                </div>


                @error('password')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- REMEMBER -->

            <div class="remember-row">

                <label class="remember">

                    <input
                        type="checkbox"
                        name="remember"
                    >

                    Remember me

                </label>


                @if (Route::has('password.request'))

                    <a
                        href="{{ route('password.request') }}"
                        class="forgot"
                    >
                        Forgot password?
                    </a>

                @endif

            </div>


            <!-- LOGIN -->

            <button type="submit" class="login-btn">

                <i class="fa-solid fa-arrow-right-to-bracket"></i>

                &nbsp; Login

            </button>

        </form>


        <!-- REGISTER -->

        <div class="register-link">

            Don't have an account?

            <a href="{{ route('register') }}">
                Create account
            </a>

        </div>

    </div>


    <!-- BACK -->

    <a
        href="{{ route('home') }}"
        class="back-home"
    >

        <i class="fa-solid fa-arrow-left"></i>

        Back to AL SALAMA

    </a>


</div>


</body>
</html>