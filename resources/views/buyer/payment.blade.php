@extends('layouts.app', ['title' => 'Payment | VendShield AI'])

@section('content')
    <div data-page="checkout" data-transaction-id-value="{{ $id }}" class="space-y-5">
        <section class="soft-hero lg:grid lg:grid-cols-[minmax(0,1fr)_220px] lg:items-center lg:gap-8">
            <div>
                <p class="soft-eyebrow">Secure Checkout</p>
                <h1 class="mt-1 text-2xl font-bold lg:text-4xl">Complete your protected payment</h1>
                <p class="mt-3 soft-copy">Your payment is handled through VendShield so the vendor can track this order while your transaction stays protected.</p>
                <p class="mt-4 break-all rounded-lg bg-[#f8fbf8] px-4 py-3 text-xs font-semibold text-[#668175]">Transaction <span data-transaction-id>{{ $id }}</span></p>
            </div>

            <div class="mt-5 rounded-lg bg-[#eef8f1] p-4 lg:mt-0">
                <p class="text-sm font-bold text-[#103d2a]">Buyer protection</p>
                <p class="mt-2 text-sm leading-6 text-[#668175]">Keep your payment reference safe and upload your receipt after payment.</p>
            </div>
        </section>

        <section class="metric-card lg:max-w-xl">
            <p class="soft-eyebrow">Order summary</p>
            <h2 data-item-name class="mt-1 text-xl font-bold">Loading transaction...</h2>
            <div class="mt-5 rounded-lg bg-[#f8fbf8] p-4">
                <div class="flex items-center justify-between gap-4">
                    <span class="text-sm font-semibold text-[#668175]">Amount to pay</span>
                    <span data-total class="text-xl font-bold text-[#0c6f43]">&#8358;0</span>
                </div>
            </div>
        </section>

        <form data-payment-form="{{ $id }}" class="space-y-4 rounded-lg border border-[#dce7df] bg-white p-4 lg:max-w-xl lg:p-5">
            <div>
                <h2 class="text-lg font-bold">Buyer details</h2>
                <p class="mt-1 text-sm leading-6 text-[#668175]">Use the same details you want attached to this payment.</p>
            </div>

            <label class="form-field">
                <span>Full name</span>
                <input name="buyerName" type="text" placeholder="Buyer full name" required>
            </label>

            <label class="form-field">
                <span>Phone number</span>
                <input name="buyerPhone" type="tel" placeholder="08012345678" required>
            </label>

            <button type="submit" class="primary-button">Proceed to Secure Payment</button>
            <p data-payment-error class="hidden rounded-lg border border-[#ffd6d1] bg-[#fff3f1] px-4 py-3 text-sm font-semibold leading-6 text-[#b42318]"></p>
        </form>

        <a href="{{ route('receipt', ['id' => $id]) }}" class="ghost-button lg:max-w-xl">I have completed payment</a>
    </div>
@endsection
