<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Admin\Places\CreateRequest;
use App\Http\Requests\Admin\Places\UpdateRequest;

class AreaController extends CRUDController
{
    protected $model = 'Place';
    protected $index_route = 'admin.areas.index';
    protected $delete_route = 'admin.areas.destroy';
    
    protected $index_view = 'admin.areas.index';
    protected $edit_view = 'admin.areas.edit';
    protected $create_view = 'admin.areas.create';

    protected $store_request = CreateRequest::class;
    protected $update_request = UpdateRequest::class;

    private $cities;

    public function __construct()
    {
        parent::__construct();

        $this->cities = $this->pipeline->setModel('Place')->whereNull('parent_id')->get();

        View::share('cities', $this->cities);
    }
    
    public function index(Request $request)
    {
        $items = $this->pipeline->whereIn('parent_id', $this->cities->pluck('id')->toArray())->get();
        $delte_route = $this->delete_route;
        
        return view($this->index_view, compact('items','delte_route'));
    }
}

