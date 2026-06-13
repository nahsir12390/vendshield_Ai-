@extends('layouts.app', ['title' => 'Payment | VendShield AI'])

@section('content')
    <div data-page="checkout" data-transaction-id-value="{{ $id }}" class="space-y-5">
        <section class="soft-hero">
            <p class="soft-eyebrow">Payment Processing</p>
            <h1 class="mt-1 text-2xl font-bold">Start secure payment</h1>
            <p class="mt-2 soft-copy">VendShield will create a Paystack checkout session for transaction <span data-transaction-id class="break-all">{{ $id }}</span>.</p>
        </section>

        <section class="metric-card">
            <h2 data-item-name class="text-lg font-bold">Loading transaction...</h2>
            <div class="mt-4 flex justify-between gap-4">
                <span class="text-sm text-[#668175]">Total amount</span>
                <span data-total class="font-bold text-[#0c6f43]">&#8358;0</span>
            </div>
        </section>

        <form data-payment-form="{{ $id }}" class="space-y-4 rounded-lg border border-[#dce7df] bg-white p-4 lg:max-w-xl lg:p-5">
            <label class="form-field">
                <span>Buyer Name</span>
                <input name="buyerName" type="text" placeholder="Buyer full name" required>
            </label>

            <label class="form-field">
                <span>Buyer Phone</span>
                <input name="buyerPhone" type="tel" placeholder="08012345678" required>
            </label>

            <button type="submit" class="primary-button">Continue to Paystack</button>
        </form>

        <a href="{{ route('receipt', ['id' => $id]) }}" class="ghost-button">I already paid</a>
    </div>
@endsection
