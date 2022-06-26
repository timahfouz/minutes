<?php

namespace App\Pipelines\Criterias;

use App\Pipelines\PipelineFactory;
use Illuminate\Http\Request;

class FilterByCategoryPipeline extends PipelineFactory
{
    private $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    protected function apply($builder)
    {
        if ($this->request && $this->request->filled('category_id')) {
            $category_id = $this->request->get('category_id');
            $builder = $builder->where('category_id', $category_id);
        }
        return $builder;
    }
}
