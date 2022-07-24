<?php

namespace App\Pipelines\Criterias;

use App\Pipelines\PipelineFactory;
use Illuminate\Http\Request;

class FilterProductsByNamePipeline extends PipelineFactory
{
    private $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    protected function apply($builder)
    {
        if ($this->request && $this->request->filled('name')) {
            $builder = $builder->where('name', 'LIKE', '%'.$this->request->name.'%');
        }
        return $builder;
    }
}
