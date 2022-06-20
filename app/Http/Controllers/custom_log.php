<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;

class custom_log extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $credentials=request(['email','password']);
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $token = auth('api')->attempt($credentials);
        if($token === false){
            return response()->json(['error' => 'tknfnd'], 401);
        }

        return $this->createNewToken($token);
    }
    
  

   
    public function logout() {
        auth()->logout();
        return response()->json(['sts'=>'logout','msg' => 'User successfully signed out']);
    }
    
    
    protected function createNewToken($token){
        //dd($token);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
            'user' => auth('api')->user()
        ]);
    }
}
