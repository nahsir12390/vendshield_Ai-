@extends('layouts.app', ['title' => 'Transaction Details | VendShield AI'])

@section('content')
    @php
        $itemName = $transaction['itemName'] ?? 'Transaction unavailable';
        $price = (float) ($transaction['price'] ?? 0);
        $deliveryFee = (float) ($transaction['deliveryFee'] ?? 0);
        $total = (float) ($transaction['total'] ?? ($price + $deliveryFee));
        $status = $transaction['status'] ?? 'PENDING';
        $statusLabel = ucwords(strtolower(str_replace('_', ' ', $status)));
        $statusClass = str_contains($status, 'DISPUTED') ? 'status-danger' : (str_contains($status, 'PENDING') ? 'status-warning' : 'status-success');
    @endphp

    <div data-page="transaction-detail" data-protected data-transaction-id-value="{{ $id }}" class="max-w-full space-y-5 overflow-hidden lg:space-y-6">
        <section class="overflow-hidden rounded-lg bg-white p-4 lg:p-6">
            <p class="text-sm font-bold text-[#16834f]">
                Transaction
                <span data-transaction-id class="block max-w-full break-all text-xs leading-5 sm:inline sm:text-sm">{{ $id }}</span>
            </p>
            <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                <h1 data-item-name class="text-2xl font-bold leading-tight lg:text-3xl">{{ $itemName }}</h1>
                <span data-status class="status-pill {{ $statusClass }} self-start">{{ $statusLabel }}</span>
            </div>
        </section>

        <div class="grid gap-5 lg:grid-cols-[minmax(0,1fr)_minmax(320px,420px)] lg:items-start">
            <section class="metric-card">
                <h2 class="text-lg font-bold">Amount</h2>
                <div class="mt-4 space-y-3 text-sm">
                    <div class="flex justify-between gap-4"><span class="text-[#668175]">Price</span><span data-price class="font-bold">&#8358;{{ number_format($price) }}</span></div>
                    <div class="flex justify-between gap-4"><span class="text-[#668175]">Delivery fee</span><span data-delivery-fee class="font-bold">&#8358;{{ number_format($deliveryFee) }}</span></div>
                    <div class="border-t border-[#edf2ee] pt-3">
                        <div class="flex justify-between gap-4 text-base"><span class="font-bold">Total</span><span data-total class="font-bold text-[#0c6f43]">&#8358;{{ number_format($total) }}</span></div>
                    </div>
                </div>
            </section>

            <section class="metric-card">
                <h2 class="text-lg font-bold">Buyer Link</h2>
                <p class="mt-2 text-sm leading-6 text-[#668175]">Send this checkout link to the buyer on WhatsApp or Instagram.</p>
                <div class="mt-4 grid grid-cols-[minmax(0,1fr)_auto] items-center gap-2 rounded-lg bg-[#f4f7f4] p-3">
                    <p id="buyer-link" class="min-w-0 break-all text-sm font-semibold leading-6">{{ url('/checkout/' . $id) }}</p>
                    <button type="button" data-copy-target="buyer-link" class="grid h-10 w-10 shrink-0 place-items-center rounded-lg bg-[#103d2a] text-white" aria-label="Copy buyer link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="14" height="14" x="8" y="8" rx="2" />
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                        </svg>
                    </button>
                </div>
            </section>
        </div>
    </div>
@endsection
