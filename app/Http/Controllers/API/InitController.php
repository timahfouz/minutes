<?php

namespace App\Http\Controllers\API;

use App\Pipelines\Pipeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InitController extends Controller
{
    protected $pipeline;
    
    public function __construct()
    {
        $this->pipeline = new Pipeline();
    }
}
