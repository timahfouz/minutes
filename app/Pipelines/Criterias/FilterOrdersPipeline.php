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
        $index = [
            'pending' => ['pending','on-way'],
            'completed' => ['completed'],
            'rejected' => ['rejected'],
        ];
        $searchIn = isset($index[$this->request->status]) ? $index[$this->request->status] : [];

        if ($this->request && $this->request->filled('status')) {
            return $builder->whereIn('status', $searchIn);
        }
        return $builder;
    }
}
