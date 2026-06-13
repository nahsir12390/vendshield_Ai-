@extends('layouts.app', ['title' => 'Upload Receipt | VendShield AI'])

@section('content')
    <div data-page="checkout" data-transaction-id-value="{{ $id }}" class="space-y-5">
        <section>
            <p class="text-sm font-bold text-[#16834f]">AI Receipt Check</p>
            <h1 class="mt-1 text-2xl font-bold">Upload payment proof</h1>
            <p class="mt-2 text-sm leading-6 text-[#668175]">Upload a payment confirmation screenshot, bank debit alert, or transfer receipt. VendShield AI will check it automatically; this can take a few moments.</p>
        </section>

        <section class="metric-card">
            <h2 data-item-name class="font-bold">Loading transaction...</h2>
            <p class="mt-2 text-sm text-[#668175]">Expected payment: <span data-total class="font-bold text-[#0c6f43]">₦0</span></p>
        </section>

        <form data-receipt-form="{{ $id }}" class="space-y-4 rounded-lg border border-[#dce7df] bg-white p-4">
            <label class="flex min-h-36 cursor-pointer flex-col items-center justify-center rounded-lg border border-dashed border-[#a9beae] bg-[#f8fbf8] p-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#0c6f43]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <path d="M17 8 12 3 7 8" />
                    <path d="M12 3v12" />
                </svg>
                <span id="receipt-file-name" class="mt-3 text-sm font-bold">Choose payment proof</span>
                <span class="mt-1 text-xs text-[#668175]">JPG, PNG, or camera capture</span>
                <input name="receipt" data-file-name-target="receipt-file-name" type="file" accept="image/*" class="sr-only" required>
            </label>

            <button type="submit" class="primary-button">Submit for AI Verification</button>
            <p data-receipt-status class="hidden rounded-lg border border-[#cdeed8] bg-[#eefaf2] px-4 py-3 text-sm font-semibold leading-6 text-[#08723f]"></p>
            <p data-receipt-error class="hidden rounded-lg border border-[#ffd6d1] bg-[#fff3f1] px-4 py-3 text-sm font-semibold leading-6 text-[#b42318]"></p>
        </form>

        <a href="{{ route('delivery', ['id' => $id]) }}" class="ghost-button">Continue to delivery</a>
    </div>
@endsection
