<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Admin\Products\CreateRequest;
use App\Http\Requests\Admin\Products\UpdateRequest;

class ProductController extends CRUDController
{
    protected $model = 'Product';
    protected $index_route = 'admin.products.index';
    protected $delete_route = 'admin.products.destroy';
    
    protected $index_view = 'admin.products.index';
    protected $edit_view = 'admin.products.edit';
    protected $create_view = 'admin.products.create';

    protected $store_request = CreateRequest::class;
    protected $update_request = UpdateRequest::class;
    protected $has_files = true;

    public function __construct()
    {
        parent::__construct();

        $categories = $this->pipeline->setModel('Category')->get();
        View::share('categories', $categories);
    }

    
    protected function storeData($request, &$data)
    {
        $imagePath = resizeImage($request->image, 'uploads', [200, 200]);
        $image = $this->pipeline->setModel('Media')->create([
            'path' => $imagePath
        ]);

        $data['image_id'] = $image->id;
    }

    protected function updateData($request, &$data, $item)
    {
        $imagePath = resizeImage($request->image, 'uploads', [200, 200]);
        $image = $this->pipeline->setModel('Media')->create([
            'path' => $imagePath
        ]);

        $data['image_id'] = $image->id;
    }
}