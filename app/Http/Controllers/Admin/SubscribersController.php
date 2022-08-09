<?php

namespace App\Http\Controllers\Admin;

use App\Pipelines\Pipeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pipelines\Criterias\OrderByDatePipeline;

class SubscribersController extends Controller
{
    private $index_route = 'admin.subscribers.index';
    private $delete_route = 'admin.subscribers.destroy';
    
    private $index_view = 'admin.subscribers.index';

    public $pipeline;
    public $model;

    public function __construct()
    {
        $this->pipeline = app(Pipeline::class);
        $this->model = $this->pipeline->setModel('Subscriber');
        
    }

    public function index(Request $request)
    {
        $this->pipeline->pushPipelines(new OrderByDatePipeline($request));

        $items = $this->model->get();
        $delte_route = $this->delete_route;


        return view($this->index_view, compact('items','delte_route'));
    }
    
    public function destroy($id)
    {
        $this->model->where('id', $id)->delete();

        return redirect()->route($this->index_route);
    }

}
