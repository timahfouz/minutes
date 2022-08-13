<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
