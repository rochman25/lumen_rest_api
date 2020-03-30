<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request){
        $this->validate($request,[
            'username' => 'required|required',
            'password' => 'required|confirmed'
        ]);

        try{
            $user = new User;
            $user->username = $request->input('username');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();
            return response()->json(['user' => $user, 'message' => 'CREATED'],201);
        }catch(\Exception $e){
            return response()->json(['message' => 'user registration failed!'],409);
        }

    }

    //
}
