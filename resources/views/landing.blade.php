@extends('layouts.app', ['title' => 'VendShield AI'])

@section('content')
    <div data-guest-page class="space-y-6">
        <section class="rounded-lg bg-[#103d2a] p-5 text-white">
            <p class="text-sm font-bold text-[#aee4c7]">Micro-escrow for social commerce</p>
            <h1 class="mt-3 text-3xl font-bold leading-tight">Sell on WhatsApp and Instagram with safer payments.</h1>
            <p class="mt-3 text-sm leading-6 text-[#d9f4e7]">VendShield holds payment in escrow, checks receipts with AI, and releases money after delivery confirmation.</p>
            <div class="mt-5 grid grid-cols-2 gap-3">
                <a href="{{ route('register') }}" class="primary-button">Vendor Signup</a>
                <a href="{{ route('login') }}" class="ghost-button border-white/20 bg-white/10 text-white">Login</a>
            </div>
        </section>

        <section class="grid grid-cols-3 gap-3">
            <div class="metric-card text-center">
                <p class="text-xl font-bold">AI</p>
                <p class="mt-1 text-xs font-semibold text-[#668175]">Receipt checks</p>
            </div>
            <div class="metric-card text-center">
                <p class="text-xl font-bold">JWT</p>
                <p class="mt-1 text-xs font-semibold text-[#668175]">Secure vendor</p>
            </div>
            <div class="metric-card text-center">
                <p class="text-xl font-bold">PWA</p>
                <p class="mt-1 text-xs font-semibold text-[#668175]">Mobile ready</p>
            </div>
        </section>

        <section class="space-y-3">
            <h2 class="text-lg font-bold">How it works</h2>
            <div class="space-y-3">
                <div class="metric-card">
                    <p class="font-bold">1. Vendor creates a payment link</p>
                    <p class="mt-1 text-sm leading-6 text-[#668175]">The buyer opens the link from WhatsApp or Instagram.</p>
                </div>
                <div class="metric-card">
                    <p class="font-bold">2. Buyer pays and uploads receipt</p>
                    <p class="mt-1 text-sm leading-6 text-[#668175]">The backend sends the receipt to AI verification.</p>
                </div>
                <div class="metric-card">
                    <p class="font-bold">3. Delivery confirms payout</p>
                    <p class="mt-1 text-sm leading-6 text-[#668175]">The vendor is paid after the buyer confirms delivery.</p>
                </div>
            </div>
        </section>
    </div>
@endsection
