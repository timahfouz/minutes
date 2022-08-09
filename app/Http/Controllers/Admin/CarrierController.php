<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Carriers\CreateRequest;
use App\Http\Requests\Admin\Carriers\UpdateRequest;

class CarrierController extends CRUDController
{
    protected $model = 'Carrier';
    protected $index_route = 'admin.carriers.index';
    protected $delete_route = 'admin.carriers.destroy';
    
    protected $index_view = 'admin.carriers.index';
    protected $edit_view = 'admin.carriers.edit';
    protected $create_view = 'admin.carriers.create';

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
