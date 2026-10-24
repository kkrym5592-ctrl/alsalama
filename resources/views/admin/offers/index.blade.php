
@extends('layouts.app')

@section('content')
<div class="offers-page">

    <style>
        .offers-page {
            --offer-red: #e63946;
            --offer-bg: #0b0d12;
            --offer-card: #141720;
            --offer-border: rgba(255,255,255,.09);
            color: #f5f5f5;
            padding: 24px;
            min-height: 100vh;
        }

        .offers-page * {
            box-sizing: border-box;
        }

        .offers-page .offers-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .offers-page .offers-title {
            font-size: 27px;
            font-weight: 800;
            margin: 0 0 7px;
            color: #fff;
        }

        .offers-page .offers-subtitle {
            color: #9ca3af;
            margin: 0;
            font-size: 14px;
        }

        .offers-page .offer-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 17px;
            border-radius: 10px;
            text-decoration: none;
            border: 1px solid transparent;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
            white-space: nowrap;
        }

        .offers-page .offer-btn-primary {
            background: var(--offer-red);
            color: #fff;
        }

        .offers-page .offer-btn-primary:hover {
            background: #c92735;
            color: #fff;
        }

        .offers-page .offer-btn-secondary {
            background: #202430;
            color: #fff;
            border-color: var(--offer-border);
        }

        .offers-page .offer-btn-secondary:hover {
            background: #2b3040;
            color: #fff;
        }

        .offers-page .offer-btn-edit {
            background: rgba(22,131,255,.12);
            color: #60a5fa;
            border-color: rgba(22,131,255,.2);
            padding: 8px 11px;
        }

        .offers-page .offer-btn-toggle {
            background: rgba(16,185,129,.10);
            color: #34d399;
            border-color: rgba(16,185,129,.2);
            padding: 8px 11px;
        }

        .offers-page .offer-btn-delete {
            background: rgba(230,57,70,.10);
            color: #fb7185;
            border-color: rgba(230,57,70,.2);
            padding: 8px 11px;
        }

        .offers-page .offer-filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            background: var(--offer-card);
            border: 1px solid var(--offer-border);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .offers-page .offer-input,
        .offers-page .offer-select {
            background: #0d1017;
            color: #fff;
            border: 1px solid #303543;
            border-radius: 9px;
            padding: 11px 13px;
            min-height: 43px;
            outline: none;
        }

        .offers-page .offer-input {
            flex: 1;
            min-width: 200px;
        }

        .offers-page .offer-select {
            min-width: 150px;
        }

        .offers-page .offer-input:focus,
        .offers-page .offer-select:focus {
            border-color: var(--offer-red);
            box-shadow: 0 0 0 3px rgba(230,57,70,.12);
        }

        .offers-page .offer-input::placeholder {
            color: #777f8e;
        }

        .offers-page .offer-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .offers-page .offer-stat {
            background: var(--offer-card);
            border: 1px solid var(--offer-border);
            border-radius: 14px;
            padding: 18px;
        }

        .offers-page .offer-stat-label {
            color: #9ca3af;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .offers-page .offer-stat-value {
            font-size: 27px;
            font-weight: 800;
            color: #fff;
        }

        .offers-page .offer-stat-icon {
            color: var(--offer-red);
            font-size: 19px;
            margin-bottom: 12px;
        }

        .offers-page .offers-table-wrap {
            background: var(--offer-card);
            border: 1px solid var(--offer-border);
            border-radius: 15px;
            overflow: hidden;
        }

        .offers-page .offers-table-heading {
            padding: 18px 20px;
            border-bottom: 1px solid var(--offer-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .offers-page .offers-table-heading h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
            color: #fff;
        }

        .offers-page .offers-table-heading span {
            color: #9ca3af;
            font-size: 13px;
        }

        .offers-page .table-responsive {
            overflow-x: auto;
        }

        .offers-page table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
            margin: 0;
        }

        .offers-page thead {
            background: #10131b;
        }

        .offers-page th {
            padding: 15px;
            text-align: left;
            color: #9ca3af;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            border-bottom: 1px solid var(--offer-border);
        }

        .offers-page td {
            padding: 16px 15px;
            color: #e5e7eb;
            border-bottom: 1px solid rgba(255,255,255,.055);
            vertical-align: middle;
            font-size: 13px;
        }

        .offers-page tbody tr:last-child td {
            border-bottom: 0;
        }

        .offers-page tbody tr:hover {
            background: rgba(255,255,255,.025);
        }

        .offers-page .offer-name {
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .offers-page .offer-muted {
            color: #8b93a3;
            font-size: 12px;
        }

        .offers-page .offer-discount {
            display: inline-block;
            background: rgba(230,57,70,.13);
            color: #ff7b86;
            border: 1px solid rgba(230,57,70,.2);
            padding: 7px 10px;
            border-radius: 8px;
            font-weight: 800;
            white-space: nowrap;
        }

        .offers-page .offer-target {
            display: inline-block;
            background: #202430;
            color: #d1d5db;
            padding: 6px 9px;
            border-radius: 7px;
            font-size: 12px;
        }

        .offers-page .offer-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .offers-page .offer-status-active {
            color: #34d399;
            background: rgba(16,185,129,.10);
        }

        .offers-page .offer-status-inactive {
            color: #fca5a5;
            background: rgba(239,68,68,.10);
        }

        .offers-page .offer-status-scheduled {
            color: #fbbf24;
            background: rgba(245,158,11,.10);
        }

        .offers-page .offer-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .offers-page .offer-actions form {
            margin: 0;
        }

        .offers-page .offer-alert {
            padding: 13px 16px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .offers-page .offer-alert-success {
            background: rgba(16,185,129,.12);
            color: #6ee7b7;
            border: 1px solid rgba(16,185,129,.25);
        }

        .offers-page .offer-alert-error {
            background: rgba(230,57,70,.12);
            color: #fda4af;
            border: 1px solid rgba(230,57,70,.25);
        }

        .offers-page .offer-empty {
            text-align: center;
            padding: 55px 20px;
        }

        .offers-page .offer-empty i {
            font-size: 38px;
            color: #525968;
            margin-bottom: 15px;
        }

        .offers-page .offer-empty h4 {
            color: #fff;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .offers-page .offer-empty p {
            color: #9ca3af;
            margin-bottom: 20px;
        }

        .offers-page .offer-pagination {
            padding: 18px;
            border-top: 1px solid var(--offer-border);
        }

        .offers-page .offer-pagination nav {
            display: flex;
            justify-content: center;
        }

        .offers-page .offer-pagination .pagination {
            margin: 0;
            flex-wrap: wrap;
            gap: 4px;
        }

        .offers-page .offer-pagination .page-link {
            background: #10131b;
            border-color: #303543;
            color: #e5e7eb;
            border-radius: 7px;
        }

        .offers-page .offer-pagination .active .page-link {
            background: var(--offer-red);
            border-color: var(--offer-red);
            color: #fff;
        }

        @media (max-width: 768px) {
            .offers-page {
                padding: 15px 10px;
            }

            .offers-page .offers-title {
                font-size: 23px;
            }

            .offers-page .offer-stats {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .offers-page .offer-stat {
                padding: 15px;
            }

            .offers-page .offer-stat-value {
                font-size: 23px;
            }

            .offers-page .offer-filters {
                flex-direction: column;
            }

            .offers-page .offer-input,
            .offers-page .offer-select,
            .offers-page .offer-filters .offer-btn {
                width: 100%;
            }
        }
    </style>

    @php
        $allOffersCount = $offers->total();

        $activeOffersCount = \App\Models\Offer::where('is_active', true)->count();

        $inactiveOffersCount = \App\Models\Offer::where('is_active', false)->count();
    @endphp

    {{-- HEADER --}}
    <div class="offers-header">
        <div>
            <h1 class="offers-title">
                <i class="fas fa-tags" style="color:#e63946;"></i>
                Offers & Discounts
            </h1>

            <p class="offers-subtitle">
                Manage restaurant promotions and special discounts.
            </p>
        </div>

        <a href="{{ route('admin.offers.create') }}"
           class="offer-btn offer-btn-primary">
            <i class="fas fa-plus"></i>
            Create New Offer
        </a>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="offer-alert offer-alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="offer-alert offer-alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="offer-alert offer-alert-error">
            <strong>Please check the following:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- STATISTICS --}}
    <div class="offer-stats">
        <div class="offer-stat">
            <div class="offer-stat-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="offer-stat-label">Total Offers</div>
            <div class="offer-stat-value">{{ $allOffersCount }}</div>
        </div>

        <div class="offer-stat">
            <div class="offer-stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="offer-stat-label">Enabled Offers</div>
            <div class="offer-stat-value">{{ $activeOffersCount }}</div>
        </div>

        <div class="offer-stat">
            <div class="offer-stat-icon">
                <i class="fas fa-pause-circle"></i>
            </div>
            <div class="offer-stat-label">Disabled Offers</div>
            <div class="offer-stat-value">{{ $inactiveOffersCount }}</div>
        </div>
    </div>

    {{-- FILTERS --}}
    <form action="{{ route('admin.offers.index') }}"
          method="GET"
          class="offer-filters">

        <input
            type="text"
            name="search"
            class="offer-input"
            placeholder="Search offers by name..."
            value="{{ request('search') }}"
        >

        <select name="status" class="offer-select">
            <option value="">All statuses</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>
                Enabled
            </option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>
                Disabled
            </option>
        </select>

        <button type="submit" class="offer-btn offer-btn-primary">
            <i class="fas fa-search"></i>
            Search
        </button>

        @if(request()->filled('search') || request()->filled('status'))
            <a href="{{ route('admin.offers.index') }}"
               class="offer-btn offer-btn-secondary">
                <i class="fas fa-times"></i>
                Reset
            </a>
        @endif
    </form>

    {{-- OFFERS TABLE --}}
    <div class="offers-table-wrap">

        <div class="offers-table-heading">
            <h3>
                <i class="fas fa-list" style="color:#e63946;"></i>
                All Offers
            </h3>

            <span>
                Showing {{ $offers->count() }} of {{ $offers->total() }} offers
            </span>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>OFFER</th>
                        <th>TARGET</th>
                        <th>DISCOUNT</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($offers as $offer)
                        @php
                            $now = now();

                            $isScheduled = $offer->starts_at && $offer->starts_at->gt($now);

                            $isExpired = $offer->ends_at && $offer->ends_at->lt($now);

                            $isCurrentlyActive = $offer->is_active
                                && !$isScheduled
                                && !$isExpired;
                        @endphp

                        <tr>
                            <td>
                                <div class="offer-name">
                                    {{ $offer->name }}
                                </div>

                                <div class="offer-muted">
                                    #{{ $offer->id }}
                                </div>
                            </td>

                            <td>
                                @if($offer->product)
                                    <span class="offer-target">
                                        <i class="fas fa-utensils"></i>
                                        Product
                                    </span>
                                    <div class="offer-muted mt-1">
                                        {{ $offer->product->name }}
                                    </div>
                                @elseif($offer->category)
                                    <span class="offer-target">
                                        <i class="fas fa-layer-group"></i>
                                        Category
                                    </span>
                                    <div class="offer-muted mt-1">
                                        {{ $offer->category->name }}
                                    </div>
                                @else
                                    <span class="offer-muted">Target unavailable</span>
                                @endif
                            </td>

                            <td>
                                <span class="offer-discount">
                                    @if($offer->discount_type === 'percentage')
                                        {{ rtrim(rtrim(number_format((float) $offer->discount_value, 2, '.', ''), '0'), '.') }}%
                                    @else
                                        {{ number_format((float) $offer->discount_value, 2) }}
                                        <small>EGP</small>
                                    @endif
                                </span>

                                <div class="offer-muted mt-1">
                                    {{ $offer->discount_type === 'percentage' ? 'Percentage' : 'Fixed amount' }}
                                </div>
                            </td>

                            <td>
                                {{ $offer->starts_at ? $offer->starts_at->format('d M Y, h:i A') : 'No start limit' }}
                            </td>

                            <td>
                                {{ $offer->ends_at ? $offer->ends_at->format('d M Y, h:i A') : 'No end limit' }}
                            </td>

                            <td>
                                @if(!$offer->is_active)
                                    <span class="offer-status offer-status-inactive">
                                        <i class="fas fa-pause-circle"></i>
                                        Disabled
                                    </span>
                                @elseif($isScheduled)
                                    <span class="offer-status offer-status-scheduled">
                                        <i class="fas fa-clock"></i>
                                        Scheduled
                                    </span>
                                @elseif($isExpired)
                                    <span class="offer-status offer-status-inactive">
                                        <i class="fas fa-calendar-times"></i>
                                        Expired
                                    </span>
                                @else
                                    <span class="offer-status offer-status-active">
                                        <i class="fas fa-check-circle"></i>
                                        Active
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="offer-actions">

                                    <a href="{{ route('admin.offers.edit', $offer) }}"
                                       class="offer-btn offer-btn-edit"
                                       title="Edit offer">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.offers.toggle-status', $offer) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to change this offer status?');">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                                class="offer-btn offer-btn-toggle"
                                                title="{{ $offer->is_active ? 'Disable offer' : 'Enable offer' }}">
                                            <i class="fas {{ $offer->is_active ? 'fa-pause' : 'fa-play' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.offers.destroy', $offer) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this offer permanently?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="offer-btn offer-btn-delete"
                                                title="Delete offer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="offer-empty">
                                    <i class="fas fa-tags"></i>

                                    <h4>No Offers Found</h4>

                                    <p>
                                        There are no offers matching your search.
                                        Create your first offer to get started.
                                    </p>

                                    <a href="{{ route('admin.offers.create') }}"
                                       class="offer-btn offer-btn-primary">
                                        <i class="fas fa-plus"></i>
                                        Create New Offer
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($offers->hasPages())
            <div class="offer-pagination">
                {{ $offers->links() }}
            </div>
        @endif

    </div>
</div>
@endsection