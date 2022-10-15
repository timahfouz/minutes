<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\ProductResource;
use App\Pipelines\Criterias\FilterBySectionPipeline;
use App\Pipelines\Criterias\FilterByCategoryPipeline;
use App\Pipelines\Criterias\GetRandomElementsPipeline;
use App\Pipelines\Criterias\FilterProductsByNamePipeline;

class ProductController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Product');
    }

    public function __invoke(Request $request)
    {
        $this->pipeline->pushPipeline(new FilterBySectionPipeline($request));
        $this->pipeline->pushPipeline(new FilterByCategoryPipeline($request));
        $this->pipeline->pushPipeline(new FilterProductsByNamePipeline($request));

        $data = $this->pipeline->get();

        $response = ProductResource::collection($data);

        return jsonResponse(200, 'done.', $response);   
    }

    public function randomItems(Request $request)
    {
        $this->pipeline->pushPipeline(new GetRandomElementsPipeline($request));

        $data = $this->pipeline->get();

        $response = ProductResource::collection($data);

        return jsonResponse(200, 'done.', $response);   
    }
}
