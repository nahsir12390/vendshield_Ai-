@extends('layouts.app', ['title' => 'Payment | VendShield AI'])

@section('content')
    <div data-page="checkout" data-transaction-id-value="{{ $id }}" class="space-y-5 lg:space-y-6">
        <section class="soft-hero lg:p-7">
            <div class="max-w-3xl">
                <p class="soft-eyebrow">Secure Checkout</p>
                <h1 class="mt-1 text-2xl font-bold leading-tight lg:text-4xl">Complete your protected payment</h1>
                <p class="mt-3 max-w-2xl soft-copy">Your payment is handled through VendShield so the vendor can track this order while your transaction stays protected.</p>
            </div>
        </section>

        <div class="grid gap-5 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-start">
            <div class="space-y-5">
                <form data-payment-form="{{ $id }}" class="space-y-5 rounded-lg border border-[#dce7df] bg-white p-4 lg:p-6">
                    <div>
                        <p class="soft-eyebrow">Buyer details</p>
                        <h2 class="mt-1 text-xl font-bold">Where should we attach this payment?</h2>
                        <p class="mt-2 text-sm leading-6 text-[#668175]">Use the same name and phone number you want connected to this transaction.</p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <label class="form-field">
                            <span>Full name</span>
                            <input name="buyerName" type="text" placeholder="Buyer full name" required>
                        </label>

                        <label class="form-field">
                            <span>Phone number</span>
                            <input name="buyerPhone" type="tel" placeholder="08012345678" required>
                        </label>
                    </div>

                    <button type="submit" class="primary-button">Proceed to Secure Payment</button>
                    <p data-payment-error class="hidden rounded-lg border border-[#ffd6d1] bg-[#fff3f1] px-4 py-3 text-sm font-semibold leading-6 text-[#b42318]"></p>
                </form>

                <a href="{{ route('receipt', ['id' => $id]) }}" class="ghost-button">I have completed payment</a>
            </div>

            <aside class="space-y-5 lg:sticky lg:top-8">
                <section class="metric-card">
                    <p class="soft-eyebrow">Order summary</p>
                    <h2 data-item-name class="mt-1 text-xl font-bold">Loading transaction...</h2>
                    <p class="mt-4 break-all rounded-lg bg-[#f8fbf8] px-4 py-3 text-xs font-semibold text-[#668175]">Transaction <span data-transaction-id>{{ $id }}</span></p>
                    <div class="mt-5 border-t border-[#edf2ee] pt-5">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm font-semibold text-[#668175]">Amount to pay</span>
                            <span data-total class="text-2xl font-bold text-[#0c6f43]">&#8358;0</span>
                        </div>
                    </div>
                </section>

                <section class="rounded-lg border border-[#dce7df] bg-[#eef8f1] p-4">
                    <p class="text-sm font-bold text-[#103d2a]">Buyer protection</p>
                    <p class="mt-2 text-sm leading-6 text-[#668175]">Keep your payment reference safe and upload your receipt after payment.</p>
                </section>
            </aside>
        </div>
    </div>
@endsection
