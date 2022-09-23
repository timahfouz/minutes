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

    public function sections()
    {
        $data = $this->pipeline->whereNull('parent_id')->get();

        $response = CategoryResource::collection($data);

        return jsonResponse(200, 'done.', $response);   
    }
    
    public function index(Request $request)
    {
        if ($request->filled('id')) {
            $this->pipeline->where('parent_id', $request->id);
        } else {
            $this->pipeline->whereNotNull('parent_id');
        }
        $data = $this->pipeline->get();

        $response = CategoryResource::collection($data);

        return jsonResponse(200, 'done.', $response);   
    }
}
