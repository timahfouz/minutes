<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends CRUDController
{
    public function __invoke(Request $request)
    {
        $data = [
            'admins' => $this->pipeline->setModel('Admin')->count(),
            'orders' => $this->pipeline->setModel('Order')->count(),
            'products' => $this->pipeline->setModel('Product')->count(),
            'messages' => $this->pipeline->setModel('ContactUs')->count(),
        ];
        return view('admin.home')->with($data);
    }

}
