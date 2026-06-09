@extends('layouts.app', ['title' => 'Vendor Dashboard | VendShield AI'])

@section('content')
    <div data-page="dashboard" data-protected class="space-y-5 lg:space-y-6">
        <section class="dashboard-hero animate-rise">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-bold text-[#aee4c7]">Vendor workspace</p>
                    <h1 class="mt-2 text-3xl font-bold leading-tight lg:text-4xl">Welcome back, <span data-dashboard-name>Vendor</span></h1>
                    <p data-dashboard-summary class="mt-3 max-w-2xl text-sm leading-6 text-[#d9f4e7]">Loading your escrow activity...</p>
                </div>

                <a href="{{ route('transactions.create') }}" class="inline-flex min-h-12 items-center justify-center rounded-lg bg-white px-5 py-3 text-sm font-bold text-[#103d2a] shadow-lg shadow-black/10">Create Payment Link</a>
            </div>

            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="text-sm font-medium text-[#b8dacb]">Protected in escrow</p>
                    <p data-metric="escrow" class="mt-2 text-3xl font-bold">&#8358;0</p>
                </div>
                <div class="rounded-lg bg-white/10 p-4">
                    <div class="flex items-center justify-between gap-3">
                        <p class="text-sm font-medium text-[#b8dacb]">Trust Score</p>
                        <span data-trust-level class="rounded-full bg-white/12 px-3 py-1 text-xs font-bold text-[#d9f4e7]">New Vendor</span>
                    </div>
                    <p data-metric="trust" class="mt-2 text-3xl font-bold">50/100</p>
                    <div class="mt-3 h-2 rounded-full bg-white/15">
                        <div data-trust-bar class="h-2 rounded-full bg-[#44d07b] transition-all duration-700" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-2 gap-3 lg:grid-cols-4">
            <div class="stat-card animate-rise" style="animation-delay: 40ms">
                <span class="stat-icon bg-[#eef8f1] text-[#0c6f43]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M8 6h13" /><path d="M8 12h13" /><path d="M8 18h13" /><path d="M3 6h.01" /><path d="M3 12h.01" /><path d="M3 18h.01" />
                    </svg>
                </span>
                <p class="mt-3 text-sm text-[#668175]">Total</p>
                <p data-metric="total" class="mt-1 text-2xl font-bold">0</p>
            </div>
            <div class="stat-card animate-rise" style="animation-delay: 80ms">
                <span class="stat-icon bg-[#fff6df] text-[#9a6500]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" /><path d="M12 6v6l4 2" />
                    </svg>
                </span>
                <p class="mt-3 text-sm text-[#668175]">Pending</p>
                <p data-metric="pending" class="mt-1 text-2xl font-bold">0</p>
            </div>
            <div class="stat-card animate-rise" style="animation-delay: 120ms">
                <span class="stat-icon bg-[#e8fbef] text-[#08723f]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                </span>
                <p class="mt-3 text-sm text-[#668175]">Completed</p>
                <p data-metric="completed" class="mt-1 text-2xl font-bold">0</p>
            </div>
            <div class="stat-card animate-rise" style="animation-delay: 160ms">
                <span class="stat-icon bg-[#ffe8e5] text-[#b42318]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 9v4" /><path d="M12 17h.01" /><path d="m10.29 3.86-8.2 14.22A2 2 0 0 0 3.82 21h16.36a2 2 0 0 0 1.73-2.92l-8.2-14.22a2 2 0 0 0-3.42 0Z" />
                    </svg>
                </span>
                <p class="mt-3 text-sm text-[#668175]">Disputed</p>
                <p data-metric="disputed" class="mt-1 text-2xl font-bold">0</p>
            </div>
        </section>

        <section class="grid gap-5 lg:grid-cols-[minmax(0,1fr)_360px]">
            <div class="space-y-5">
                <section class="metric-card animate-rise" style="animation-delay: 200ms">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-sm font-bold text-[#16834f]">Next action</p>
                            <h2 data-next-action-title class="mt-1 text-xl font-bold">Create your first escrow link</h2>
                            <p data-next-action-copy class="mt-2 text-sm leading-6 text-[#668175]">Start by creating a payment link for a buyer.</p>
                        </div>
                        <span data-next-action-badge class="status-pill status-info">Ready</span>
                    </div>
                    <a data-next-action-link href="{{ route('transactions.create') }}" class="mt-4 inline-flex min-h-11 items-center justify-center rounded-lg bg-[#103d2a] px-4 py-2 text-sm font-bold text-white">Take Action</a>
                </section>

                <section>
                    <div class="mb-3 flex items-center justify-between">
                        <h2 class="text-lg font-bold">Recent Transactions</h2>
                        <a href="{{ route('transactions.index') }}" class="text-sm font-bold text-[#0c6f43]">View all</a>
                    </div>

                    <div data-dashboard-transactions class="grid gap-3 lg:grid-cols-2">
                        <p class="rounded-lg bg-white p-4 text-sm text-[#668175]">Loading transactions...</p>
                    </div>
                </section>
            </div>

            <aside class="metric-card animate-rise" style="animation-delay: 240ms">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-lg font-bold">Recent Activity</h2>
                    <span class="rounded-full bg-[#eef8f1] px-3 py-1 text-xs font-bold text-[#0c6f43]">Live</span>
                </div>
                <div data-activity-list class="mt-4 space-y-4">
                    <p class="text-sm text-[#668175]">Loading activity...</p>
                </div>
            </aside>
        </section>
    </div>
@endsection
