<?php

namespace App\Pipelines\Criterias;

use App\Pipelines\PipelineFactory;
use Illuminate\Http\Request;

class SearchOrdersPipeline extends PipelineFactory
{
    private $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    protected function apply($builder)
    {
        $userId = $this->request->user_id;
        $orderId = $this->request->order_id;
        
        if ($userId) {
            $builder = $builder->where('user_id', $userId);
        }
        if ($orderId) {
            $builder = $builder->where('id', $orderId);
        }
        return $builder;
    }
}
