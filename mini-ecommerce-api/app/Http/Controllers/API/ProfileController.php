<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile(Request $request){

        $token = $request->bearerToken('token');

        if(!$token){
            return response()->json([
                'status' => 'error',
                'message' => 'mana token nya'
            ],401);
        }

        $user = DB::table('users')->where('TOKEN',$token)->first();

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'token tidak ditemukan!'
            ],401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data berhasil di ambil',
            'data' => [
                'id' => $user->ID,
                'usn' => $user->USERNAME,
                'nama lengkap' => $user->NAMA_LENGKAP,
                'no_tlp' => $user->NO_TLP,
                'email' => $user->EMAIL
            ]
        ]);




    }
}
