<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;

class UserController extends CRUDController
{
    protected $model = 'User';
    protected $index_route = 'admin.users.index';
    protected $delete_route = 'admin.users.destroy';
    
    protected $index_view = 'admin.users.index';
    protected $edit_view = 'admin.users.edit';
    protected $create_view = 'admin.users.create';

    protected $store_request = CreateRequest::class;
    protected $update_request = UpdateRequest::class;
    protected $has_files = true;


    private $cities, $places, $areas;

    public function __construct()
    {
        parent::__construct();
        
        $this->places = $this->pipeline->setModel('Place')->whereNull('parent_id')->get();
        $this->cities = $this->pipeline->setModel('Place')->whereIn('parent_id', $this->places->pluck('id')->toArray())->get();
        $this->areas = $this->pipeline->setModel('Place')->whereIn('parent_id', $this->cities->pluck('id')->toArray())->get();
        
        View::share([
            'places' => $this->places,
            'cities' => $this->cities,
            'areas' => $this->areas,
        ]);
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