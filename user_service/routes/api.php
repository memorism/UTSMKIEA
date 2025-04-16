<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});


Route::get('/users/{id}', function ($id) {
    return response()->json([
        'id' => $id,
        'name' => 'Budi',
        'email' => 'budi@example.com'
    ]);
});
