<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Admins\CreateRequest;
use App\Http\Requests\Admin\Admins\UpdateRequest;

class AdminController extends CRUDController
{
    protected $model = 'Admin';
    protected $index_route = 'admin.admins.index';
    protected $delete_route = 'admin.admins.destroy';
    
    protected $index_view = 'admin.admins.index';
    protected $edit_view = 'admin.admins.edit';
    protected $create_view = 'admin.admins.create';

    protected $store_request = CreateRequest::class;
    protected $update_request = UpdateRequest::class;
    
}
