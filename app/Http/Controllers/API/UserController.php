<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\UserResource;
use App\Http\Requests\API\UpdateUserRequest;

class UserController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Order');
    }

    public function __invoke()
    {
        $user = getUser();

        $response = new UserResource($user);

        return jsonResponse(200, 'done', $response); 
    }
    
    public function update(UpdateUserRequest $request)
    {
        $user = getUser();

        DB::beginTransaction();
        try {
            $data = $request->except(['image','password_confirmation','_method']);
            
            if($request->hasFile('image')) {
                $path = resizeImage($request->image, 'uploads', $allSizes=false);
                $media = $this->pipeline->setModel('Media')->create(['path' => $path]);
                $data['image_id'] = $media->id;
            }

            $user->update($data);

            $data = new UserResource($user);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return jsonResponse($e->getCode(), $e->getMessage());
        }
        
        return jsonResponse(201, 'done.', $data); 
    }
}
