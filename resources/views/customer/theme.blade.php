<style>

    /* =========================
       AL SALAMA THEME VARIABLES
    ========================= */

    :root {

        --primary: #e63946;
        --primary-hover: #cf3040;
        --primary-dark: #a51d2d;

        --primary-soft: rgba(230, 57, 70, .08);
        --primary-shadow: rgba(230, 57, 70, .18);

        --page-bg: #f7f7f7;
        --card-bg: #ffffff;
        --header-bg: #ffffff;
        --nav-bg: rgba(255,255,255,.96);
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
        --black: #000000;

        --shadow: rgba(0,0,0,.05);

        --success: #18a058;
        --success-soft: #e7f8ef;

        --warning: #b77900;
        --warning-soft: #fff4df;

        --info: #2670d9;
        --info-soft: #eaf2ff;

        --error: #dc2626;
    }


    /* =========================
       DARK MODE
    ========================= */

    [data-theme="dark"] {

        --primary: #e63946;
        --primary-hover: #ff4d5a;
        --primary-dark: #b92332;

        --primary-soft: rgba(230,57,70,.12);
        --primary-shadow: rgba(230,57,70,.25);

        --page-bg: #0b0d10;
        --card-bg: #15181d;
        --header-bg: #111418;
        --nav-bg: rgba(17,20,24,.96);
        --input-bg: #111418;

        --text: #f5f5f5;
        --text-dark: #ffffff;
        --text-secondary: #a7adb8;
        --text-muted: #8d95a3;
        --text-light: #727b89;
        --icon: #d5d9df;

        --border: #272c34;
        --input-border: #303641;

        --white: #ffffff;
        --black: #000000;

        --shadow: rgba(0,0,0,.30);

        --success: #35c982;
        --success-soft: rgba(53,201,130,.12);

        --warning: #f5b942;
        --warning-soft: rgba(245,185,66,.12);

        --info: #4d9cff;
        --info-soft: rgba(77,156,255,.12);

        --error: #ff5c67;
    }


    /* =========================
       GLOBAL TRANSITION
    ========================= */

    html,
    body,
    * {
        transition:
            background-color .20s ease,
            border-color .20s ease,
            color .20s ease;
    }

</style>


<script>

    /*
    |--------------------------------------------------------------------------
    | AL SALAMA GLOBAL THEME
    |--------------------------------------------------------------------------
    */

    (function () {

        const savedTheme =
            localStorage.getItem('alsalama-theme') || 'light';

        document.documentElement.setAttribute(
            'data-theme',
            savedTheme
        );

    })();

</script>