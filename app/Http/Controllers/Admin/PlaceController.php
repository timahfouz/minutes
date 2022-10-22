<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Admin\Places\CreateRequest;
use App\Http\Requests\Admin\Places\UpdateRequest;

class PlaceController extends CRUDController
{
    protected $model = 'Place';
    protected $index_route = 'admin.places.index';
    protected $delete_route = 'admin.places.destroy';
    
    protected $index_view = 'admin.places.index';
    protected $edit_view = 'admin.places.edit';
    protected $create_view = 'admin.places.create';

    protected $store_request = CreateRequest::class;
    protected $update_request = UpdateRequest::class;

    private $cities;

    public function __construct()
    {
        parent::__construct();
        
        $places = $this->pipeline->setModel('Place')->whereNull('parent_id')->pluck('id')->toArray();
        $this->cities = $this->pipeline->setModel('Place')->whereIn('parent_id', $places)->get();
        
        View::share('areas', $this->cities);
    }
    
    public function index(Request $request)
    {
        $items = $this->pipeline->whereIn('parent_id', $this->cities->pluck('id')->toArray())->get();
        $delte_route = $this->delete_route;
        
        return view($this->index_view, compact('items','delte_route'));
    }
}