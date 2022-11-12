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
        if ($key == 'about-us') {
            $response = [];
            $data = $this->pipeline->whereIn('key',['about-us','twitter','instagram','facebook','website'])->get();
            foreach ($data as $item) {
                if ($item['key'] != 'about-us') {
                    $response[$item['key']] = $item['value'];
                } else {
                    $response['content'] = $item['value'];
                }
            }
        } else if($key == 'contacts') {
            $response = [];
            $data = $this->pipeline->whereIn('key',['twitter','instagram','facebook','website'])->get();
            foreach ($data as $item) {
                $response[$item['key']] = $item['value'];
            }
        }else {
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
    
    public function fees()
    {
        $settings = $this->pipeline->get();
        $data = collect($settings);
        
        $response = [
            'commission' => (double)$data->where('key','commission')->first()->value,
            'delivery_fees' => (double)$data->where('key','delivery_fees')->first()->value,
        ];
        
        return jsonResponse(201, 'done.', $response);
    }
}
