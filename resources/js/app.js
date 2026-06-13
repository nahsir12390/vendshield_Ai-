import './bootstrap';

const API_BASE = document.body.dataset.apiBase;
const TOKEN_KEY = 'vendshield_token';
const USER_KEY = 'vendshield_user';

const money = (value) => {
    const amount = Number(value ?? 0);
    return new Intl.NumberFormat('en-NG', {
        style: 'currency',
        currency: 'NGN',
        maximumFractionDigits: 0,
    }).format(Number.isNaN(amount) ? 0 : amount);
};

const getToken = () => localStorage.getItem(TOKEN_KEY);
const getUser = () => JSON.parse(localStorage.getItem(USER_KEY) || 'null');

const setSession = (payload) => {
    const token = payload.token || payload.accessToken || payload.access_token || payload?.data?.token;
    const user = payload.user || payload.vendor || payload?.data?.user || payload?.data?.vendor || {};

    if (token) {
        localStorage.setItem(TOKEN_KEY, token);
    }

    localStorage.setItem(USER_KEY, JSON.stringify(user));
};

const toast = (message, type = 'success') => {
    const box = document.getElementById('toast');

    if (!box) {
        return;
    }

    box.textContent = message;
    box.classList.remove('hidden', 'bg-[#102019]', 'bg-[#b42318]');
    box.classList.add(type === 'error' ? 'bg-[#b42318]' : 'bg-[#102019]');

    window.setTimeout(() => box.classList.add('hidden'), 3200);
};

const setLoading = (button, isLoading) => {
    if (!button) {
        return;
    }

    if (isLoading) {
        button.dataset.originalText = button.textContent;
        button.disabled = true;
        button.textContent = 'Please wait...';
        return;
    }

    button.disabled = false;
    button.textContent = button.dataset.originalText || button.textContent;
};

const apiFetch = async (path, options = {}) => {
    const headers = new Headers(options.headers || {});
    const token = getToken();
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

    if (!(options.body instanceof FormData)) {
        headers.set('Content-Type', 'application/json');
    }

    if (csrf && API_BASE.startsWith('/')) {
        headers.set('X-CSRF-TOKEN', csrf);
    }

    if (token) {
        headers.set('Authorization', `Bearer ${token}`);
    }

    const response = await fetch(`${API_BASE}${path}`, {
        ...options,
        headers,
    });

    const text = await response.text();
    const payload = text ? JSON.parse(text) : {};

    if (!response.ok) {
        throw new Error(payload.message || payload.error || 'Request failed');
    }

    return payload;
};

const normalizeTransactions = (payload) => {
    const source = payload.transactions || payload.data?.transactions || payload.data || payload || [];
    return Array.isArray(source) ? source : [];
};

const normalizeTransaction = (payload) => payload.transaction || payload.data?.transaction || payload.data || payload;

const statusClass = (status = '') => {
    const value = status.toUpperCase();

    if (value.includes('COMPLETE') || value.includes('VERIFIED') || value.includes('PAID')) {
        return 'status-success';
    }

    if (value.includes('DISPUTE')) {
        return 'status-danger';
    }

    if (value.includes('PENDING')) {
        return 'status-warning';
    }

    return 'status-info';
};

const titleCaseStatus = (status = 'PENDING') => status.replaceAll('_', ' ').toLowerCase().replace(/\b\w/g, (letter) => letter.toUpperCase());

const transactionTypeLabel = (type = '') => titleCaseStatus(type || 'Transaction');

const trustLevel = (score) => {
    if (score >= 90) return 'Highly Trusted';
    if (score >= 70) return 'Trusted';
    if (score >= 50) return 'New Vendor';
    if (score >= 31) return 'Low Trust';
    return 'Risky';
};

const dashboardNextAction = (transactions) => {
    if (!transactions.length) {
        return {
            title: 'Create your first escrow link',
            copy: 'Start by creating a payment link and sending it to a buyer.',
            badge: 'Ready',
            className: 'status-info',
            href: '/transactions/create',
        };
    }

    const disputed = transactions.find((item) => String(item.status).includes('DISPUTED'));
    if (disputed) {
        return {
            title: 'Review disputed transaction',
            copy: `${disputed.itemName || disputed.item_name || 'A transaction'} needs attention.`,
            badge: 'Dispute',
            className: 'status-danger',
            href: `/transactions/${disputed.id}`,
        };
    }

    const verified = transactions.find((item) => String(item.status).includes('AI_VERIFIED') || String(item.status).includes('PAID'));
    if (verified) {
        return {
            title: 'Deliver verified order',
            copy: `${verified.itemName || verified.item_name || 'An order'} is ready for delivery.`,
            badge: 'Deliver',
            className: 'status-success',
            href: `/transactions/${verified.id}`,
        };
    }

    const pending = transactions.find((item) => String(item.status).includes('PENDING'));
    if (pending) {
        return {
            title: 'Waiting for buyer payment',
            copy: `Share the checkout link for ${pending.itemName || pending.item_name || 'your transaction'}.`,
            badge: 'Pending',
            className: 'status-warning',
            href: `/transactions/${pending.id}`,
        };
    }

    return {
        title: 'Keep your storefront moving',
        copy: 'Create another escrow link for your next buyer.',
        badge: 'Next sale',
        className: 'status-info',
        href: '/transactions/create',
    };
};

document.querySelectorAll('[data-copy-target]').forEach((button) => {
    button.addEventListener('click', async () => {
        const target = document.getElementById(button.dataset.copyTarget);

        if (!target) {
            return;
        }

        await navigator.clipboard.writeText(target.textContent.trim());
        toast('Copied');
    });
});

document.querySelectorAll('[data-file-name-target]').forEach((input) => {
    input.addEventListener('change', () => {
        const target = document.getElementById(input.dataset.fileNameTarget);
        const fileName = input.files?.[0]?.name;

        if (target && fileName) {
            target.textContent = fileName;
        }
    });
});

document.querySelectorAll('[data-protected]').forEach(() => {
    if (!getToken()) {
        window.location.href = '/login';
    }
});

if (getToken()) {
    document.querySelectorAll('[data-guest-note]').forEach((note) => note.classList.add('hidden'));
    document.querySelectorAll('[data-vendor-note]').forEach((note) => note.classList.remove('hidden'));
    document.querySelectorAll('[data-guest-nav]').forEach((nav) => nav.classList.add('hidden'));
    document.querySelectorAll('[data-vendor-nav]').forEach((nav) => {
        nav.classList.remove('hidden');
        if (nav.classList.contains('grid-cols-4')) {
            nav.classList.add('grid');
        }
    });
}

document.querySelectorAll('[data-guest-page]').forEach(() => {
    if (getToken()) {
        window.location.href = '/dashboard';
    }
});

document.querySelectorAll('[data-auth-link]').forEach((link) => {
    if (getToken()) {
        link.href = '/profile';
    }
});

document.querySelectorAll('[data-logout]').forEach((button) => {
    button.addEventListener('click', () => {
        localStorage.removeItem(TOKEN_KEY);
        localStorage.removeItem(USER_KEY);
        window.location.href = '/login';
    });
});

document.querySelectorAll('[data-api-form]').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const submit = form.querySelector('button[type="submit"]');
        setLoading(submit, true);

        try {
            const action = form.dataset.apiForm;
            const data = Object.fromEntries(new FormData(form).entries());
            const payload = await apiFetch(action, {
                method: form.method || 'POST',
                body: JSON.stringify(data),
            });

            if (form.dataset.session === 'true') {
                setSession(payload);
            }

            toast(form.dataset.success || payload.message || 'Done');

            if (form.dataset.redirect) {
                window.setTimeout(() => {
                    window.location.href = form.dataset.redirect;
                }, 150);
            }

            if (form.dataset.createTransaction === 'true') {
                const transaction = normalizeTransaction(payload);
                const id = transaction.id || payload.id || payload.transactionId || payload.data?.id;
                const checkoutUrl = id ? `${window.location.origin}/checkout/${id}` : payload.checkoutUrl;

                if (checkoutUrl) {
                    const result = document.querySelector('[data-created-link]');
                    const output = document.getElementById('created-checkout-link');

                    output.textContent = checkoutUrl;
                    result.classList.remove('hidden');
                    toast('Payment link created');
                }
            }
        } catch (error) {
            toast(error.message, 'error');
        } finally {
            setLoading(submit, false);
        }
    });
});

const previewForm = document.querySelector('[data-transaction-preview-form]');
if (previewForm) {
    const updatePreview = () => {
        const data = Object.fromEntries(new FormData(previewForm).entries());
        const price = Number(data.price || 0);
        const deliveryFee = Number(data.deliveryFee || 0);
        const typeLabel = transactionTypeLabel(data.transactionType || 'PHYSICAL_PRODUCT');

        document.querySelector('[data-preview-item]').textContent = data.itemName || 'Escrow transaction';
        document.querySelector('[data-preview-type]').textContent = typeLabel;
        document.querySelector('[data-preview-timeframe]').textContent = data.deliveryTimeframe || 'Not set';
        document.querySelector('[data-preview-price]').textContent = money(price);
        document.querySelector('[data-preview-delivery]').textContent = money(deliveryFee);
        document.querySelector('[data-preview-total]').textContent = money(price + deliveryFee);
    };

    previewForm.querySelectorAll('[data-preview-input]').forEach((input) => {
        input.addEventListener('input', updatePreview);
        input.addEventListener('change', updatePreview);
    });

    updatePreview();
}

const dashboard = document.querySelector('[data-page="dashboard"]');
if (dashboard) {
    apiFetch('/api/transaction/vendor/all')
        .then((payload) => {
            const transactions = normalizeTransactions(payload);
            const metrics = payload.metrics || payload.dashboard || payload.data?.metrics || {};
            const user = getUser() || payload.vendor || payload.data?.vendor || {};
            const pendingCount = metrics.pendingTransactions ?? transactions.filter((item) => String(item.status).includes('PENDING')).length;
            const completedCount = metrics.completedTransactions ?? transactions.filter((item) => String(item.status).includes('COMPLETED')).length;
            const disputedCount = metrics.disputedTransactions ?? transactions.filter((item) => String(item.status).includes('DISPUTED')).length;
            const trustScore = Number(metrics.trustScore ?? payload.trustScore ?? user.trustScore ?? 50);
            const vendorName = user.fullName || user.full_name || payload.vendor?.fullName || payload.vendor?.full_name || 'Vendor';

            document.querySelector('[data-metric="total"]').textContent = metrics.totalTransactions ?? transactions.length;
            document.querySelector('[data-metric="pending"]').textContent = pendingCount;
            document.querySelector('[data-metric="completed"]').textContent = completedCount;
            document.querySelector('[data-metric="disputed"]').textContent = disputedCount;
            document.querySelector('[data-metric="escrow"]').textContent = money(metrics.totalMoneyInEscrow ?? metrics.totalEscrow ?? payload.inEscrowNGN ?? 0);
            document.querySelector('[data-metric="trust"]').textContent = `${trustScore}/100`;
            document.querySelector('[data-dashboard-name]').textContent = vendorName.split(' ')[0] || 'Vendor';
            document.querySelector('[data-trust-level]').textContent = trustLevel(trustScore);
            document.querySelector('[data-trust-bar]').style.width = `${Math.max(0, Math.min(100, trustScore))}%`;
            document.querySelector('[data-dashboard-summary]').textContent = transactions.length
                ? `You have ${pendingCount} pending, ${completedCount} completed, and ${disputedCount} disputed transaction${transactions.length === 1 ? '' : 's'}.`
                : 'No transactions yet. Create your first escrow link and send it to a buyer.';

            const nextAction = dashboardNextAction(transactions);
            document.querySelector('[data-next-action-title]').textContent = nextAction.title;
            document.querySelector('[data-next-action-copy]').textContent = nextAction.copy;
            document.querySelector('[data-next-action-badge]').textContent = nextAction.badge;
            document.querySelector('[data-next-action-badge]').className = `status-pill ${nextAction.className}`;
            document.querySelector('[data-next-action-link]').href = nextAction.href;

            const list = document.querySelector('[data-dashboard-transactions]');
            list.innerHTML = transactions.slice(0, 4).map((item) => `
                <article class="transaction-card animate-rise">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <h3 class="truncate text-base font-bold">${item.itemName || item.item_name || 'Escrow transaction'}</h3>
                            <p class="mt-1 text-sm text-[#668175]">${transactionTypeLabel(item.transactionType || item.transaction_type)}</p>
                        </div>
                        <p class="shrink-0 text-base font-bold">${money(item.price)}</p>
                    </div>
                    <div class="mt-4 flex items-center justify-between gap-3">
                        <span class="status-pill ${statusClass(item.status)}">${titleCaseStatus(item.status)}</span>
                        <a href="/transactions/${item.id}" class="text-sm font-bold text-[#0c6f43]">View</a>
                    </div>
                </article>
            `).join('') || `
                <div class="rounded-lg border border-dashed border-[#a9beae] bg-white p-5 text-center lg:col-span-2">
                    <p class="text-base font-bold">No transactions yet</p>
                    <p class="mt-2 text-sm leading-6 text-[#668175]">Create your first escrow payment link and send it to a buyer.</p>
                    <a href="/transactions/create" class="mt-4 inline-flex min-h-11 items-center justify-center rounded-lg bg-[#16a35f] px-4 py-2 text-sm font-bold text-white">Create Link</a>
                </div>
            `;

            const activity = document.querySelector('[data-activity-list]');
            activity.innerHTML = transactions.slice(0, 5).map((item) => `
                <div class="activity-item">
                    <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#16a35f]"></span>
                    <div class="min-w-0">
                        <p class="text-sm font-bold">${item.itemName || item.item_name || 'Escrow transaction'}</p>
                        <p class="mt-1 text-sm text-[#668175]">${titleCaseStatus(item.status)} • ${money(item.price)}</p>
                    </div>
                </div>
            `).join('') || `
                <div class="activity-item">
                    <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-[#16a35f]"></span>
                    <div>
                        <p class="text-sm font-bold">Dashboard ready</p>
                        <p class="mt-1 text-sm text-[#668175]">Your activity will appear here after transactions begin.</p>
                    </div>
                </div>
            `;
        })
        .catch((error) => toast(error.message, 'error'));
}

const transactionsPage = document.querySelector('[data-page="transactions"]');
if (transactionsPage) {
    apiFetch('/api/transaction/vendor/all')
        .then((payload) => {
            const transactions = normalizeTransactions(payload);
            const list = document.querySelector('[data-transactions-list]');
            const renderTransactions = (items) => {
                list.innerHTML = items.map((item) => `
                <a href="/transactions/${item.id}" class="transaction-card block">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <h2 class="truncate font-bold">${item.itemName || item.item_name || 'Escrow transaction'}</h2>
                            <p class="mt-1 break-all text-sm text-[#668175]">${item.id}</p>
                        </div>
                        <span class="status-pill ${statusClass(item.status)}">${titleCaseStatus(item.status)}</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between gap-3 border-t border-[#edf2ee] pt-3">
                        <span class="text-sm text-[#668175]">${transactionTypeLabel(item.transactionType || item.transaction_type)}</span>
                        <span class="text-lg font-bold">${money(item.price)}</span>
                    </div>
                </a>
            `).join('') || `
                <div class="rounded-lg border border-dashed border-[#a9beae] bg-white p-5 text-center lg:col-span-2">
                    <p class="font-bold">No transactions found</p>
                    <p class="mt-2 text-sm text-[#668175]">Create a new payment link or change your search.</p>
                </div>
            `;
            };

            const pending = transactions.filter((item) => String(item.status).includes('PENDING')).length;
            const completed = transactions.filter((item) => String(item.status).includes('COMPLETED')).length;
            const disputed = transactions.filter((item) => String(item.status).includes('DISPUTED')).length;
            const totalValue = transactions.reduce((sum, item) => sum + Number(item.price || 0) + Number(item.deliveryFee || item.delivery_fee || 0), 0);

            document.querySelector('[data-transaction-stat="value"]').textContent = money(totalValue);
            document.querySelector('[data-transaction-stat="pending"]').textContent = pending;
            document.querySelector('[data-transaction-stat="completed"]').textContent = completed;
            document.querySelector('[data-transaction-stat="disputed"]').textContent = disputed;
            document.querySelector('[data-transaction-summary]').textContent = transactions.length
                ? `${transactions.length} transaction${transactions.length === 1 ? '' : 's'} found. ${pending} pending, ${completed} completed, ${disputed} disputed.`
                : 'No transactions yet. Create your first escrow link to begin.';

            renderTransactions(transactions);

            document.querySelector('[data-transaction-search]')?.addEventListener('input', (event) => {
                const query = event.target.value.toLowerCase().trim();
                const filtered = transactions.filter((item) => {
                    const text = `${item.itemName || item.item_name || ''} ${item.status || ''} ${item.transactionType || item.transaction_type || ''} ${item.id || ''}`.toLowerCase();
                    return text.includes(query);
                });

                renderTransactions(filtered);
            });
        })
        .catch((error) => toast(error.message, 'error'));
}

const checkoutPage = document.querySelector('[data-page="checkout"], [data-page="transaction-detail"]');
if (checkoutPage) {
    const id = checkoutPage.dataset.transactionIdValue;

    apiFetch(`/api/transaction/${id}`)
        .then((payload) => {
            const item = normalizeTransaction(payload);
            const price = Number(item.price ?? 0);
            const delivery = Number(item.deliveryFee ?? item.delivery_fee ?? 0);
            const vendor = item.vendor || item.vendorInfo || {};

            document.querySelectorAll('[data-transaction-id]').forEach((node) => node.textContent = item.id || id);
            document.querySelectorAll('[data-item-name]').forEach((node) => node.textContent = item.itemName || item.item_name || 'Escrow transaction');
            document.querySelectorAll('[data-price]').forEach((node) => node.textContent = money(price));
            document.querySelectorAll('[data-delivery-fee]').forEach((node) => node.textContent = money(delivery));
            document.querySelectorAll('[data-total]').forEach((node) => node.textContent = money(price + delivery));
            document.querySelectorAll('[data-status]').forEach((node) => {
                node.textContent = titleCaseStatus(item.status);
                node.className = `status-pill ${statusClass(item.status)} self-start`;
            });
            document.querySelectorAll('[data-vendor-name]').forEach((node) => node.textContent = vendor.fullName || vendor.full_name || item.vendorName || 'Verified vendor');
            document.querySelectorAll('[data-vendor-trust]').forEach((node) => node.textContent = `${vendor.trustScore ?? item.trustScore ?? 50}/100`);
        })
        .catch((error) => toast(error.message, 'error'));
}

document.querySelectorAll('[data-payment-form]').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const button = form.querySelector('button[type="submit"]');
        setLoading(button, true);

        try {
            const data = Object.fromEntries(new FormData(form).entries());
            const payload = await apiFetch(`/api/payment/initiate/${form.dataset.paymentForm}`, {
                method: 'POST',
                body: JSON.stringify(data),
            });
            const url = payload.authorization_url
                || payload.authorizationUrl
                || payload.checkoutUrl
                || payload.paymentUrl
                || payload.url
                || payload.data?.authorization_url
                || payload.data?.authorizationUrl
                || payload.data?.checkoutUrl
                || payload.data?.paymentUrl
                || payload.data?.url;

            toast('Payment session created');

            if (url) {
                window.location.href = url;
            } else {
                toast('Payment link was not returned by backend', 'error');
            }
        } catch (error) {
            toast(error.message, 'error');
        } finally {
            setLoading(button, false);
        }
    });
});

const paymentCallback = document.querySelector('[data-page="payment-callback"]');
if (paymentCallback) {
    const params = new URLSearchParams(window.location.search);
    const reference = params.get('reference') || params.get('trxref') || params.get('transactionReference') || 'No reference found';
    const transactionId = params.get('transactionId') || params.get('transaction_id') || params.get('id');

    document.querySelector('[data-payment-reference]').textContent = reference;

    if (transactionId) {
        document.querySelector('[data-callback-receipt-link]').href = `/receipt/${transactionId}`;
        document.querySelector('[data-callback-checkout-link]').href = `/checkout/${transactionId}`;
    }
}

document.querySelectorAll('[data-receipt-form]').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const submit = form.querySelector('button[type="submit"]');
        setLoading(submit, true);

        try {
            const payload = await apiFetch(`/api/receipt/upload/${form.dataset.receiptForm}`, {
                method: 'POST',
                body: new FormData(form),
            });

            toast(payload.message || 'Receipt uploaded for AI verification');
        } catch (error) {
            toast(error.message, 'error');
        } finally {
            setLoading(submit, false);
        }
    });
});

document.querySelectorAll('[data-delivery-confirm]').forEach((button) => {
    button.addEventListener('click', async () => {
        setLoading(button, true);

        try {
            const payload = await apiFetch(`/api/delivery/confirm/${button.dataset.deliveryConfirm}`, { method: 'POST' });
            toast(payload.message || 'Delivery confirmed');
        } catch (error) {
            toast(error.message, 'error');
        } finally {
            setLoading(button, false);
        }
    });
});

document.querySelectorAll('[data-dispute-form]').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const submit = form.querySelector('button[type="submit"]');
        setLoading(submit, true);

        try {
            const data = Object.fromEntries(new FormData(form).entries());
            const payload = await apiFetch(`/api/delivery/dispute/${form.dataset.disputeForm}`, {
                method: 'POST',
                body: JSON.stringify(data),
            });

            toast(payload.message || 'Dispute submitted');
        } catch (error) {
            toast(error.message, 'error');
        } finally {
            setLoading(submit, false);
        }
    });
});

const profile = document.querySelector('[data-page="profile"]');
if (profile) {
    const user = getUser() || {};
    const name = user.fullName || user.full_name || 'Vendor';
    const phone = user.phoneNumber || user.phone_number || 'No phone saved';
    const score = Number(user.trustScore ?? 50);
    const initials = name.split(' ').filter(Boolean).slice(0, 2).map((part) => part[0]).join('').toUpperCase() || 'VS';

    document.querySelector('[data-profile-name]').textContent = name;
    document.querySelector('[data-profile-full-name]').textContent = name;
    document.querySelector('[data-profile-phone]').textContent = phone;
    document.querySelector('[data-profile-phone-copy]').textContent = phone;
    document.querySelector('[data-profile-trust]').textContent = `${score}/100`;
    document.querySelector('[data-profile-trust-level]').textContent = trustLevel(score);
    document.querySelector('[data-profile-trust-bar]').style.width = `${Math.max(0, Math.min(100, score))}%`;
    document.querySelector('[data-profile-initials]').textContent = initials;
    document.querySelector('[data-profile-bank]').textContent = user.bankName || user.bank_name || 'Not provided';
    document.querySelector('[data-profile-account]').textContent = user.accountNumber || user.account_number || 'Not provided';
}

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js').catch(() => {});
    });
}
