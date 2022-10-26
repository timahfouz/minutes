<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Offers\CreateRequest;
use App\Http\Requests\Admin\Offers\UpdateRequest;
use Illuminate\Support\Facades\View;

class OfferController extends CRUDController
{
    protected $model = 'Offer';
    protected $index_route = 'admin.offers.index';
    protected $delete_route = 'admin.offers.destroy';
    
    protected $index_view = 'admin.offers.index';
    protected $edit_view = 'admin.offers.edit';
    protected $create_view = 'admin.offers.create';

    protected $store_request = CreateRequest::class;
    protected $update_request = UpdateRequest::class;

    public function __construct()
    {
        parent::__construct();

        $products = $this->pipeline->setModel('Product')->get();
        View::share('products', $products);
    }

    public function store()
    {
        $request = app($this->store_request);

        $data = $request->validated();
        
        $data['type'] = $data['is_offer_expired'] ? 'daily' : 'products';

        $data['category_id'] = $this->pipeline->setModel('Product')
            ->find($data['product_id'])
            ->category_id;
        
        $this->pipeline->setModel($this->model)->create($data);

        return redirect()->route($this->index_route);
    }

    public function update($id)
    {
        $request = app($this->update_request);
        
        $data = $request->validated();

        $obj = $this->pipeline->setModel($this->model)->findOrFail($id);
        
        $data['type'] = $data['is_offer_expired'] ? 'daily' : 'products';
        
        $data['category_id'] = $this->pipeline->setModel('Product')
            ->find($data['product_id'])
            ->category_id;

        $obj->update($data);

        return redirect()->route($this->index_route);
    }
}