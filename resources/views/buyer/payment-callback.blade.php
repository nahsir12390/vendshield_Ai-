@extends('layouts.app', ['title' => 'Payment Callback | VendShield AI'])

@section('content')
    <div data-page="payment-callback" class="space-y-5">
        <section class="soft-hero">
            <p class="soft-eyebrow">Payment returned</p>
            <h1 class="mt-1 text-2xl font-bold">Checking payment status</h1>
            <p class="mt-2 soft-copy">Please wait while VendShield confirms this payment.</p>
        </section>

        <section class="metric-card">
            <h2 class="text-lg font-bold">Payment Reference</h2>
            <p data-payment-reference class="mt-2 break-all text-sm font-semibold text-[#668175]">No reference found</p>
            <p data-callback-status class="mt-4 rounded-lg bg-[#f8fbf8] px-4 py-3 text-sm font-semibold leading-6 text-[#668175]">Confirming payment...</p>
        </section>

        <div class="grid gap-3 sm:grid-cols-2">
            <a data-callback-receipt-link href="{{ route('landing') }}" class="primary-button">Upload Receipt</a>
            <a data-callback-checkout-link href="{{ route('landing') }}" class="ghost-button">Back to Checkout</a>
        </div>
    </div>
@endsection
