<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


$users = [
    ['id' => 1, 'name' => 'Budi', 'email' => 'budi@example.com'],
    ['id' => 2, 'name' => 'Siti', 'email' => 'siti@example.com'],
    ['id' => 3, 'name' => 'Andi', 'email' => 'andi@example.com'],
    ['id' => 4, 'name' => 'Dewi', 'email' => 'dewi@example.com'],
    ['id' => 5, 'name' => 'Rudi', 'email' => 'rudi@example.com'],
    ['id' => 6, 'name' => 'Putri', 'email' => 'putri@example.com'],
    ['id' => 7, 'name' => 'Agus', 'email' => 'agus@example.com'],
    ['id' => 8, 'name' => 'Nina', 'email' => 'nina@example.com'],
    ['id' => 9, 'name' => 'Fajar', 'email' => 'fajar@example.com'],
    ['id' => 10, 'name' => 'Lina', 'email' => 'lina@example.com'],
];

Route::get('/users/{id}', function ($id) use ($users) {
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return response()->json($user);
        }
    }

    return response()->json(['message' => 'User not found'], 404);
});