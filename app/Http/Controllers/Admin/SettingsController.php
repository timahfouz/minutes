<?php

namespace App\Http\Controllers\Admin;

use App\Pipelines\Pipeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingsRequest;
use App\Http\Requests\Admin\Settings\UpdateRequest;

class SettingsController extends Controller
{
    protected $pipeline;

    public function __construct()
    {
        $this->pipeline = app(Pipeline::class)->setModel('Setting');
    }

    public function index(Request $request)
    {
        $data = array_flip($this->pipeline->pluck('key','value')->toArray());
        
        return view('admin.settings.index')->with($data);
    }
    
    
    public function update(SettingsRequest $request)
    {
        \DB::beginTransaction();
        try {
            $this->pipeline->delete();
            foreach($request->except('_token') as $key => $value) {
                $data[] = [
                    'key' => $key,
                    'value' => $value,
                ];
            }
            
            $this->pipeline->insert($data);
            \DB::commit();
        } catch(\Exception $ex) {
            \DB::rollback();
        }
        return redirect()->back()->with($data);
    }
}
