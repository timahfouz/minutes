<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\PlaceResource;
use App\Pipelines\Criterias\FilterPlacesPipeline;

class PlaceController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Place');
    }

    public function __invoke($id=null)
    {
        $this->pipeline->pushPipeline(new FilterPlacesPipeline($id));
        $data = $this->pipeline->get();

        $response = PlaceResource::collection($data);

        return jsonResponse(200, 'done.', $response);
    }
}
