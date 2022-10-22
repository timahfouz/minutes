<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\NotificationResource;

class NotificationController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Notification');
    }

    public function __invoke(Request $request)
    {
        $data = $this->pipeline->where('user_id', getUser()->id)->get();

        $response = NotificationResource::collection($data);

        return jsonResponse(200, 'done.', $response);   
    }
}