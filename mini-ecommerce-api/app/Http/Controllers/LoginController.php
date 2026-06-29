<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use PHPUnit\Logging\OpenTestReporting\Status;

class LoginController extends Controller
{

    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');


        $users = DB::table('users')->where('USERNAME',$username)->orWhere('EMAIL',$username)->first();
        
        if($users && Hash::check($password,$users->PASS)){   

            $role = match ($users->ROLE) {
                "ADMIN" => 96 ,
                "PENJUAL" => 59,
                "PEMBELI" => 3,
                default => 3,
            };

            if(!$users->TOKEN){
                
                $token = 'TOKEN_SIGMA_' . bin2hex(random_bytes(16));

                DB::table('users')
                ->where("ID",$users->ID)
                ->update([
                    'TOKEN' => $token,
                    'UPDATED_AT' => now()
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'login berhasil',
                    'token' => $token,
                    'role' => $role
                ]);

            }

            return response()->json([
                'status' => 'success',
                'message' => 'login berhasil',
                'token' => $users->TOKEN,
                'role' => $role
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'informasi login salah!'
            ]);
        }
    }

    public function register(Request $request){

        // format check
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',

            'username' => [
                'required',
                'regex:/^[a-z0-9_]{3,15}$/'
            ],

            'no_tlp' => [
                'required',
                'regex:/^\+[0-9]{2} [0-9]{3}-[0-9]{4}-[0-9]{4}$/'
            ]

        ]);

        if($validator->fails()){
            
            $error = $validator->errors();

            if($error->has('username')) return response()->json(['status' => 'error','message' => 'kesalahan pada format username!'], 400);

            if($error->has('email')) return response()->json(['status' => 'error', 'message' => 'kesalahan pada format email!'], 400);

            if($error->has('no_tlp')) return response()->json(['status' => 'error', 'message' => 'kesalahan pada format nomor telepon!'], 400);

        }

        // dupe check

        $validator = Validator::make($request->all(),[
            'username' => 'unique:users,USERNAME',
            'email' => 'unique:users,EMAIL',
            'no_tlp' => 'unique:users,NO_TLP'
        ]);

        if($validator->fails()){

            $error = $validator->errors();

            if($error->has('username')) return response()->json(['status' => 'error','message' => 'username sudah terdaftar!'], 400);

            if($error->has('email')) return response()->json(['status' => 'error', 'message' => 'email sudah terdaftar'], 400);

            if($error->has('no_tlp')) return response()->json(['status' => 'error', 'message' => 'nomor telepon sudah terdaftar!'], 400);

        }

        $username = $request->input('username');
        $nama_lengkap = $request->input('nama_lengkap');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $role = $request->input('role','PEMBELI');
        $no_tlp = $request->input('no_tlp');

        // insert

        DB::table('users')->insert([
            'USERNAME' => $username,
            'NAMA_LENGKAP' => $nama_lengkap,
            'EMAIL' => $email,
            'PASS' => $password,
            'ROLE' => $role,
            'NO_TLP' => $no_tlp,
            'STATUS' => '1',
            'CREATED_AT' => now(),
            'UPDATED_AT' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'resterasi berhasil',
            'data' => [
                'username' => $username,
                'role' => $role
            ]
        ]);


    }
}
