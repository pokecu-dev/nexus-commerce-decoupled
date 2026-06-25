<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/produk', function (){
    return response()->json([
        'status' => 'success',
        'message' => 'data produk berhasil di ambil dari be laravel!',
        'data' => [
            ['id' => 1,'nama' => 'sepatu sigma', 'harga' => 150000],
            ['id' => 2,'nama' => 'tas sekolah', 'harga' => 75000],
            ['id' => 3,'nama' => 'kotak bekal', 'harga' => 30000],
            ['id' => 4,'nama' => 'buku catatan', 'harga' => 5000]
        ]
    ]);
});

Route::get('/users',[UserController::class, 'index']);