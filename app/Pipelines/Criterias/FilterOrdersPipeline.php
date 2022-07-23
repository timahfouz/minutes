<?php

namespace App\Pipelines\Criterias;

use App\Pipelines\PipelineFactory;
use Illuminate\Http\Request;

class FilterOrdersPipeline extends PipelineFactory
{
    private $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    protected function apply($builder)
    {
        if ($this->request && $this->request->filled('status')) {
            return $builder->where('status', $this->request->status);
        }
        return $builder;
    }
}
