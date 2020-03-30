<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //

    protected function respondWithToken($data){
        return response()->json([
            'user' => $data['user'],
            'token' => $data['token'],
            'token_type' => 'bearer',
            'expired_in' => Auth::factory()->getTTL() * 60
        ],200);
    }
}
