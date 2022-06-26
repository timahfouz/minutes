<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\CategoryResource;

class CategoryController extends InitController
{
    public function __construct()
    {
        parent::__construct();
        $this->pipeline->setModel('Category');
    }

    public function __invoke(Request $request)
    {
        $data = $this->pipeline->get();

        $response = CategoryResource::collection($data);

        return jsonResponse(200, 'done.', $response);   
    }
}
