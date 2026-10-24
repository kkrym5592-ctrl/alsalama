<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Customer | AL SALAMA</title>

    <style>
        * { box-sizing: border-box; }

        :root {
            --bg: #080808;
            --panel: #111111;
            --card: #181818;
            --border: #292929;
            --red: #e50914;
            --red-hover: #b80710;
            --white: #ffffff;
            --muted: #a1a1aa;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 25px;
            background: var(--bg);
            color: var(--white);
            font-family: Arial, sans-serif;
        }

        a { -webkit-tap-highlight-color: transparent; }

        .select-user-page {
            width: 100%;
            max-width: 900px;
            margin: 25px auto;
            padding: 28px;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, .35);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
            color: var(--muted);
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover { color: var(--red); }

        .page-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .header-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 52px;
            height: 52px;
            background: rgba(229, 9, 20, .12);
            border: 1px solid rgba(229, 9, 20, .35);
            border-radius: 12px;
            color: var(--red);
            font-size: 25px;
        }

        .page-header h1 {
            margin: 0 0 7px;
            font-size: 26px;
            font-weight: 800;
        }

        .page-header p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .walk-in {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 49px;
            padding: 13px 16px;
            margin-bottom: 22px;
            background: var(--red);
            border: 1px solid var(--red);
            border-radius: 9px;
            color: var(--white);
            font-size: 14px;
            font-weight: 800;
            text-align: center;
            text-decoration: none;
            transition: .2s ease;
        }

        .walk-in:hover {
            background: var(--red-hover);
            border-color: var(--red-hover);
            color: var(--white);
            transform: translateY(-1px);
        }

        .search-wrapper {
            position: relative;
            margin-bottom: 18px;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 18px;
            pointer-events: none;
        }

        .user-search {
            display: block;
            width: 100%;
            min-height: 49px;
            padding: 14px 15px 14px 45px;
            background: #0b0b0b;
            border: 1px solid #333;
            border-radius: 9px;
            outline: none;
            color: var(--white);
            font-size: 14px;
        }

        .user-search::placeholder { color: #777; }

        .user-search:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(229, 9, 20, .12);
        }

        .results-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 25px 0 14px;
        }

        .results-header h2 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .results-count {
            padding: 5px 10px;
            background: rgba(229, 9, 20, .12);
            border: 1px solid rgba(229, 9, 20, .25);
            border-radius: 20px;
            color: #ff525b;
            font-size: 12px;
            font-weight: 700;
        }

        .user-list {
            display: grid;
            gap: 10px;
        }

        .user-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 16px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 11px;
            color: var(--white);
            text-decoration: none;
            transition: .2s ease;
        }

        .user-item:hover {
            background: #201010;
            border-color: var(--red);
            color: var(--white);
            text-decoration: none;
            transform: translateY(-2px);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .user-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 46px;
            height: 46px;
            background: #242424;
            border: 1px solid #393939;
            border-radius: 50%;
            color: #ff444d;
            font-size: 19px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .user-details { min-width: 0; }

        .user-name {
            margin-bottom: 7px;
            color: var(--white);
            font-size: 15px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .user-phone {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #b5b5b5;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .phone-icon {
            color: var(--red);
            font-size: 14px;
        }

        .user-action {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-shrink: 0;
            color: var(--red);
            font-size: 13px;
            font-weight: 800;
            white-space: nowrap;
        }

        .empty-message {
            padding: 35px 20px;
            background: var(--card);
            border: 1px dashed #393939;
            border-radius: 11px;
            color: var(--muted);
            text-align: center;
        }

        .empty-icon {
            margin-bottom: 12px;
            color: var(--red);
            font-size: 30px;
        }

        .empty-message strong {
            display: block;
            margin-bottom: 7px;
            color: var(--white);
            font-size: 15px;
        }

        .empty-message p {
            margin: 0;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            body { padding: 12px; }

            .select-user-page {
                margin: 8px auto;
                padding: 17px;
                border-radius: 12px;
            }

            .page-header { gap: 12px; }

            .header-icon {
                width: 45px;
                height: 45px;
                font-size: 22px;
            }

            .page-header h1 { font-size: 22px; }
            .page-header p { font-size: 12px; }

            .user-item { padding: 12px; gap: 8px; }
            .user-info { gap: 10px; }

            .user-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .user-name { font-size: 14px; }
            .user-phone { font-size: 12px; }
            .user-action { gap: 4px; font-size: 12px; }
        }

        @media (max-width: 380px) {
            .user-action span:first-child { display: none; }
            .select-user-page { padding: 13px; }
        }
    </style>
</head>

<body>

<div class="select-user-page">

    <a href="{{ route('admin.orders.create') }}" class="back-link">
        &#8592; Back to Order
    </a>

    <div class="page-header">
        <div class="header-icon">&#128100;</div>
        <div>
            <h1>Select Customer</h1>
            <p>Choose a customer for this order</p>
        </div>
    </div>

    <a href="{{ route('admin.orders.create') }}" class="walk-in">
        <span>&#43;</span>
        Walk-in Customer (Default)
    </a>

    <div class="search-wrapper">
        <span class="search-icon">&#128269;</span>
        <input
            type="text"
            id="userSearch"
            class="user-search"
            placeholder="Search by customer name or phone..."
            autocomplete="off"
        >
    </div>

    <div class="results-header">
        <h2>Customers</h2>
        <span class="results-count" id="resultsCount">
            {{ $users->count() }} customers
        </span>
    </div>

    <div class="user-list" id="userList">

        @forelse($users as $user)
            <a
                class="user-item"
                href="{{ route('admin.orders.create', [
                    'customer_id' => $user->id,
                    'order_type' => request('order_type', 'takeaway')
                ]) }}"
                data-name="{{ strtolower($user->name ?? '') }}"
                data-phone="{{ preg_replace('/\s+/', '', $user->phone ?? '') }}"
            >
                <div class="user-info">
                    <div class="user-avatar">
                        {{ mb_substr($user->name ?? '?', 0, 1) }}
                    </div>

                    <div class="user-details">
                        <div class="user-name">
                            {{ $user->name ?? 'Unknown Customer' }}
                        </div>

                        <div class="user-phone">
                            <span class="phone-icon">&#9742;</span>
                            <span>{{ $user->phone ?? 'No phone number' }}</span>
                        </div>
                    </div>
                </div>

                <div class="user-action">
                    <span>Select</span>
                    <span>&#8594;</span>
                </div>
            </a>
        @empty
            <div class="empty-message">
                <div class="empty-icon">&#128100;</div>
                <strong>No customers found</strong>
                <p>There are no registered users to display.</p>
            </div>
        @endforelse

        <div class="empty-message" id="noSearchResults" style="display: none;">
            <div class="empty-icon">&#128269;</div>
            <strong>No matching customers</strong>
            <p>Try another name or phone number.</p>
        </div>

    </div>
</div>

<script>
    const userSearch = document.getElementById('userSearch');
    const userItems = document.querySelectorAll('.user-item');
    const resultsCount = document.getElementById('resultsCount');
    const noSearchResults = document.getElementById('noSearchResults');

    userSearch.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();
        const phoneQuery = query.replace(/\s+/g, '');
        let visibleCount = 0;

        userItems.forEach(function (item) {
            const name = (item.dataset.name || '').toLowerCase();
            const phone = (item.dataset.phone || '').replace(/\s+/g, '');

            const matches = name.includes(query) || phone.includes(phoneQuery);

            item.style.display = matches ? 'flex' : 'none';

            if (matches) visibleCount++;
        });

        resultsCount.textContent =
            visibleCount + (visibleCount === 1 ? ' customer' : ' customers');

        noSearchResults.style.display =
            visibleCount === 0 && userItems.length > 0 ? 'block' : 'none';
    });
</script>

</body>
</html>
