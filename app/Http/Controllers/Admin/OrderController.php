<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\View;
use App\Http\Requests\Admin\Orders\UpdateRequest;

class OrderController extends CRUDController
{
    protected $model = 'Order';
    protected $index_route = 'admin.orders.index';
    protected $delete_route = 'admin.orders.destroy';
    
    protected $index_view = 'admin.orders.index';
    protected $edit_view = 'admin.orders.edit';
    
    protected $update_request = UpdateRequest::class;

    private $carriers;

    public function __construct()
    {
        parent::__construct();
        
        $this->carriers = $this->pipeline->setModel('Carrier')->get();
        
        View::share('carriers', $this->carriers);
    }
}
