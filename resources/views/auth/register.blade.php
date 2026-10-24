<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - AL SALAMA</title>

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
            --text-secondary: #888888;
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
            color: inherit;
        }


        .auth-container {
            width: 100%;
            max-width: 430px;
        }


        /* =========================
           BRAND
        ========================= */

        .brand {
            text-align: center;
            margin-bottom: 22px;
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
            padding: 27px 24px;
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
            margin-bottom: 23px;
        }


        /* =========================
           FORM
        ========================= */

        .form-group {
            margin-bottom: 15px;
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


        input,
        textarea {
            width: 100%;
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


        input {
            height: 46px;
        }


        textarea {
            min-height: 80px;
            padding-top: 14px;
            padding-bottom: 12px;
            resize: vertical;
            line-height: 1.5;
        }


        input::placeholder,
        textarea::placeholder {
            color: var(--text-light);
        }


        input:focus,
        textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-soft);
        }


        .error {
            color: var(--error);
            font-size: 10px;
            margin-top: 5px;
        }


        /* =========================
           BUTTON
        ========================= */

        .register-btn {
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
            margin-top: 5px;
        }


        .register-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }


        /* =========================
           LOGIN
        ========================= */

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: var(--text-secondary);
        }


        .login-link a {
            color: var(--primary);
            font-weight: 800;
            text-decoration: none;
        }


        /* =========================
           BACK HOME
        ========================= */

        .back-home {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: var(--text-secondary);
            font-size: 10px;
            text-decoration: none;
        }


        .back-home i {
            margin-right: 5px;
        }


        /* =========================
           DESKTOP
        ========================= */

        @media (min-width: 700px) {

            body {
                padding: 40px;
            }

            .card {
                padding: 30px 28px;
            }

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


    <!-- REGISTER CARD -->

    <div class="card">

        <h2>
            Create Account
        </h2>


        <p class="card-subtitle">
            Create your account and start ordering.
        </p>


        <form method="POST" action="{{ route('register') }}">

            @csrf


            <!-- NAME -->

            <div class="form-group">

                <label for="name">
                    Full Name
                </label>


                <div class="input-wrapper">

                    <i class="fa-regular fa-user"></i>


                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Enter your full name"
                    >

                </div>


                @error('name')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


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


            <!-- PHONE -->

            <div class="form-group">

                <label for="phone">
                    Phone Number
                </label>


                <div class="input-wrapper">

                    <i class="fa-solid fa-phone"></i>


                    <input
                        id="phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        required
                        autocomplete="tel"
                        placeholder="Enter your phone number"
                    >

                </div>


                @error('phone')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- ADDRESS -->

            <div class="form-group">

                <label for="address">
                    Delivery Address
                </label>


                <div class="input-wrapper">

                    <i class="fa-solid fa-location-dot"></i>


                    <textarea
                        id="address"
                        name="address"
                        required
                        autocomplete="street-address"
                        placeholder="Enter your delivery address"
                    >{{ old('address') }}</textarea>

                </div>


                @error('address')

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
                        autocomplete="new-password"
                        placeholder="Create a password"
                    >

                </div>


                @error('password')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- CONFIRM PASSWORD -->

            <div class="form-group">

                <label for="password_confirmation">
                    Confirm Password
                </label>


                <div class="input-wrapper">

                    <i class="fa-solid fa-shield-halved"></i>


                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm your password"
                    >

                </div>


                @error('password_confirmation')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!-- REGISTER -->

            <button
                type="submit"
                class="register-btn"
            >

                <i class="fa-solid fa-user-plus"></i>

                &nbsp; Create Account

            </button>

        </form>


        <!-- LOGIN -->

        <div class="login-link">

            Already have an account?

            <a href="{{ route('login') }}">
                Login
            </a>

        </div>

    </div>


    <!-- BACK HOME -->

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