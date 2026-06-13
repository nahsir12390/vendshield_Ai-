<?php

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::any('/frontend-api/{path}', function (Request $request, string $path) {
    $backendUrl = 'https://vendshield-backend-production.up.railway.app/' . $path;
    $client = Http::acceptJson();

    if ($request->bearerToken()) {
        $client = $client->withToken($request->bearerToken());
    }

    if (count($request->allFiles()) > 0) {
        $client = $client->asMultipart();

        foreach ($request->allFiles() as $field => $file) {
            $files = is_array($file) ? $file : [$file];

            foreach ($files as $uploadedFile) {
                if ($uploadedFile instanceof UploadedFile) {
                    $client = $client->attach(
                        $field,
                        file_get_contents($uploadedFile->getRealPath()),
                        $uploadedFile->getClientOriginalName()
                    );
                }
            }
        }

        $response = $client->send($request->method(), $backendUrl, [
            'multipart' => collect($request->except(array_keys($request->allFiles())))
                ->map(fn ($value, $key) => ['name' => $key, 'contents' => $value])
                ->values()
                ->all(),
        ]);
    } else {
        $response = $client->send($request->method(), $backendUrl, [
            'json' => $request->all(),
        ]);
    }

    return response($response->body(), $response->status())
        ->header('Content-Type', $response->header('Content-Type', 'application/json'));
})->where('path', '.*')->name('frontend-api.proxy');

Route::view('/', 'landing')->name('landing');
Route::view('/how-it-works', 'how-it-works')->name('how-it-works');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/transactions', 'transactions.index')->name('transactions.index');
Route::view('/transactions/create', 'transactions.create')->name('transactions.create');
Route::get('/transactions/{id}', function (string $id) {
    $transaction = null;

    try {
        $response = Http::acceptJson()->get("https://vendshield-backend-production.up.railway.app/api/transaction/{$id}");

        if ($response->successful()) {
            $transaction = $response->json();
        }
    } catch (Throwable) {
        $transaction = null;
    }

    return view('transactions.show', ['id' => $id, 'transaction' => $transaction]);
})->name('transactions.show');
Route::view('/profile', 'profile')->name('profile');

Route::get('/checkout/{id}', fn (string $id) => view('buyer.checkout', ['id' => $id]))->name('checkout');
Route::get('/payment/{id}', fn (string $id) => view('buyer.payment', ['id' => $id]))->name('payment');
Route::view('/payment/callback', 'buyer.payment-callback')->name('payment.callback');
Route::view('/api/payment/callback', 'buyer.payment-callback')->name('payment.callback.paystack');
Route::get('/receipt/{id}', fn (string $id) => view('buyer.receipt', ['id' => $id]))->name('receipt');
Route::get('/delivery/{id}', fn (string $id) => view('buyer.delivery', ['id' => $id]))->name('delivery');
Route::get('/dispute/{id}', fn (string $id) => view('buyer.dispute', ['id' => $id]))->name('dispute');
