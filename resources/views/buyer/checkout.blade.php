@extends('layouts.app', ['title' => 'Buyer Checkout | VendShield AI'])

@section('content')
    <div data-page="checkout" data-transaction-id-value="{{ $id }}" class="space-y-5">
        <section class="rounded-lg bg-white p-4">
            <p class="text-sm font-bold text-[#16834f]">Buyer Checkout</p>
            <div class="mt-2 flex items-start justify-between gap-3">
                <h1 data-item-name class="text-2xl font-bold leading-tight">Loading transaction...</h1>
                <span data-status class="status-pill status-warning">Pending</span>
            </div>
            <p class="mt-2 text-sm text-[#668175]">Transaction <span data-transaction-id>{{ $id }}</span></p>
        </section>

        <section class="metric-card">
            <h2 class="text-lg font-bold">Order Summary</h2>
            <div class="mt-4 space-y-3 text-sm">
                <div class="flex justify-between gap-4"><span class="text-[#668175]">Item price</span><span data-price class="font-bold">₦0</span></div>
                <div class="flex justify-between gap-4"><span class="text-[#668175]">Delivery fee</span><span data-delivery-fee class="font-bold">₦0</span></div>
                <div class="border-t border-[#edf2ee] pt-3">
                    <div class="flex justify-between gap-4 text-base"><span class="font-bold">Total</span><span data-total class="font-bold text-[#0c6f43]">₦0</span></div>
                </div>
            </div>
        </section>

        <section class="metric-card">
            <h2 class="text-lg font-bold">Vendor</h2>
            <div class="mt-3 flex items-center justify-between gap-3">
                <div>
                    <p data-vendor-name class="font-bold">Verified vendor</p>
                    <p class="mt-1 text-sm text-[#668175]">Trust score: <span data-vendor-trust>50/100</span></p>
                </div>
                <span class="rounded-lg bg-[#eef8f1] px-3 py-2 text-sm font-bold text-[#0c6f43]">Protected</span>
            </div>
        </section>

        <div class="space-y-3">
            <a href="{{ route('payment', ['id' => $id]) }}" class="primary-button">Pay Securely</a>
            <a href="{{ route('receipt', ['id' => $id]) }}" data-requires-paid class="dark-button hidden">Upload Payment Proof</a>
            <a href="{{ route('delivery', ['id' => $id]) }}" data-requires-paid class="ghost-button hidden">Confirm Delivery</a>
            <p data-payment-required class="rounded-lg border border-[#fff0c2] bg-[#fff9e8] px-4 py-3 text-sm font-semibold leading-6 text-[#8a5a00]">Upload proof and delivery confirmation will be available after payment is completed.</p>
        </div>
    </div>
@endsection
