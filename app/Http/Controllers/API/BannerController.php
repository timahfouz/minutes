<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\API\BannerResource;
use App\Http\Controllers\API\InitController;

class BannerController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Banner');
    }

    public function __invoke(Request $request)
    {
        $data = $this->pipeline->get();

        $response = BannerResource::collection($data);

        return jsonResponse(200, 'done.', $response);   
    }
}
