@extends('layouts.app', ['title' => 'Create Transaction | VendShield AI'])

@section('content')
    <div data-protected data-page="create-transaction" class="space-y-5 lg:space-y-6">
        <section class="soft-hero">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="soft-eyebrow">Vendor workflow</p>
                    <h1 class="mt-2 text-3xl font-bold leading-tight lg:text-4xl">Create escrow transaction</h1>
                    <p class="mt-3 max-w-2xl soft-copy">Generate a checkout link, send it to your buyer, and let VendShield protect the payment until delivery is confirmed.</p>
                </div>
                <span class="w-fit rounded-full bg-[#eef8f1] px-3 py-1 text-xs font-bold text-[#0c6f43]">Secure workspace</span>
            </div>
        </section>

        <section data-created-link class="hidden rounded-lg border border-[#bde8cc] bg-[#ecfff3] p-4 lg:p-5">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm font-bold text-[#0b6b3e]">Payment link ready</p>
                    <p class="mt-1 text-sm text-[#466757]">Copy this link and send it to the buyer.</p>
                </div>
                <div class="flex min-w-0 items-center gap-2 rounded-lg bg-white p-3 lg:w-[min(560px,100%)]">
                    <p id="created-checkout-link" class="min-w-0 flex-1 break-all text-sm font-semibold text-[#173326]"></p>
                    <button type="button" data-copy-target="created-checkout-link" class="grid h-10 w-10 shrink-0 place-items-center rounded-lg bg-[#103d2a] text-white" aria-label="Copy checkout link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="14" height="14" x="8" y="8" rx="2" />
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <div class="grid gap-5 lg:grid-cols-[minmax(0,1fr)_380px] lg:items-start">
            <form data-api-form="/api/transaction/create" data-create-transaction="true" data-transaction-preview-form method="POST" class="space-y-4 rounded-lg border border-[#dce7df] bg-white p-4 lg:p-6">
                <div class="grid gap-4 lg:grid-cols-2">
                    <label class="form-field lg:col-span-2">
                        <span>Item Name</span>
                        <input data-preview-input name="itemName" type="text" value="Black Nike Sneakers" placeholder="Black Nike Sneakers" required>
                    </label>

                    <label class="form-field lg:col-span-2">
                        <span>Transaction Type</span>
                        <select data-preview-input name="transactionType" required>
                            <option value="PHYSICAL_PRODUCT">Physical Product</option>
                            <option value="SERVICE">Service</option>
                        </select>
                    </label>

                    <label class="form-field">
                        <span>Price</span>
                        <input data-preview-input name="price" type="number" min="0" step="100" value="50000" placeholder="50000" required>
                    </label>

                    <label class="form-field">
                        <span>Delivery Fee</span>
                        <input data-preview-input name="deliveryFee" type="number" min="0" step="100" value="2000" placeholder="2000" required>
                    </label>

                    <label class="form-field lg:col-span-2">
                        <span>Delivery Timeframe</span>
                        <input data-preview-input name="deliveryTimeframe" type="text" value="2-3 business days" placeholder="2-3 business days" required>
                    </label>
                </div>

                <button type="submit" class="primary-button">Generate Payment Link</button>
            </form>

            <aside class="space-y-4">
                <section class="metric-card">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="text-lg font-bold">Checkout Preview</h2>
                        <span data-preview-type class="status-pill status-info">Physical Product</span>
                    </div>

                    <div class="mt-4 rounded-lg bg-[#f8fbf8] p-4">
                        <p data-preview-item class="text-xl font-bold">Black Nike Sneakers</p>
                        <p class="mt-2 text-sm text-[#668175]">Delivery: <span data-preview-timeframe>2-3 business days</span></p>
                    </div>

                    <div class="mt-4 space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <span class="text-[#668175]">Item price</span>
                            <span data-preview-price class="font-bold">&#8358;50,000</span>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span class="text-[#668175]">Delivery fee</span>
                            <span data-preview-delivery class="font-bold">&#8358;2,000</span>
                        </div>
                        <div class="border-t border-[#edf2ee] pt-3">
                            <div class="flex justify-between gap-4 text-base">
                                <span class="font-bold">Buyer pays</span>
                                <span data-preview-total class="font-bold text-[#0c6f43]">&#8358;52,000</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="metric-card">
                    <h2 class="text-lg font-bold">What happens next?</h2>
                    <div class="mt-4 space-y-3">
                        <div class="activity-item">
                            <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#16a35f]"></span>
                            <p class="text-sm text-[#668175]">Buyer opens your checkout link.</p>
                        </div>
                        <div class="activity-item">
                            <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#16a35f]"></span>
                            <p class="text-sm text-[#668175]">Buyer pays and uploads receipt.</p>
                        </div>
                        <div class="activity-item">
                            <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#16a35f]"></span>
                            <p class="text-sm text-[#668175]">AI verifies payment before delivery.</p>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </div>
@endsection
