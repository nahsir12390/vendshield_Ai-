@extends('layouts.app', ['title' => 'Transactions | VendShield AI'])

@section('content')
    <div data-page="transactions" data-protected class="space-y-5 lg:space-y-6">
        <section class="soft-hero">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="soft-eyebrow">Vendor history</p>
                    <h1 class="mt-2 text-3xl font-bold leading-tight lg:text-4xl">Transactions</h1>
                    <p data-transaction-summary class="mt-3 max-w-2xl soft-copy">Track pending, completed, disputed, and verified escrow activity.</p>
                </div>
                <a href="{{ route('transactions.create') }}" class="inline-flex min-h-12 items-center justify-center rounded-lg bg-[#16a35f] px-5 py-3 text-sm font-bold text-white shadow-lg shadow-[#16a35f]/15">Create New Transaction</a>
            </div>
        </section>

        <section class="grid grid-cols-2 gap-3 lg:grid-cols-4">
            <div class="stat-card">
                <p class="text-sm text-[#668175]">Total Value</p>
                <p data-transaction-stat="value" class="mt-1 text-2xl font-bold">&#8358;0</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-[#668175]">Pending</p>
                <p data-transaction-stat="pending" class="mt-1 text-2xl font-bold">0</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-[#668175]">Completed</p>
                <p data-transaction-stat="completed" class="mt-1 text-2xl font-bold">0</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-[#668175]">Disputed</p>
                <p data-transaction-stat="disputed" class="mt-1 text-2xl font-bold">0</p>
            </div>
        </section>

        <section class="metric-card">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold">All Transactions</h2>
                    <p class="mt-1 text-sm text-[#668175]">Open a transaction to copy the buyer checkout link.</p>
                </div>
                <label class="form-field lg:w-80">
                    <span class="sr-only">Search transactions</span>
                    <input data-transaction-search type="search" placeholder="Search item or status">
                </label>
            </div>

            <div data-transactions-list class="mt-4 grid gap-3 lg:grid-cols-2">
                <p class="rounded-lg bg-[#f8fbf8] p-4 text-sm text-[#668175]">Loading transactions...</p>
            </div>
        </section>
    </div>
@endsection
