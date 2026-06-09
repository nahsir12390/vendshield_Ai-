@extends('layouts.app', ['title' => 'Raise Dispute | VendShield AI'])

@section('content')
    <div data-page="checkout" data-transaction-id-value="{{ $id }}" class="space-y-5">
        <section>
            <p class="text-sm font-bold text-[#b42318]">Dispute</p>
            <h1 class="mt-1 text-2xl font-bold">Report a delivery issue</h1>
            <p class="mt-2 text-sm leading-6 text-[#668175]">VendShield will freeze the transaction while the issue is reviewed.</p>
        </section>

        <section class="metric-card">
            <h2 data-item-name class="font-bold">Loading transaction...</h2>
            <p class="mt-2 text-sm text-[#668175]">Transaction <span data-transaction-id>{{ $id }}</span></p>
        </section>

        <form data-dispute-form="{{ $id }}" class="space-y-4 rounded-lg border border-[#dce7df] bg-white p-4">
            <label class="form-field">
                <span>Reason</span>
                <textarea name="reason" rows="5" placeholder="Item never delivered" required></textarea>
            </label>

            <button type="submit" class="dark-button bg-[#b42318]">Submit Dispute</button>
        </form>
    </div>
@endsection
