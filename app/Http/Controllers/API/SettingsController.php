<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ContactUsRequest;
use App\Http\Resources\API\SettingsResource;

class SettingsController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Setting');
    }

    public function __invoke($key)
    {
        if ($key == 'contacts') {
            $data = $this->pipeline->whereIn('key',['twitter','instagram','facebook','website'])->get();
            $response = SettingsResource::collection($data);
        } else {
            $data = $this->pipeline->where('key', $key)->first();
            $response = new SettingsResource($data);
        }
        
        return jsonResponse(200, 'done.', $response);
    }
    
    public function contactUs(ContactUsRequest $request)
    {
        $this->pipeline->setModel('ContactUs')->create($request->only(['name','phone','message']));
        
        return jsonResponse(201, 'done.');
    }
}
