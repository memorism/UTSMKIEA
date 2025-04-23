<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::post('/orders', function (Request $request) {
    $user = Http::get("http://user_service/api/users/{$request->user_id}")->json();
    $product = Http::get("http://product_service/api/products/{$request->product_id}")->json();

    return response()->json([
        'order_id' => "{$request->user_id}{$request->product_id}",
        'user' => $user,
        'product' => $product,
        'total' => $product['price']
    ]);
});


