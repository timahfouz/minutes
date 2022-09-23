<?php

namespace App\Pipelines\Criterias;

use App\Models\Category;
use App\Pipelines\PipelineFactory;
use Illuminate\Http\Request;

class FilterBySectionPipeline extends PipelineFactory
{
    private $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    protected function apply($builder)
    {
        if ($this->request && $this->request->filled('section_id')) {
            $categoryIds = Category::where('parent_id', $this->request->get('category_id'))
                ->pluck('id')->toArray();
            $builder = $builder->whereIn('category_id', $categoryIds);
        }
        return $builder;
    }
}
