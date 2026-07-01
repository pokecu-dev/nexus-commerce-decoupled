<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $requiredRole (Ini parameter dinamis yang kita pasang di route)
     */
    public function handle(Request $request, Closure $next, string $requiredRole): Response
    {

        $token = $request->header('Authorization') ?? $request->input('token');
        
        if($token && str_starts_with($token, 'Bearer ')) $token = substr($token, 7);

        if(!$token){
            return response()->json([
                'status' => 'error',
                'message' => 'akses ditolak, token tidak ditemukan!'
            ], 401);
        }

        $users = DB::table('users')->where('TOKEN',$token)->first();

        if(!$users){
            return response()->json([
                'status' => 'error',
                'message' => 'sesi tidak valid'
            ]);
        }


        if(strtoupper($users->ROLE) !== "ADMIN"){

            if (strtoupper($users->ROLE) !== strtoupper($requiredRole)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'anda tidak memiliki akses untuk mengakses API ini!'
                ], 403); 
            }
        }

        return $next($request);
    }
}
