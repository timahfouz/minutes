<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends CRUDController
{
    protected $model = 'Order';
    protected $index_route = 'admin.orders.index';
    protected $delete_route = 'admin.orders.destroy';
    
    protected $index_view = 'admin.orders.index';
    protected $edit_view = 'admin.orders.edit';

    protected $store_request = CreateRequest::class;
    protected $update_request = UpdateRequest::class;
}
