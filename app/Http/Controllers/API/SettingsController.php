<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\SettingsResource;
use Illuminate\Http\Request;

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
            $data = $this->pipeline->whereIn('key',['phone','whatsapp','facebook',])->get();
            $response = SettingsResource::collection($data);
        } else {
            $data = $this->pipeline->where('key', $key)->first();
            $response = new SettingsResource($data);
        }
        
        return jsonResponse(200, 'done.', $response);
    }
}
