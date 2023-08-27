<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    use FilesTrait;
    protected $model;
    public function __construct(Setting $model)
    {
        $this->model =$model;
    }

    public function index()
    {
        $data = $this->model->all();
        return view('dashboard.settings.index',['data'=>$data]) ;
    }

    public function update(Request $request)
    {
        $data = $this->model->all();
       
        if($request->hasFile('logo'))
        {
            $image = $this->saveFile($request->file('logo'),'uploads/logo/');
            $data[0]->update(['value'=>$image]);
        }        
        if($request->hasFile('splach'))
        {
            $image = $this->saveFile($request->file('splach'),'uploads/splach/');
            $data[1]->update(['value'=>$image]);
        }
        return redirect()->back()->with('success','Updated');
    }

    public function getSplach()
    {
        $data = $this->model->findOrFail(2);
        return response()->json([ 'status'=>200,'message'=>'Successfully Retrieved Data','data'=>new SettingResource($data) ]);
    }
}
