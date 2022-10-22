<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Admin\Categories\CreateRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;


class CategoryController extends CRUDController
{
    protected $model = 'Category';
    protected $index_route = 'admin.categories.index';
    protected $delete_route = 'admin.categories.destroy';
    
    protected $index_view = 'admin.categories.index';
    protected $edit_view = 'admin.categories.edit';
    protected $create_view = 'admin.categories.create';

    protected $store_request = CreateRequest::class;
    protected $update_request = UpdateRequest::class;

    protected $has_files = true;
    
    public function __construct()
    {
        parent::__construct();

        $sections = $this->pipeline->setModel('Category')->whereNull('parent_id')->get();
        View::share('sections', $sections);
    }
    
    public function index(Request $request)
    {
        $items = $this->pipeline->setModel($this->model)->whereNotNull('parent_id')->get();
        $delte_route = $this->delete_route ?? null;
        
        return view($this->index_view, compact('items','delte_route'));
    }

    protected function storeData($request, &$data)
    {
        if ($request->hasFile('image')) {
            $imagePath = resizeImage($request->image, 'uploads', [200, 200]);
            $image = $this->pipeline->setModel('Media')->create([
                'path' => $imagePath
            ]);
    
            $data['image_id'] = $image->id;
        }
        
    }

    protected function updateData($request, &$data, $item)
    {
        if ($request->hasFile('image')) {
            $imagePath = resizeImage($request->image, 'uploads', [200, 200]);
            $image = $this->pipeline->setModel('Media')->create([
                'path' => $imagePath
            ]);
    
            $data['image_id'] = $image->id;
        }
    }
    
}
