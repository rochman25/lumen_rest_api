<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'username' => 'required|string|unique:users',
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

    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string' 
        ]);

        $credentials = $request->only(['username','password']);

        if(!$token = Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'],401);
        }
        $data['user'] = User::where('username',$request->input('username'))->first();
        $data['token'] = $token;
        return $this->respondWithToken($data);

    }

    //
}
