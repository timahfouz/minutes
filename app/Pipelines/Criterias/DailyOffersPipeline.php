<?php

namespace App\Pipelines\Criterias;

use App\Pipelines\PipelineFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyOffersPipeline extends PipelineFactory
{
    
    protected function apply($builder)
    {
        return $builder->where('is_offer_expired', true)
            ->whereDate('expired_at','>=',Carbon::now());
    }
}
