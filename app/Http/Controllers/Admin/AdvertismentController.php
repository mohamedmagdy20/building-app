<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Utils\Notification;
use App\Models\Advertisment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdvertismentController extends Controller
{
    //
    public $model;
    public $notification;
    public function __construct(Advertisment $model, Notification $notification)
    {
        $this->model = $model;
        $this->notification = $notification;
    }
    public function index()
    {
        return view('dashboard.advertisments.index');
    }


    public function data(Request $request)
    {
        $data = $this->model->with('category')->with('user')->with('area')->filter($request->all())->latest();
        return DataTables::of($data)
        ->addColumn('action',function($data){
            return view('dashboard.advertisments.action',['type'=>'action','data'=>$data]);
        })
        ->editColumn('ads_type',function($data){
            return view('dashboard.advertisments.action',['type'=>'ads_type','data'=>$data]);
        })
        ->editColumn('abroved',function($data){
            return view('dashboard.advertisments.action',['type'=>'abroved','data'=>$data]);
        })
        ->addColumn('image',function($data){
            return view('dashboard.advertisments.action',['type'=>'image','data'=>$data]);  
        })
        ->make(true);
    }

    public function accept(Request $request)
    {
        $user =  $this->model->findOrFail($request->id);
        $user->update(['abroved'=>true]);
        $this->notification->send('accept',$request->id,$user->notification_token);
        return response()->json(['status'=>true]);
    }

    public function block(Request $request)
    {
        $user =  $this->model->findOrFail($request->id);
        $user->update(['abroved'=>false]);
        $this->notification->send('reject',$request->id,$user->notification_token);
        
        return response()->json(['status'=>true]);
    }

    public function show($id)
    {
        $data = $this->model->findOrFail($id);
        return view('dashboard.advertisments.show',['data'=>$data]);
    }


}
