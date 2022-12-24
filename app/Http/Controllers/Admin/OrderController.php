<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Admin\Orders\UpdateRequest;
use App\Pipelines\Criterias\FilterOrdersPipeline;
use App\Pipelines\Criterias\SearchOrdersPipeline;

class OrderController extends CRUDController
{
    protected $model = 'Order';
    protected $index_route = 'admin.orders.index';
    protected $delete_route = 'admin.orders.destroy';
    
    protected $index_view = 'admin.orders.index';
    protected $edit_view = 'admin.orders.edit';
    
    protected $update_request = UpdateRequest::class;

    private $carriers;

    public function __construct()
    {
        parent::__construct();
        
        $this->carriers = $this->pipeline->setModel('Carrier')->get();
        
        View::share('carriers', $this->carriers);
    }

    public function index(Request $request)
    {
        
        $this->pipeline->setModel($this->model);
        $this->pipeline->pushPipeline([
            new FilterOrdersPipeline($request),
            new SearchOrdersPipeline($request),
        ]);
        $items = $this->pipeline->orderBy('created_at', 'DESC')->get();
        $delte_route = $this->delete_route ?? null;
        
        return view($this->index_view, compact('items','delte_route'));
    }
}
