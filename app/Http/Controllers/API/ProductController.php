<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\ProductResource;
use App\Pipelines\Criterias\FilterByCategoryPipeline;

class ProductController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Product');
    }

    public function __invoke(Request $request)
    {
        $this->pipeline->pushPipeline(new FilterByCategoryPipeline($request));

        $data = $this->pipeline->get();

        $response = ProductResource::collection($data);

        return jsonResponse(200, 'done.', $response);   
    }
}
