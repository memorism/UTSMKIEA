<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$products = [
    ['id' => 101, 'name' => 'Laptop', 'price' => 8500000],
    ['id' => 102, 'name' => 'Smartphone', 'price' => 4500000],
    ['id' => 103, 'name' => 'Tablet', 'price' => 3000000],
    ['id' => 104, 'name' => 'Smartwatch', 'price' => 1500000],
    ['id' => 105, 'name' => 'Gaming Headset', 'price' => 1700000],
    ['id' => 106, 'name' => 'Wireless Keyboard', 'price' => 950000],
    ['id' => 107, 'name' => '4K Monitor', 'price' => 6500000],
    ['id' => 108, 'name' => 'Portable SSD 1TB', 'price' => 2000000],
    ['id' => 109, 'name' => 'Bluetooth Speaker', 'price' => 1200000],
    ['id' => 110, 'name' => 'Action Camera', 'price' => 3800000],
    ['id' => 111, 'name' => 'Mechanical Keyboard', 'price' => 1750000],
    ['id' => 112, 'name' => 'Drone Pro', 'price' => 10500000],
    ['id' => 113, 'name' => 'VR Headset', 'price' => 5500000],
    ['id' => 114, 'name' => 'Webcam 1080p', 'price' => 850000],
    ['id' => 115, 'name' => 'Microphone Condenser', 'price' => 1300000],
    ['id' => 116, 'name' => 'Smart TV 55 inch', 'price' => 9500000],
    ['id' => 117, 'name' => 'Smartphone Ultra', 'price' => 12500000],
    ['id' => 118, 'name' => 'Laptop Thinbook', 'price' => 6700000],
    ['id' => 119, 'name' => 'Tablet Mini', 'price' => 3000000],
    ['id' => 120, 'name' => 'Gaming Chair', 'price' => 2900000],
    ['id' => 121, 'name' => 'Powerbank 20000mAh', 'price' => 450000],
    ['id' => 122, 'name' => 'Wireless Mouse', 'price' => 350000],
    ['id' => 123, 'name' => 'USB Hub 4 Port', 'price' => 150000],
    ['id' => 124, 'name' => 'External HDD 2TB', 'price' => 1500000],
    ['id' => 125, 'name' => 'LED Strip Light', 'price' => 300000],
    ['id' => 126, 'name' => 'Router WiFi 6', 'price' => 2000000],
    ['id' => 127, 'name' => 'Smartwatch Lite', 'price' => 1300000],
    ['id' => 128, 'name' => 'Portable Projector', 'price' => 4200000],
    ['id' => 129, 'name' => 'Fitness Tracker', 'price' => 850000],
    ['id' => 130, 'name' => 'Gaming Mousepad RGB', 'price' => 400000],
    ['id' => 131, 'name' => 'Noise Cancelling Headphone', 'price' => 2200000],
    ['id' => 132, 'name' => 'Smartphone Fold', 'price' => 17000000],
    ['id' => 133, 'name' => 'Wireless Earbuds', 'price' => 1500000],
    ['id' => 134, 'name' => 'Laptop Gaming Beast', 'price' => 19500000],
    ['id' => 135, 'name' => 'Desktop PC Mini', 'price' => 9000000],
    ['id' => 136, 'name' => 'Mechanical Numpad', 'price' => 500000],
    ['id' => 137, 'name' => 'Gaming Controller', 'price' => 850000],
    ['id' => 138, 'name' => 'WiFi Range Extender', 'price' => 600000],
    ['id' => 139, 'name' => 'Smart Lamp', 'price' => 450000],
    ['id' => 140, 'name' => 'Drawing Tablet', 'price' => 2500000],
    ['id' => 141, 'name' => 'Thermal Printer', 'price' => 1800000],
    ['id' => 142, 'name' => 'Smart Glasses', 'price' => 11500000],
    ['id' => 143, 'name' => 'Wireless Charging Pad', 'price' => 550000],
    ['id' => 144, 'name' => 'Bluetooth Tracker', 'price' => 350000],
    ['id' => 145, 'name' => 'Smartphone Basic', 'price' => 3200000],
    ['id' => 146, 'name' => 'Gaming Desk', 'price' => 4000000],
    ['id' => 147, 'name' => 'Tablet Kids Edition', 'price' => 2500000],
    ['id' => 148, 'name' => 'Smart Home Hub', 'price' => 1500000],
    ['id' => 149, 'name' => 'Photo Printer', 'price' => 3000000],
    ['id' => 150, 'name' => 'Digital Audio Recorder', 'price' => 2200000],
];

Route::get('/products/{id}', function ($id) use ($products) {
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return response()->json($product);
        }
    }

    return response()->json(['message' => 'Product not found'], 404);
});

Route::get('/products', function () use ($products) {
    return response()->json($products); 
});
