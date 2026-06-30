<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

abstract class Controller
{
    protected function apiValidator(array $data, array $rules)
    {
        return Validator::make($data, $rules);
    }

    protected function jsonResponse($status, $message, $data = null, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

}
