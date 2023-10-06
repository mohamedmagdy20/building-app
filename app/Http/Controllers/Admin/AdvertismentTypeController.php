<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsType;
use Illuminate\Http\Request;

class AdvertismentTypeController extends Controller
{
    //
    protected $model;
    public function __construct(AdsType $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $data = $this->model->all();
        return view('dashboard.ads-type.index',['data'=>$data]);
    }

    public function updatePoint(Request $request)
    {
        $data = $this->model->find($request->id);
        $data->update([
            'point'=>$request->point
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'Price Updated'
        ]);
    }

}
