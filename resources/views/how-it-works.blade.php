@extends('layouts.app', ['title' => 'How It Works | VendShield AI'])

@section('content')
    <div class="space-y-6">
        <section class="rounded-lg bg-[#103d2a] p-5 text-white lg:p-7">
            <p class="text-sm font-bold text-[#aee4c7]">How VendShield works</p>
            <h1 class="mt-2 text-3xl font-bold leading-tight lg:text-5xl">One flow, two protected sides.</h1>
            <p class="mt-4 max-w-2xl text-sm leading-6 text-[#d9f4e7] lg:text-base">Vendors log in to create and track escrow links. Buyers use public links to pay, upload receipts, confirm delivery, or raise disputes.</p>
        </section>

        <section class="grid grid-cols-3 gap-3">
            <div class="metric-card text-center">
                <p class="text-xl font-bold">AI</p>
                <p class="mt-1 text-xs font-semibold text-[#668175]">Receipt checks</p>
            </div>
            <div class="metric-card text-center">
                <p class="text-xl font-bold">JWT</p>
                <p class="mt-1 text-xs font-semibold text-[#668175]">Vendor security</p>
            </div>
            <div class="metric-card text-center">
                <p class="text-xl font-bold">PWA</p>
                <p class="mt-1 text-xs font-semibold text-[#668175]">Mobile ready</p>
            </div>
        </section>

        <section class="grid gap-3 md:grid-cols-2">
            <div class="metric-card">
                <p class="text-sm font-bold text-[#16834f]">Step 1</p>
                <h2 class="mt-1 text-lg font-bold">Vendor creates link</h2>
                <p class="mt-2 text-sm leading-6 text-[#668175]">The seller creates an escrow transaction and shares the checkout URL with a buyer.</p>
            </div>
            <div class="metric-card">
                <p class="text-sm font-bold text-[#16834f]">Step 2</p>
                <h2 class="mt-1 text-lg font-bold">Buyer pays safely</h2>
                <p class="mt-2 text-sm leading-6 text-[#668175]">The buyer pays and uploads a transfer receipt for verification.</p>
            </div>
            <div class="metric-card">
                <p class="text-sm font-bold text-[#16834f]">Step 3</p>
                <h2 class="mt-1 text-lg font-bold">AI checks receipt</h2>
                <p class="mt-2 text-sm leading-6 text-[#668175]">The backend sends the image to AI to detect fake payment alerts.</p>
            </div>
            <div class="metric-card">
                <p class="text-sm font-bold text-[#16834f]">Step 4</p>
                <h2 class="mt-1 text-lg font-bold">Delivery releases funds</h2>
                <p class="mt-2 text-sm leading-6 text-[#668175]">After the buyer confirms delivery, payout can be released to the vendor.</p>
            </div>
        </section>

        <section class="rounded-lg border border-[#dce7df] bg-white p-5 lg:p-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-xl font-bold">Ready to create escrow links?</h2>
                    <p class="mt-2 text-sm leading-6 text-[#668175]">Create a vendor account to access the dashboard, transactions, profile, and payment-link tools.</p>
                </div>
                <a href="{{ route('register') }}" class="primary-button lg:w-auto">Get Started</a>
            </div>
        </section>
    </div>
@endsection
