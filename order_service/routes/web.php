<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', function () {
    return view('orders');
});

Route::post('/orders', function (Request $request) {
    // Ambil data user
    $user = Http::get("http://127.0.0.1:8001/api/users/{$request->user_id}")->json();

    // Ambil data produk
    $product = Http::get("http://127.0.0.1:8002/api/products/{$request->product_id}")->json();

    // Simulasi status order secara acak
    $statuses = ['Pending', 'Success'];
    $status = $statuses[array_rand($statuses)];

    return response()->json([
        'order_id' => "{$request->user_id}{$request->product_id}",
        'user' => $user,
        'product' => $product,
        'total' => $product['price'],
        'status' => $status
    ]);
});
