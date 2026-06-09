@extends('layouts.app', ['title' => 'Confirm Delivery | VendShield AI'])

@section('content')
    <div data-page="checkout" data-transaction-id-value="{{ $id }}" class="space-y-5">
        <section>
            <p class="text-sm font-bold text-[#16834f]">Delivery Confirmation</p>
            <h1 class="mt-1 text-2xl font-bold">Confirm after receiving item</h1>
            <p class="mt-2 text-sm leading-6 text-[#668175]">This action triggers vendor payout. Only confirm if the product or service has been delivered.</p>
        </section>

        <section class="metric-card">
            <h2 data-item-name class="font-bold">Loading transaction...</h2>
            <p class="mt-2 text-sm text-[#668175]">Vendor: <span data-vendor-name class="font-bold">Verified vendor</span></p>
            <p class="mt-2 text-sm text-[#668175]">Status: <span data-status class="status-pill status-warning">Pending</span></p>
        </section>

        <button type="button" data-delivery-confirm="{{ $id }}" class="primary-button">Confirm Delivery</button>
        <a href="{{ route('dispute', ['id' => $id]) }}" class="ghost-button">Raise Dispute</a>
    </div>
@endsection
