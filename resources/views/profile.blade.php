@extends('layouts.app', ['title' => 'Profile | VendShield AI'])

@section('content')
    <div data-page="profile" data-protected class="space-y-5 lg:space-y-6">
        <section class="soft-hero">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div class="flex items-center gap-4">
                    <span class="grid h-16 w-16 shrink-0 place-items-center rounded-lg bg-[#103d2a] text-xl font-bold text-white" data-profile-initials>VS</span>
                    <div>
                        <p class="soft-eyebrow">Vendor Profile</p>
                        <h1 data-profile-name class="mt-1 text-3xl font-bold leading-tight">Vendor</h1>
                        <p data-profile-phone class="mt-1 text-sm text-[#668175]">No phone saved</p>
                    </div>
                </div>
                <span class="w-fit rounded-full bg-[#eef8f1] px-3 py-1 text-xs font-bold text-[#0c6f43]">Active vendor</span>
            </div>
        </section>

        <div class="grid gap-5 lg:grid-cols-[minmax(0,1fr)_360px]">
            <section class="space-y-5">
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="metric-card">
                        <p class="text-sm text-[#668175]">Trust Score</p>
                        <div class="mt-2 flex items-end justify-between gap-3">
                            <p data-profile-trust class="text-3xl font-bold">50/100</p>
                            <span data-profile-trust-level class="status-pill status-info">New Vendor</span>
                        </div>
                        <div class="mt-4 h-2 rounded-full bg-[#edf2ee]">
                            <div data-profile-trust-bar class="h-2 rounded-full bg-[#16a35f]" style="width: 50%"></div>
                        </div>
                    </div>

                    <div class="metric-card">
                        <p class="text-sm text-[#668175]">Role</p>
                        <p class="mt-2 text-3xl font-bold">Vendor</p>
                        <p class="mt-2 text-sm leading-6 text-[#668175]">Can create escrow links and track transaction status.</p>
                    </div>
                </div>

                <section class="metric-card">
                    <h2 class="text-lg font-bold">Account Information</h2>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-lg bg-[#f8fbf8] p-4">
                            <p class="text-xs font-bold uppercase text-[#668175]">Full Name</p>
                            <p data-profile-full-name class="mt-1 font-bold">Vendor</p>
                        </div>
                        <div class="rounded-lg bg-[#f8fbf8] p-4">
                            <p class="text-xs font-bold uppercase text-[#668175]">Phone Number</p>
                            <p data-profile-phone-copy class="mt-1 font-bold">No phone saved</p>
                        </div>
                        <div class="rounded-lg bg-[#f8fbf8] p-4">
                            <p class="text-xs font-bold uppercase text-[#668175]">Bank</p>
                            <p data-profile-bank class="mt-1 font-bold">Not provided</p>
                        </div>
                        <div class="rounded-lg bg-[#f8fbf8] p-4">
                            <p class="text-xs font-bold uppercase text-[#668175]">Account No.</p>
                            <p data-profile-account class="mt-1 font-bold">Not provided</p>
                        </div>
                    </div>
                </section>
            </section>

            <aside class="space-y-5">
                <section class="metric-card">
                    <h2 class="text-lg font-bold">Trust Guide</h2>
                    <div class="mt-4 space-y-3">
                        <div class="activity-item">
                            <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#16a35f]"></span>
                            <p class="text-sm text-[#668175]">Successful transactions increase your score.</p>
                        </div>
                        <div class="activity-item">
                            <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#f2a900]"></span>
                            <p class="text-sm text-[#668175]">Disputes can reduce vendor trust.</p>
                        </div>
                        <div class="activity-item">
                            <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#b42318]"></span>
                            <p class="text-sm text-[#668175]">Fake receipts are flagged by AI verification.</p>
                        </div>
                    </div>
                </section>

                <section class="metric-card">
                    <h2 class="text-lg font-bold">Session</h2>
                    <p class="mt-2 text-sm leading-6 text-[#668175]">Logout clears this vendor session from your browser.</p>
                    <button type="button" data-logout class="mt-4 dark-button">Logout</button>
                </section>
            </aside>
        </div>
    </div>
@endsection
