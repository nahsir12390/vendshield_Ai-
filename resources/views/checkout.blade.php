@extends('layouts.app', ['title' => 'Buyer Checkout | VendShield AI'])

@section('content')
    <div class="space-y-5 pb-3">
        <section class="rounded-lg bg-white p-4">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-bold text-[#16834f]">Checkout {{ $transaction['id'] }}</p>
                    <h1 class="mt-1 text-2xl font-bold leading-tight">{{ $transaction['itemName'] }}</h1>
                </div>
                <span class="status-pill {{ $transaction['statusClass'] }}">{{ $transaction['status'] }}</span>
            </div>
        </section>

        <section class="rounded-lg border border-[#dce7df] bg-white p-4">
            <h2 class="text-lg font-bold">Order Summary</h2>
            <div class="mt-4 space-y-3 text-sm">
                <div class="flex justify-between gap-4">
                    <span class="text-[#668175]">Item price</span>
                    <span class="font-bold">{{ $transaction['price'] }}</span>
                </div>
                <div class="flex justify-between gap-4">
                    <span class="text-[#668175]">Delivery fee</span>
                    <span class="font-bold">{{ $transaction['deliveryFee'] }}</span>
                </div>
                <div class="border-t border-[#edf2ee] pt-3">
                    <div class="flex justify-between gap-4 text-base">
                        <span class="font-bold">Total</span>
                        <span class="font-bold text-[#0c6f43]">{{ $transaction['total'] }}</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-lg border border-[#dce7df] bg-white p-4">
            <div class="flex items-center gap-3">
                <span class="grid h-10 w-10 place-items-center rounded-lg bg-[#eef8f1] text-[#0c6f43]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <path d="M2 10h20" />
                    </svg>
                </span>
                <div>
                    <h2 class="font-bold">Escrow Bank Account</h2>
                    <p class="text-sm text-[#668175]">Transfer exactly {{ $transaction['total'] }}</p>
                </div>
            </div>

            <div class="mt-4 rounded-lg bg-[#f4f7f4] p-4">
                <p class="text-xs font-bold uppercase text-[#668175]">Account Name</p>
                <p class="mt-1 font-bold">{{ $escrow['accountName'] }}</p>
                <div class="mt-4 grid grid-cols-[1fr_auto] items-center gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase text-[#668175]">Account Number</p>
                        <p id="account-number" class="mt-1 text-xl font-bold">{{ $escrow['accountNumber'] }}</p>
                    </div>
                    <button type="button" data-copy-target="account-number" class="grid h-10 w-10 place-items-center rounded-lg bg-[#103d2a] text-white" aria-label="Copy account number">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="14" height="14" x="8" y="8" rx="2" />
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                        </svg>
                    </button>
                </div>
                <p class="mt-4 text-xs font-bold uppercase text-[#668175]">Bank</p>
                <p class="mt-1 font-bold">{{ $escrow['bank'] }}</p>
            </div>
        </section>

        <section class="rounded-lg border border-[#dce7df] bg-white p-4">
            <h2 class="text-lg font-bold">Upload Receipt</h2>
            <p class="mt-1 text-sm leading-6 text-[#668175]">Upload your bank transfer screenshot so VendShield AI can verify the payment.</p>

            <form class="mt-4 space-y-3">
                <label class="flex min-h-32 cursor-pointer flex-col items-center justify-center rounded-lg border border-dashed border-[#a9beae] bg-[#f8fbf8] p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#0c6f43]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <path d="M17 8 12 3 7 8" />
                        <path d="M12 3v12" />
                    </svg>
                    <span id="receipt-file-name" class="mt-3 text-sm font-bold">Choose receipt image</span>
                    <span class="mt-1 text-xs text-[#668175]">Camera or gallery</span>
                    <input data-file-name-target="receipt-file-name" type="file" accept="image/*" class="sr-only">
                </label>

                <button type="button" class="flex min-h-12 w-full items-center justify-center rounded-lg bg-[#103d2a] px-4 py-3 font-bold text-white">Submit for AI Check</button>
            </form>
        </section>

        <section class="rounded-lg border border-[#dce7df] bg-white p-4">
            <h2 class="text-lg font-bold">Delivery Confirmation</h2>
            <p class="mt-1 text-sm leading-6 text-[#668175]">Only confirm after you have received the product or service.</p>
            <button type="button" class="mt-4 flex min-h-12 w-full items-center justify-center rounded-lg bg-[#16a35f] px-4 py-3 font-bold text-white">Confirm Delivery</button>
        </section>
    </div>
@endsection
