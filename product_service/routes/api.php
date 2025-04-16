<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});


Route::get('/products/{id}', function ($id) {
    return response()->json([
        'id' => $id,
        'name' => 'Laptop',
        'price' => 8500000
    ]);
});

