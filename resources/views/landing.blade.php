@extends('layouts.app', ['title' => 'VendShield AI'])

@section('content')
    <div data-guest-page class="min-h-[calc(100vh-8rem)]">
        <section class="grid gap-8 overflow-hidden rounded-lg bg-white p-5 lg:min-h-[calc(100vh-4rem)] lg:grid-cols-[minmax(0,0.92fr)_minmax(420px,1fr)] lg:items-center lg:p-8">
            <div class="order-2 lg:order-1">
                <p class="inline-flex rounded-full bg-[#eef8f1] px-3 py-1 text-sm font-bold text-[#0c6f43]">AI-powered escrow for social commerce</p>
                <h1 class="mt-5 text-4xl font-bold leading-tight text-[#102019] lg:text-6xl">Sell online with payment confidence.</h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-[#668175]">Create secure checkout links for WhatsApp and Instagram buyers. VendShield helps verify receipts, protect transactions, and release funds after delivery.</p>

                <div class="mt-7 grid gap-3 sm:grid-cols-2 lg:max-w-lg">
                    <a href="{{ route('register') }}" class="primary-button">Create Vendor Account</a>
                    <a href="{{ route('login') }}" class="ghost-button">Login</a>
                </div>

                <div class="mt-7 grid grid-cols-3 gap-3">
                    <div class="rounded-lg bg-[#f8fbf8] p-3">
                        <p class="text-lg font-bold">AI</p>
                        <p class="mt-1 text-xs font-semibold text-[#668175]">Receipt checks</p>
                    </div>
                    <div class="rounded-lg bg-[#f8fbf8] p-3">
                        <p class="text-lg font-bold">Escrow</p>
                        <p class="mt-1 text-xs font-semibold text-[#668175]">Safe holding</p>
                    </div>
                    <div class="rounded-lg bg-[#f8fbf8] p-3">
                        <p class="text-lg font-bold">PWA</p>
                        <p class="mt-1 text-xs font-semibold text-[#668175]">Mobile ready</p>
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2">
                <img src="{{ asset('images/escrow-hero-illustration.png') }}" alt="Illustration of secure escrow payments on mobile phones" class="mx-auto w-full max-w-[560px] rounded-lg object-cover shadow-2xl shadow-[#103d2a]/10">
            </div>
        </section>
    </div>
@endsection
