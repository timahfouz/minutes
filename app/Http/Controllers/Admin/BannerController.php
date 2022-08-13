<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\Banners\CreateRequest;
use App\Http\Requests\Admin\Banners\UpdateRequest;


class BannerController extends CRUDController
{
    protected $model = 'Banner';
    protected $index_route = 'admin.banners.index';
    protected $delete_route = 'admin.banners.destroy';
    
    protected $index_view = 'admin.banners.index';
    protected $edit_view = 'admin.banners.edit';
    protected $create_view = 'admin.banners.create';

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