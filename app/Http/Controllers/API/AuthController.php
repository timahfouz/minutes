<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\CreateUserRequest;
use App\Http\Resources\API\UserResource;

class AuthController extends InitController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['phone', 'password']);

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return jsonResponse(401, 'Wrong phone or password!');
        }
        
        $user = Auth::guard('api')->user();
        $user->access_token = $token;

        $data = new UserResource($user);

        return jsonResponse(200, 'done.', $data);
    }

    public function register(CreateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except(['password_confirmation','image']);
            
            if($request->hasFile('image')) {
                $path = resizeImage($request->image, 'uploads', $allSizes=false);
                $media = $this->pipeline->setModel('Media')->create(['path' => $path]);
                $data['image_id'] = $media->id;
            }

            $user = $this->pipeline->setModel('User')->create($data);

            $user->access_token = auth()->guard('api')->tokenById($user->id);
            
            $data = new UserResource($user);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return jsonResponse($e->getCode(), $e->getMessage());
        }
        
        return jsonResponse(201, 'done.', $data);
    }


    public function logout()
    {
        Auth::guard('api')->logout();
        
        return jsonResponse(200);
    }
}
