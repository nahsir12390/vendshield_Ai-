@extends('layouts.app', ['title' => 'VendShield AI'])

@section('content')
    <div data-guest-page class="space-y-6">
        <section class="overflow-hidden rounded-lg bg-[#103d2a] p-5 text-white lg:p-8">
            <div class="max-w-4xl">
                <p class="inline-flex rounded-full bg-white/12 px-3 py-1 text-sm font-bold text-[#aee4c7]">Micro-escrow for WhatsApp and Instagram sellers</p>
                <h1 class="mt-5 text-4xl font-bold leading-tight lg:text-6xl">Turn social commerce payments into protected escrow links.</h1>
                <p class="mt-5 max-w-2xl text-sm leading-6 text-[#d9f4e7] lg:text-base">VendShield helps vendors collect safer payments, verify receipts with AI, and release funds only after delivery is confirmed.</p>

                <div class="mt-7 grid gap-3 sm:grid-cols-2 lg:max-w-lg">
                    <a href="{{ route('register') }}" class="primary-button bg-white text-[#103d2a] shadow-black/10">Create Vendor Account</a>
                    <a href="{{ route('login') }}" class="ghost-button border-white/20 bg-white/10 text-white">Vendor Login</a>
                </div>
            </div>

            <div class="mt-8 grid gap-3 sm:grid-cols-3">
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="text-2xl font-bold">AI</p>
                    <p class="mt-1 text-sm text-[#d9f4e7]">Receipt verification</p>
                </div>
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="text-2xl font-bold">Escrow</p>
                    <p class="mt-1 text-sm text-[#d9f4e7]">Payment protection</p>
                </div>
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="text-2xl font-bold">Guest</p>
                    <p class="mt-1 text-sm text-[#d9f4e7]">Buyer checkout</p>
                </div>
            </div>
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

        <section id="how-it-works" class="grid gap-5 lg:grid-cols-[360px_minmax(0,1fr)] lg:items-start">
            <div>
                <p class="text-sm font-bold text-[#16834f]">How it works</p>
                <h2 class="mt-1 text-2xl font-bold">One flow, two protected sides.</h2>
                <p class="mt-2 text-sm leading-6 text-[#668175]">Vendors log in to create and track escrow links. Buyers use public links to pay, upload receipts, confirm delivery, or raise disputes.</p>
            </div>

            <div class="grid gap-3 md:grid-cols-2">
                <div class="metric-card">
                    <p class="font-bold">1. Vendor creates link</p>
                    <p class="mt-2 text-sm leading-6 text-[#668175]">The seller creates an escrow transaction and shares the checkout URL.</p>
                </div>
                <div class="metric-card">
                    <p class="font-bold">2. Buyer pays safely</p>
                    <p class="mt-2 text-sm leading-6 text-[#668175]">The buyer pays and uploads a transfer receipt for verification.</p>
                </div>
                <div class="metric-card">
                    <p class="font-bold">3. AI checks receipt</p>
                    <p class="mt-2 text-sm leading-6 text-[#668175]">The backend sends the image to AI to detect fake payment alerts.</p>
                </div>
                <div class="metric-card">
                    <p class="font-bold">4. Delivery releases funds</p>
                    <p class="mt-2 text-sm leading-6 text-[#668175]">After the buyer confirms delivery, payout can be released to the vendor.</p>
                </div>
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
