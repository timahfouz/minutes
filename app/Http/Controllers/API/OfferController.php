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
            $data = $this->pipeline->get();
            $response = OfferResource::collection($data);
        } elseif ($type == 'products') {
            $response = (new ProductOffersPipeline('Offer'))->apply();
        }
        
        
        // return jsonResponse(200, 'done.', $data); 
        

        return jsonResponse(200, 'done.', $response);   
    }
}