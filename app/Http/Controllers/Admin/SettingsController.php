<?php

namespace App\Http\Controllers\Admin;

use App\Pipelines\Pipeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;

class SettingsController extends Controller
{
    protected $pipeline;
    protected $model;

    public function __construct()
    {
        $this->pipeline = app(Pipeline::class);
        $this->model = $this->pipeline->setModel('Setting');

    }

    public function index()
    {
        $items = $this->model->get();
        $content = $items->where('key','content')->first()->value ?? null;
        $image = getImagePath($items->where('key','image')->first()->value ?? null);
        $video = getVideoPath($items->where('key','video')->first()->value ?? null);
        
        return view('admin.settings.index', compact('items','content','image','video'));
    }
    
    public function update(SettingsRequest $request)
    {
        $content = $request->content;
        $image = null;
        
        $data = [[
            'key' => 'content',
            'value' => $content
        ]];

        if($request->hasFile('image')) {
            $this->model->where('key', 'content')->orWhere('key', 'image')->delete();

            if ($request->hasFile('image')) {
                $image = uploadFile($request->image, 'images');
            }
            
            if($request->hasFile('image')) {
                $data[] = [
                    'key' => 'image',
                    'value' => $image
                ];
            }
            
            $this->model->insert($data);
        } else {
            $this->model->where('key', 'content')->updateOrCreate([
                'key' => 'content',
                'value' => $content
            ]);
        }
        return redirect()->route('admin.settings.index');
    }
}
