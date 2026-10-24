<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Groups | AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #080b12;
            --surface: #10151f;
            --surface-2: #151c28;
            --surface-3: #1b2432;
            --border: rgba(255,255,255,.075);
            --text: #f4f5f7;
            --muted: #8993a4;
            --red: #e63946;
            --red-dark: #bc2634;
            --green: #37c98a;
            --yellow: #ffc857;
            --blue: #60a5fa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(ellipse at top left, rgba(230,57,70,.08), transparent 35%),
                var(--bg);
            color: var(--text);
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
        }

        a {
            text-decoration: none;
        }

        button, input {
            font-family: inherit;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1600px;
            margin: auto;
            padding: 32px;
        }

        /* HEADER */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .brand-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-icon {
            width: 54px;
            height: 54px;
            border-radius: 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, var(--red), #a91626);
            color: white;
            font-size: 23px;
            box-shadow: 0 8px 28px rgba(230,57,70,.22);
        }

        .brand-title {
            margin: 0;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -.5px;
        }

        .brand-subtitle {
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .btn-custom {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 10px 17px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            transition: .2s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-primary-custom {
            background: var(--red);
            border: 1px solid var(--red);
            color: #fff;
            box-shadow: 0 5px 18px rgba(230,57,70,.15);
        }

        .btn-primary-custom:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            background: var(--surface-2);
            border: 1px solid var(--border);
            color: #d7dce5;
        }

        .btn-secondary-custom:hover {
            background: var(--surface-3);
            color: #fff;
        }

        .breadcrumb-line {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 24px;
        }

        .breadcrumb-line i {
            font-size: 10px;
        }

        .breadcrumb-line .current {
            color: #fff;
            font-weight: 700;
        }

        .page-heading {
            margin-bottom: 27px;
        }

        .page-heading h2 {
            font-size: 27px;
            font-weight: 900;
            margin: 0 0 8px;
        }

        .page-heading p {
            color: var(--muted);
            margin: 0;
            font-size: 13px;
        }

        /* STATISTICS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 17px;
            margin-bottom: 25px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 120px;
            padding: 22px;
            background: linear-gradient(145deg, var(--surface-2), var(--surface));
            border: 1px solid var(--border);
            border-radius: 19px;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            width: 95px;
            height: 95px;
            left: -30px;
            bottom: -40px;
            background: rgba(230,57,70,.06);
            border-radius: 50%;
            pointer-events: none;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .stat-value {
            font-size: 28px;
            line-height: 1.2;
            font-weight: 900;
        }

        .stat-icon {
            width: 49px;
            height: 49px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: rgba(230,57,70,.12);
            color: #ff5966;
            font-size: 20px;
            border: 1px solid rgba(230,57,70,.14);
        }

        .stat-icon.green {
            color: var(--green);
            background: rgba(55,201,138,.10);
            border-color: rgba(55,201,138,.13);
        }

        .stat-icon.blue {
            color: var(--blue);
            background: rgba(96,165,250,.10);
            border-color: rgba(96,165,250,.13);
        }

        /* CARDS */

        .content-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0,0,0,.13);
            margin-bottom: 22px;
        }

        .content-header {
            padding: 22px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .content-title {
            margin: 0;
            font-size: 16px;
            font-weight: 900;
        }

        .content-subtitle {
            margin-top: 5px;
            font-size: 12px;
            color: var(--muted);
        }

        .results-count {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 12px;
            border-radius: 9px;
            background: rgba(230,57,70,.10);
            border: 1px solid rgba(230,57,70,.16);
            color: #ff7580;
            font-size: 12px;
            font-weight: 800;
        }

        /* SEARCH */

        .filters {
            padding: 20px 24px;
            display: grid;
            grid-template-columns: minmax(220px, 1fr) auto auto;
            gap: 12px;
            border-bottom: 1px solid var(--border);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap > i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
        }

        .dark-control {
            width: 100%;
            min-height: 45px;
            background: #0b1019 !important;
            color: #f3f4f6 !important;
            border: 1px solid #273040 !important;
            border-radius: 11px !important;
            padding: 10px 15px;
            font-size: 13px;
            outline: none;
            box-shadow: none !important;
        }

        .input-wrap .dark-control {
            padding-left: 42px;
        }

        .dark-control:focus {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 3px rgba(230,57,70,.10) !important;
        }

        .dark-control::placeholder {
            color: #697386;
        }

        /* TABLE */

        .table-responsive {
            width: 100%;
        }

        .groups-table {
            width: 100%;
            min-width: 760px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            color: var(--text);
        }

        .groups-table thead th {
            padding: 16px 20px;
            background: #0d121b;
            color: #8792a4;
            border-bottom: 1px solid var(--border);
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
            text-align: left;
        }

        .groups-table tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(255,255,255,.045);
            font-size: 12px;
            text-align: left;
        }

        .groups-table tbody tr {
            transition: background .2s;
        }

        .groups-table tbody tr:hover {
            background: rgba(255,255,255,.022);
        }

        .groups-table tbody tr:last-child td {
            border-bottom: none;
        }

        .group-cell {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 220px;
        }

        .group-image,
        .group-placeholder {
            width: 58px;
            height: 58px;
            flex-shrink: 0;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: var(--surface-3);
        }

        .group-image {
            object-fit: cover;
        }

        .group-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ff6570;
            background: rgba(230,57,70,.10);
            font-size: 21px;
        }

        .group-name {
            font-size: 13px;
            font-weight: 800;
            color: #f5f6f8;
            margin-bottom: 5px;
            overflow-wrap: anywhere;
        }

        .group-meta {
            color: var(--muted);
            font-size: 11px;
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 37px;
            padding: 7px 10px;
            background: rgba(96,165,250,.10);
            border: 1px solid rgba(96,165,250,.14);
            border-radius: 8px;
            color: #93c5fd;
            font-weight: 900;
        }

        .date-cell {
            color: #cbd5e1;
            white-space: nowrap;
        }

        .actions-cell {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #171e2a;
            color: #d3d9e4;
            font-size: 12px;
            transition: .2s;
            cursor: pointer;
        }

        .action-edit:hover {
            background: rgba(255,200,87,.12);
            border-color: rgba(255,200,87,.3);
            color: var(--yellow);
        }

        .action-delete:hover {
            background: rgba(230,57,70,.13);
            border-color: rgba(230,57,70,.3);
            color: #ff6975;
        }

        /* EMPTY STATE */

        .empty-state {
            padding: 65px 20px !important;
            text-align: center !important;
        }

        .empty-icon {
            width: 75px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 17px;
            background: rgba(230,57,70,.09);
            border: 1px solid rgba(230,57,70,.13);
            color: var(--red);
            border-radius: 22px;
            font-size: 28px;
        }

        .empty-state h4 {
            font-size: 17px;
            font-weight: 900;
            margin-bottom: 8px;
            color: #fff;
        }

        .empty-state p {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 20px;
        }

        /* ALERTS */

        .alert-custom {
            border: 1px solid var(--border);
            background: var(--surface-2);
            color: var(--text);
            border-radius: 13px;
            padding: 14px 17px;
            margin-bottom: 20px;
        }

        .alert-success-custom {
            border-color: rgba(55,201,138,.25);
            color: #67e0b0;
        }

        .alert-danger-custom {
            border-color: rgba(230,57,70,.25);
            color: #ff818a;
        }

        /* PAGINATION */

        .pagination-area {
            padding: 20px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .pagination-info {
            color: var(--muted);
            font-size: 12px;
        }

        .pagination {
            margin: 0;
            gap: 5px;
        }

        .pagination .page-link {
            min-width: 35px;
            min-height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #151c28;
            color: #d6dce6;
            border: 1px solid var(--border);
            border-radius: 9px !important;
            font-size: 12px;
        }

        .pagination .page-item.active .page-link {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            background: #0d121b;
            color: #505a6b;
        }

        .footer-note {
            margin-top: 24px;
            text-align: center;
            color: #596476;
            font-size: 11px;
        }

        @media (max-width: 1000px) {
            .page-wrapper {
                padding: 22px;
            }

            .stat-card {
                padding: 17px;
            }
        }

        @media (max-width: 700px) {
            .page-wrapper {
                padding: 15px 12px;
            }

            .topbar {
                align-items: flex-start;
                margin-bottom: 24px;
            }

            .brand-icon {
                width: 45px;
                height: 45px;
                border-radius: 13px;
                font-size: 19px;
            }

            .brand-title {
                font-size: 19px;
            }

            .topbar > a {
                width: 100%;
            }

            .page-heading h2 {
                font-size: 23px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .stat-card {
                min-height: 95px;
            }

            .stat-value {
                font-size: 24px;
            }

            .filters {
                grid-template-columns: 1fr 1fr;
                padding: 16px;
            }

            .filters .input-wrap {
                grid-column: 1 / -1;
            }

            .content-header {
                padding: 18px 16px;
            }

            .groups-table thead th,
            .groups-table tbody td {
                padding: 13px 14px;
            }

            .pagination-area {
                padding: 16px;
            }
        }
    </style>
</head>

<body>
@php
    $totalGroups = $groups->total();
    $totalCategories = \App\Models\Category::whereIn(
        'group_id',
        $groups->getCollection()->pluck('id')
    )->count();

    $groupsWithCategories = $groups->getCollection()
        ->filter(fn ($group) => (int) ($group->categories_count ?? 0) > 0)
        ->count();

    $groupsWithoutCategories = $groups->count() - $groupsWithCategories;
@endphp

<div class="page-wrapper">

    {{-- HEADER --}}
    <header class="topbar">
        <div class="brand-area">
            <div class="brand-icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>

            <div>
                <h1 class="brand-title">AL SALAMA</h1>
                <div class="brand-subtitle">Restaurant Management Dashboard</div>
            </div>
        </div>

        <div class=" d-flex">
            <a href="{{ route('admin.menu-groups.create') }}"
               class="btn-custom btn-primary-custom mx-2">
                <i class="fa-solid fa-plus"></i>
                Add Menu Group
            </a>
            <a href="{{ route('admin.dashboard') }}"
               class="btn-custom btn-primary-custom">
               BACK        
            </a>

        </div>
    </header>

    <div class="breadcrumb-line">
        <span>Home</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span>Menu Management</span>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="current">Menu Groups</span>
    </div>

    <section class="page-heading">
        <h2>Menu Groups</h2>
        <p>Organize your menu sections and manage their linked categories.</p>
    </section>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-custom alert-danger-custom">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-custom alert-danger-custom">
            <div class="fw-bold mb-2">Something went wrong:</div>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- STATISTICS --}}
    <section class="stats-grid">

        <div class="stat-card">
            <div>
                <div class="stat-label">Total Menu Groups</div>
                <div class="stat-value">{{ number_format($totalGroups) }}</div>
            </div>
            <div class="stat-icon">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">Groups With Categories</div>
                <div class="stat-value">{{ number_format($groupsWithCategories) }}</div>
            </div>
            <div class="stat-icon green">
                <i class="fa-solid fa-folder-open"></i>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="stat-label">Groups Without Categories</div>
                <div class="stat-value">{{ number_format($groupsWithoutCategories) }}</div>
            </div>
            <div class="stat-icon blue">
                <i class="fa-solid fa-folder"></i>
            </div>
        </div>

    </section>

    {{-- MAIN TABLE --}}
    <section class="content-card">

        <div class="content-header">
            <div>
                <h3 class="content-title">All Menu Groups</h3>
                <div class="content-subtitle">
                    Manage group names, images and linked categories.
                </div>
            </div>

            <span class="results-count">
                <i class="fa-solid fa-layer-group"></i>
                {{ number_format($groups->total()) }} Groups
            </span>
        </div>

        {{-- SEARCH --}}
        <form action="{{ route('admin.menu-groups.index') }}"
              method="GET"
              class="filters">

            <div class="input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="search"
                    name="search"
                    class="dark-control"
                    placeholder="Search by group name..."
                    value="{{ request('search') }}"
                >
            </div>

            <button type="submit" class="btn-custom btn-primary-custom">
                <i class="fa-solid fa-filter"></i>
                Search
            </button>

            <a href="{{ route('admin.menu-groups.index') }}"
               class="btn-custom btn-secondary-custom">
                <i class="fa-solid fa-rotate-right"></i>
                Reset
            </a>

        </form>

        <div class="table-responsive">
            <table class="groups-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Menu Group</th>
                        <th>Categories</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($groups as $group)

                    <tr>
                        <td>
                            <span style="color:#8993a4;font-weight:800;">
                                {{ $groups->firstItem() + $loop->index }}
                            </span>
                        </td>

                        {{-- GROUP INFO --}}
                        <td>
                            <div class="group-cell">

                                @if($group->image)
                                    <img
                                        src="{{ asset('storage/' . ltrim(str_replace('public/', '', $group->image), '/')) }}"
                                        alt="{{ $group->name }}"
                                        class="group-image"
                                        loading="lazy"
                                        onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';"
                                    >

                                    <div class="group-placeholder" style="display:none;">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </div>
                                @else
                                    <div class="group-placeholder">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </div>
                                @endif

                                <div>
                                    <div class="group-name">
                                        {{ $group->name }}
                                    </div>
                                    <div class="group-meta">
                                        Group ID: {{ $group->id }}
                                    </div>
                                </div>

                            </div>
                        </td>

                        {{-- CATEGORY COUNT --}}
                        <td>
                            <span class="count-badge">
                                {{ $group->categories_count ?? $group->categories()->count() }}
                            </span>
                        </td>

                        {{-- CREATED DATE --}}
                        <td>
                            <span class="date-cell">
                                <i class="fa-regular fa-calendar me-1" style="color:#8993a4;"></i>
                                {{ $group->created_at?->format('d M Y') ?? '—' }}
                            </span>
                        </td>

                        {{-- ACTIONS --}}
                        <td>
                            <div class="actions-cell">

                                <a
                                    href="{{ route('admin.menu-groups.edit', $group) }}"
                                    class="action-btn action-edit"
                                    title="Edit menu group"
                                    aria-label="Edit menu group"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form
                                    action="{{ route('admin.menu-groups.destroy', $group) }}"
                                    method="POST"
                                    class="m-0"
                                    onsubmit="return confirm('Are you sure you want to delete this menu group?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn action-delete"
                                        title="Delete menu group"
                                        aria-label="Delete menu group"
                                    >
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="empty-state">

                            <div class="empty-icon">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>

                            @if(request()->filled('search'))
                                <h4>No Matching Menu Groups</h4>
                                <p>Try searching with a different group name.</p>

                                <a href="{{ route('admin.menu-groups.index') }}"
                                   class="btn-custom btn-secondary-custom">
                                    <i class="fa-solid fa-rotate-right"></i>
                                    Show All Groups
                                </a>
                            @else
                                <h4>No Menu Groups Yet</h4>
                                <p>Create your first group to organize the menu.</p>

                                <a href="{{ route('admin.menu-groups.create') }}"
                                   class="btn-custom btn-primary-custom">
                                    <i class="fa-solid fa-plus"></i>
                                    Create First Group
                                </a>
                            @endif

                        </td>
                    </tr>

                @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        @if($groups->hasPages())
            <div class="pagination-area">
                <div class="pagination-info">
                    Showing {{ $groups->firstItem() ?? 0 }}
                    to {{ $groups->lastItem() ?? 0 }}
                    of {{ $groups->total() }} groups
                </div>

                {{ $groups->onEachSide(1)->links() }}
            </div>
        @endif

    </section>

    <div class="footer-note">
        AL SALAMA &copy; {{ date('Y') }} — Menu Management
    </div>

</div>

<script>
    document.querySelectorAll('.alert-success-custom').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity .4s ease';
            alert.style.opacity = '0';

            setTimeout(function () {
                alert.remove();
            }, 400);
        }, 4500);
    });
</script>

</body>
</html>
