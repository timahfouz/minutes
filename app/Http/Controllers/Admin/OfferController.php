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
}