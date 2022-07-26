<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\API\OfferResource;
use App\Pipelines\Criterias\DailyOffersPipeline;
use App\Pipelines\Criterias\ProductOffersPipeline;

class OfferController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Offer');
    }

    public function __invoke($type)
    {
        if ($type == 'daily') {
            $this->pipeline->pushPipeline(new DailyOffersPipeline());
        } elseif ($type == 'products') {
            $this->pipeline->pushPipeline(new ProductOffersPipeline());
        }
        
        $data = $this->pipeline->get();
        // return jsonResponse(200, 'done.', $data); 
        $response = OfferResource::collection($data);

        return jsonResponse(200, 'done.', $response);   
    }
}