<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Utils\Notification;
use App\Models\Advertisment;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdvertismentController extends Controller
{
    use FilesTrait;
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
        $data = $this->model->withTrashed()->with('category')->with('user')->with('area')->filter($request->all())->latest();
        if(! auth()->user()->hasRole('SuperAdmin'))
        {
            $data->where('ads_type','!=','draft');
        }
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
        ->editColumn('is_expire',function($data){
            return view('dashboard.advertisments.action',['type'=>'is_expire','data'=>$data]);
        })
        ->addColumn('image',function($data){
            return view('dashboard.advertisments.action',['type'=>'image','data'=>$data]);  
        })
        ->make(true);
    }

    public function accept(Request $request)
    {
        $data =  $this->model->findOrFail($request->id);
        $result =  $this->notification->send('accept',$data->user->id,$data->user->notification_token,$data->id);
        $data->update(['abroved'=>true]);
        return response()->json(['status'=>true,'result'=>$result]);
    }

    public function block(Request $request)
    {
        $data =  $this->model->findOrFail($request->id);
        $this->notification->send('reject',$data->user->id,$data->user->notification_token,$data->id);

        foreach($data->adsImage as $item)
        {
            $this->deleteFile($item->image,config('filepath.ADS_PATH'));
        }
        $data->delete();        

        return response()->json(['status'=>true]);
    }

    public function show($id)
    {
        $data = $this->model->findOrFail($id);
        return view('dashboard.advertisments.show',['data'=>$data]);
    }

    public function forceDelete($id)
    {
        $data = $this->model->withTrashed()->findOrFail($id);
        if($data->adsImage !=null)
        {
            foreach($data->adsImage as $item)
            {
                $this->deleteFile($item->image,config('filepath.ADS_PATH'));
            }
        }
        $data->forceDelete();
        return redirect()->back()->with('success','Deleted');
    }
}
