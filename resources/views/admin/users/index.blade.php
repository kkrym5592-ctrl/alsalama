<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manage Users - AL SALAMA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --red: #e63946;
            --red-dark: #c92735;
            --bg: #f5f6f8;
            --border: #e5e7eb;
            --text: #202124;
            --muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 18px 0;
        }

        .brand {
            color: var(--red);
            font-size: 23px;
            font-weight: 800;
            text-decoration: none;
        }

        .brand:hover {
            color: var(--red-dark);
        }

        .page {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 16px;
        }

        .main-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .card-heading {
            padding: 22px;
            border-bottom: 1px solid var(--border);
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            background: #fafafa;
        }

        .table td,
        .table th {
            padding: 16px;
            vertical-align: middle;
        }

        .role-select {
            min-width: 145px;
            border-color: var(--border);
        }

        .role-select:focus,
        .search-input:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 .2rem rgba(230, 57, 70, .12);
        }

        .btn-red {
            background: var(--red);
            color: #fff;
            border: 1px solid var(--red);
        }

        .btn-red:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
            color: #fff;
        }

        .role-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #f1f2f4;
            font-size: 12px;
            font-weight: 700;
        }

        .muted {
            color: var(--muted);
        }

        .search-form {
            width: 100%;
            max-width: 480px;
        }

        .search-input {
            min-width: 0;
            border-color: var(--border);
        }

        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-link {
            color: var(--red);
        }

        .pagination .active > .page-link {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
        }

        @media (max-width: 600px) {
            .page {
                margin-top: 20px;
            }

            .card-heading {
                padding: 16px;
            }

            .table td,
            .table th {
                padding: 12px;
            }

            .search-form {
                max-width: 100%;
            }

            .search-form .btn {
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
        <a href="{{ url('/admin') }}" class="brand">
            <i class="fa-solid fa-utensils"></i>
            AL SALAMA
        </a>

        <a href="{{ url('/admin/dashboard') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i>
            Dashboard
        </a>
    </div>
</header>

<main class="page">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Manage Users</h3>
            <div class="muted">View users and update their roles.</div>
        </div>

        <span class="role-badge">
            {{ $users->total() }} Users
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check me-1"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="main-card">

        {{-- Header and Search --}}
        <div class="card-heading">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <h5 class="fw-bold mb-1">Users List</h5>
                    <small class="muted">
                        Search users by name or phone number.
                    </small>
                </div>

                <form action="{{ route('admin.users.index') }}"
                      method="GET"
                      class="search-form d-flex gap-2">

                    <input
                        type="search"
                        name="search"
                        value="{{ $search ?? request('search', '') }}"
                        class="form-control search-input"
                        placeholder="Search by name or phone..."
                        aria-label="Search users by name or phone"
                    >

                    <button type="submit" class="btn btn-red">
                        <i class="fa-solid fa-magnifying-glass me-1"></i>
                        Search
                    </button>

                    @if(request('search'))
                        <a href="{{ route('admin.users.index') }}"
                           class="btn btn-outline-secondary"
                           title="Clear search"
                           aria-label="Clear search">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif

                </form>

            </div>
        </div>

        {{-- Users Table --}}
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Current Role</th>
                        <th>Change Role</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                {{ $users->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <div class="fw-bold">
                                    {{ $user->name }}
                                </div>

                                <small class="muted">
                                    ID: {{ $user->id }}
                                </small>
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>
                                {{ $user->phone ?? '—' }}
                            </td>

                            <td>
                                <span class="role-badge">
                                    {{ ucfirst($user->role ?? 'customer') }}
                                </span>
                            </td>

                            <td>
                                <form
                                    id="role-form-{{ $user->id }}"
                                    action="{{ route('admin.users.updateRole', $user) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="role"
                                        class="form-select form-select-sm role-select"
                                        required
                                    >
                                       @foreach([
    'customer' => 'Customer',
    'delivery' => 'Delivery',
    'restaurant' => 'Restaurant',
] as $value => $label)
    <option
        value="{{ $value }}"
        @selected(($user->role ?? 'customer') === $value)
    >
        {{ $label }}
    </option>
@endforeach
                                    </select>
                                </form>
                            </td>

                            <td>
                                <button
                                    type="submit"
                                    form="role-form-{{ $user->id }}"
                                    class="btn btn-red btn-sm"
                                >
                                    <i class="fa-solid fa-floppy-disk me-1"></i>
                                    Save
                                </button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fa-solid fa-users fa-2x muted mb-3"></i>

                                <div class="fw-bold">
                                    No users found
                                </div>

                                <small class="muted">
                                    Try another name or phone number.
                                </small>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="p-3 d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        @endif

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
