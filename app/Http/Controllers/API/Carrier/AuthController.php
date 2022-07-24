<?php

namespace App\Http\Controllers\API\Carrier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\API\CarrierResource;
use App\Http\Controllers\API\InitController;

class AuthController extends InitController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);

        if (!$token = Auth::guard('carrier')->attempt($credentials)) {
            return jsonResponse(401, 'Wrong username or password!');
        }
        
        $user = Auth::guard('carrier')->user();
        $user->access_token = $token;

        $data = new CarrierResource($user);

        return jsonResponse(200, 'done.', $data);
    }
    
    public function logout()
    {
        Auth::guard('api')->logout();
        
        return jsonResponse(200);
    }
}