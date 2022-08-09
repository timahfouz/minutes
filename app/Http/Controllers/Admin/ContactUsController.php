<?php

namespace App\Http\Controllers\Admin;

use App\Pipelines\Pipeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    protected $pipeline;
    protected $model;

    public function __construct()
    {
        $this->pipeline = app(Pipeline::class);
        $this->model = $this->pipeline->setModel('ContactUs');

    }

    public function index()
    {
        $items = $this->model->get();
        $delte_route = 'admin.messages.destroy';

        return view('admin.messages.index', compact('items','delte_route'));
    }
    
    public function destroy($id)
    {
        $this->model->where('id', $id)->delete();

        return redirect()->route('admin.messages.index');
    }
}
