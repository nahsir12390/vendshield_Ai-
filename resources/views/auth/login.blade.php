@extends('layouts.app', ['title' => 'Login | VendShield AI'])

@section('content')
    <div data-guest-page class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_440px] lg:items-start">
        <section class="rounded-lg bg-[#103d2a] p-4 text-white lg:min-h-[520px] lg:p-6">
            <p class="text-sm font-bold text-[#aee4c7]">Vendor account</p>
            <h1 class="mt-2 text-2xl font-bold leading-tight lg:mt-3 lg:text-4xl">Login to your vendor dashboard.</h1>
            <p class="mt-3 max-w-xl text-sm leading-6 text-[#d9f4e7]">Create escrow links, monitor buyer payments, and track your trust score.</p>

            <div class="mt-4 grid grid-cols-3 gap-2 lg:mt-8 lg:grid-cols-1 lg:gap-3">
                <div class="rounded-lg bg-white/10 p-3 lg:p-4">
                    <p class="text-base font-bold lg:text-xl">Secure</p>
                    <p class="mt-1 hidden text-sm text-[#d9f4e7] sm:block">Secure vendor session</p>
                </div>
                <div class="rounded-lg bg-white/10 p-3 lg:p-4">
                    <p class="text-base font-bold lg:text-xl">AI</p>
                    <p class="mt-1 hidden text-sm text-[#d9f4e7] sm:block">Receipt verification</p>
                </div>
                <div class="rounded-lg bg-white/10 p-3 lg:p-4">
                    <p class="text-base font-bold lg:text-xl">Escrow</p>
                    <p class="mt-1 hidden text-sm text-[#d9f4e7] sm:block">Payment protection</p>
                </div>
            </div>
        </section>

        <section class="metric-card p-4 lg:p-6">
            <div>
                <p class="text-sm font-bold text-[#16834f]">Welcome back</p>
                <h2 class="mt-1 text-xl font-bold lg:text-2xl">Login to dashboard</h2>
                <p class="mt-2 text-sm leading-6 text-[#668175]">Use your vendor phone number and password.</p>
            </div>

            <form data-api-form="/api/auth/login" data-session="true" data-redirect="/dashboard" data-success="Login successful" method="POST" class="mt-5 space-y-4">
                <label class="form-field">
                    <span>Phone Number</span>
                    <input name="phoneNumber" type="tel" placeholder="08012345678" required>
                </label>

                <label class="form-field">
                    <span>Password</span>
                    <input name="password" type="password" placeholder="Your password" required>
                </label>

                <button type="submit" class="primary-button">Login</button>
            </form>

            <p class="mt-5 text-center text-sm text-[#668175]">New vendor? <a href="{{ route('register') }}" class="font-bold text-[#0c6f43]">Create account</a></p>
        </section>
    </div>
@endsection
