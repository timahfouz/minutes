<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\Cities\CreateRequest;
use App\Http\Requests\Admin\Cities\UpdateRequest;


class CityController extends CRUDController
{
    protected $model = 'Place';
    protected $index_route = 'admin.cities.index';
    protected $delete_route = 'admin.cities.destroy';
    
    protected $index_view = 'admin.cities.index';
    protected $edit_view = 'admin.cities.edit';
    protected $create_view = 'admin.cities.create';

    protected $store_request = CreateRequest::class;
    protected $update_request = UpdateRequest::class;

    public function index(Request $request)
    {
        $items = $this->pipeline->setModel($this->model)->whereNull('parent_id')->get();
        $delte_route = $this->delete_route;
        
        return view($this->index_view, compact('items','delte_route'));
    }
}
