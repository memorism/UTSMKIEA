<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::post('/orders', function (Request $request) {
    $user = Http::get("http://127.0.0.1:8001/api/users/{$request->user_id}")->json();
    $product = Http::get("http://127.0.0.1:8002/api/products/{$request->product_id}")->json();

    return response()->json([
        'order_id' => "{$request->user_id}{$request->product_id}",
        'user' => $user,
        'product' => $product,
        'total' => $product['price']
    ]);
});



