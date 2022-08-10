<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pipelines\Pipeline;

class CRUDController extends Controller
{
    protected $pipeline;
    protected $has_files = false;

    public function __construct()
    {
        $this->pipeline = app(Pipeline::class);
    }

    public function index(Request $request)
    {
        $items = $this->pipeline->setModel($this->model)->get();
        $delte_route = $this->delete_route ?? null;
        
        return view($this->index_view, compact('items','delte_route'));
    }
    
    public function show($id)
    {
        // 
    }
    
    public function edit($id)
    {
        $item = $this->pipeline->setModel($this->model)->findOrFail($id);
        return view($this->edit_view, compact('item'));
    }
    
    public function update($id)
    {
        $request = app($this->update_request);
        
        $data = $request->validated();

        $obj = $this->pipeline->setModel($this->model)->findOrFail($id);

        if ($this->has_files) {
            $this->updateData($request, $data, $obj);
        }

        $obj->update($data);

        return redirect()->route($this->index_route);
    }

    public function create(Request $request)
    {
        return view($this->create_view);
    }

    public function store()
    {
        $request = app($this->store_request);

        $data = $request->validated();
        
        if ($this->has_files) {
            $this->storeData($request, $data);
        }

        $this->pipeline->setModel($this->model)->create($data);

        return redirect()->route($this->index_route);
    }
    
    public function destroy($id)
    {
        $this->pipeline->setModel($this->model)->where('id', $id)->delete();

        return redirect()->route($this->index_route);
    }
    
}
