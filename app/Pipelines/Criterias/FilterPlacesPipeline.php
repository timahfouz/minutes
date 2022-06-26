<?php

namespace App\Pipelines\Criterias;

use App\Pipelines\PipelineFactory;
use Illuminate\Http\Request;

class FilterPlacesPipeline extends PipelineFactory
{
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    protected function apply($builder)
    {
        $builder = $builder->where('parent_id', $this->id);
        
        return $builder;
    }
}
