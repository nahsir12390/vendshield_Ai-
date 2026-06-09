<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#103d2a">

        <title>{{ $title ?? 'VendShield AI' }}</title>
        <link rel="manifest" href="/manifest.webmanifest">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#eef4ef] text-[#102019] antialiased" data-api-base="/frontend-api">
        <main class="mx-auto grid min-h-screen w-full max-w-md bg-[#f9fbf8] shadow-2xl shadow-black/10 lg:max-w-none lg:grid-cols-[280px_minmax(0,1fr)] lg:bg-[#f4f7f4] lg:shadow-none">
            <aside class="hidden border-r border-[#dbe6dc] bg-white px-6 py-6 lg:sticky lg:top-0 lg:flex lg:h-screen lg:flex-col">
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center rounded-lg bg-[#103d2a] text-sm font-bold text-white">VS</span>
                    <span>
                        <span class="block text-lg font-bold leading-tight">VendShield AI</span>
                        <span class="block text-sm font-medium text-[#668175]">Escrow protection</span>
                    </span>
                </a>

                <nav class="mt-8 space-y-2">
                    <a href="{{ route('dashboard') }}" class="side-nav-item {{ request()->routeIs('dashboard') ? 'side-nav-item-active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18" />
                            <path d="M7 15v3" />
                            <path d="M12 9v9" />
                            <path d="M17 12v6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('transactions.create') }}" class="side-nav-item {{ request()->routeIs('transactions.create') ? 'side-nav-item-active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        <span>Create Transaction</span>
                    </a>
                    <a href="{{ route('transactions.index') }}" class="side-nav-item {{ request()->routeIs('transactions.*') && ! request()->routeIs('transactions.create') ? 'side-nav-item-active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M8 6h13" />
                            <path d="M8 12h13" />
                            <path d="M8 18h13" />
                            <path d="M3 6h.01" />
                            <path d="M3 12h.01" />
                            <path d="M3 18h.01" />
                        </svg>
                        <span>Transactions</span>
                    </a>
                    <a href="{{ route('profile') }}" class="side-nav-item {{ request()->routeIs('profile') ? 'side-nav-item-active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <span>Profile</span>
                    </a>
                </nav>

                <div data-guest-note class="mt-auto rounded-lg bg-[#eef8f1] p-4">
                    <p class="text-sm font-bold text-[#103d2a]">Buyer links stay public</p>
                    <p class="mt-2 text-sm leading-6 text-[#668175]">Vendors need login. Buyers can checkout, upload receipts, confirm delivery, or dispute without registering.</p>
                </div>

                <div data-vendor-note class="mt-auto hidden rounded-lg bg-[#103d2a] p-4 text-white">
                    <p class="text-sm font-bold">Vendor workspace</p>
                    <p class="mt-2 text-sm leading-6 text-[#d9f4e7]">Create escrow links, track transactions, and monitor your trust score from the dashboard.</p>
                </div>
            </aside>

            <div class="flex min-h-screen flex-col">
            <header class="sticky top-0 z-20 border-b border-[#dbe6dc] bg-[#f9fbf8]/95 px-5 py-4 backdrop-blur lg:bg-white/95 lg:px-8">
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('landing') }}" class="flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded-lg bg-[#103d2a] text-sm font-bold text-white">VS</span>
                        <span>
                            <span class="block text-base font-bold leading-tight">VendShield AI</span>
                            <span class="block text-xs font-medium text-[#668175]">Escrow protection</span>
                        </span>
                    </a>

                    <a href="{{ route('login') }}" data-auth-link class="grid h-10 w-10 place-items-center rounded-lg border border-[#d7e2d8] bg-white text-[#103d2a]" aria-label="Open vendor account">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </a>
                </div>
            </header>

            <div id="toast" class="pointer-events-none fixed left-1/2 top-20 z-50 hidden w-[calc(100%-2rem)] max-w-sm -translate-x-1/2 rounded-lg bg-[#102019] px-4 py-3 text-sm font-semibold text-white shadow-xl"></div>

            <section class="flex-1 px-5 py-5 lg:mx-auto lg:w-full lg:max-w-6xl lg:px-8 lg:py-8">
                @yield('content')
            </section>

            <nav class="sticky bottom-0 z-20 border-t border-[#dbe6dc] bg-white px-5 py-3 lg:hidden">
                <div class="grid grid-cols-4 gap-2">
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'nav-item-active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3v18h18" />
                            <path d="M7 15v3" />
                            <path d="M12 9v9" />
                            <path d="M17 12v6" />
                        </svg>
                        <span>Dash</span>
                    </a>
                    <a href="{{ route('transactions.create') }}" class="nav-item {{ request()->routeIs('transactions.create') ? 'nav-item-active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        <span>Create</span>
                    </a>
                    <a href="{{ route('transactions.index') }}" class="nav-item {{ request()->routeIs('transactions.*') && ! request()->routeIs('transactions.create') ? 'nav-item-active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M8 6h13" />
                            <path d="M8 12h13" />
                            <path d="M8 18h13" />
                            <path d="M3 6h.01" />
                            <path d="M3 12h.01" />
                            <path d="M3 18h.01" />
                        </svg>
                        <span>List</span>
                    </a>
                    <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'nav-item-active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <span>Profile</span>
                    </a>
                </div>
            </nav>
            </div>
        </main>
    </body>
</html>
