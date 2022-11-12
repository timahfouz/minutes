<?php

namespace App\Pipelines\Criterias;

use App\Pipelines\PipelineFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyOffersPipeline extends PipelineFactory
{
    
    protected function apply($builder)
    {
        $url = env('APP_URL');

        return $builder->selectRaw("offers.*, p.price, p.name, c.name as category_name, CONCAT('$url','/',m.path) as image_path")
        ->leftJoin('products as p', function($join) {
            $join->on('offers.product_id','=','p.id');
        })
        ->leftJoin('media as m', function($join) {
            $join->on('m.id','=','p.image_id');
        })
        ->leftJoin('categories as c', function($join) {
            $join->on('offers.category_id','=','c.id');
        })
        ->where('is_offer_expired', true)
        ->whereDate('expired_at','>=',Carbon::now());
    }
}
