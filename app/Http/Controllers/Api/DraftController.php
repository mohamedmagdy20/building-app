<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvertismentResource;
use App\Models\Advertisment;
use App\Models\Draft;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    //
    protected $model;
    public function __construct(Advertisment $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $data = $this->model->where('ads_type','draft')
        ->where('user_id',$this->auth($request->access_token)->id)->simplePaginate(7);

        return response()->json(['data'=>AdvertismentResource::collection($data),'message'=>'Success','status'=>200]);
    }

    public function update(Request $request)
    {
        $this->model->findOrFail($request->id)->update(['ads_type'=>$request->type]);
        return response()->json(['data'=>null,'message'=>'Success','status'=>200]);
    }

}
