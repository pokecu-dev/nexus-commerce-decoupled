<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// import controller:D
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

use function PHPUnit\Framework\isInt;

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

Route::post('/login',[LoginController::class, 'login']);
Route::post('/register',[LoginController::class,'register']);

Route::post('/verify-token', function (Request $request){
    $tokenInput = $request->input('token');
    $roleInput = $request->input('r');

    // cek int
    if(!in_array((int)$roleInput,[96,59,3])){
        return response()->json([
            'status'=> 'error',
            'message' => 'role is undefined'
        ],401);
    }

    // cek role + konversi
    $role = match ($roleInput) {
        96 => "ADMIN",
        59 => "PENJUAL",
        3 => "PEMBELI",
        "96" => "ADMIN",
        "59" => "PENJUAL",
        "3 "=> "PEMBELI"
    };

    // db
    $user = DB::table('users')->where("TOKEN",$tokenInput)->first();
    
    // cek hasil
    if(!$user){
        return response()->json([
            'status' => 'error',
            'message' => 'token not found!'
        ],401);
    } 

    // jika role sama
    if($role === $user->ROLE){
        return response()->json([
            'status' => 'success',
            'check' => 'no need',
            'message' => 'user and role',
            'data' => $role
        ]);
    }
    // jika role tidak sama
    else{

        return response()->json([
            'status' => 'error',
            'message' => 'role not found ' . $role
        ]);
    }

});

// logout di be adalah hapus token
Route::post('/logout', function(Request $request){
    $tokenInput = $request->input('token');
    
    try{
        DB::table('users')->where('TOKEN',$tokenInput)->first();

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil logout dan menghapus token'
        ]);
    }
    catch(Exception $e){
        return response()->json([
            'status'=> 'error',
            'message' => 'error: '. $e->getMessage()
        ]);
    }

    


});
