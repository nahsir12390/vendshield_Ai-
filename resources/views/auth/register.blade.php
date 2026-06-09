@extends('layouts.app', ['title' => 'Register | VendShield AI'])

@section('content')
    <div data-guest-page class="grid gap-5 lg:grid-cols-[minmax(0,1fr)_520px] lg:items-start">
        <section class="soft-hero lg:min-h-[620px]">
            <p class="soft-eyebrow">Start selling safely</p>
            <h1 class="mt-3 text-3xl font-bold leading-tight lg:text-4xl">Create escrow links your buyers can trust.</h1>
            <p class="mt-4 max-w-xl soft-copy">Register as a vendor, share checkout links on WhatsApp or Instagram, and let VendShield verify payments before delivery.</p>

            <div class="mt-8 space-y-3">
                <div class="activity-item">
                    <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#44d07b]"></span>
                    <p class="text-sm text-[#668175]">New vendors start with a trust score of 50/100.</p>
                </div>
                <div class="activity-item">
                    <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#44d07b]"></span>
                    <p class="text-sm text-[#668175]">Successful transactions help improve trust.</p>
                </div>
                <div class="activity-item">
                    <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#44d07b]"></span>
                    <p class="text-sm text-[#668175]">Payout account details help vendors receive released funds.</p>
                </div>
            </div>
        </section>

        <section class="metric-card lg:p-6">
            <div>
                <p class="text-sm font-bold text-[#16834f]">Vendor onboarding</p>
                <h2 class="mt-1 text-2xl font-bold">Create vendor account</h2>
                <p class="mt-2 text-sm leading-6 text-[#668175]">Use your real payout details for the demo flow.</p>
            </div>

            <form data-api-form="/api/auth/register" data-session="true" data-redirect="/dashboard" data-success="Account created" method="POST" class="mt-5 space-y-4">
                <label class="form-field">
                    <span>Full Name</span>
                    <input name="fullName" type="text" placeholder="Vendor full name" required>
                </label>

                <label class="form-field">
                    <span>Phone Number</span>
                    <input name="phoneNumber" type="tel" placeholder="08012345678" required>
                </label>

                <label class="form-field">
                    <span>Password</span>
                    <input name="password" type="password" placeholder="Create password" required>
                </label>

                <div class="grid gap-3 sm:grid-cols-2">
                    <label class="form-field">
                        <span>Bank Name</span>
                        <input name="bankName" type="text" placeholder="OPay">
                    </label>

                    <label class="form-field">
                        <span>Account No.</span>
                        <input name="accountNumber" type="text" placeholder="1234567890">
                    </label>
                </div>

                <label class="form-field">
                    <span>Account Name</span>
                    <input name="accountName" type="text" placeholder="Vendor account name">
                </label>

                <button type="submit" class="primary-button">Create Account</button>
            </form>

            <p class="mt-5 text-center text-sm text-[#668175]">Already registered? <a href="{{ route('login') }}" class="font-bold text-[#0c6f43]">Login</a></p>
        </section>
    </div>
@endsection
