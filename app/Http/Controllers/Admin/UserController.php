<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //
    use FilesTrait;
    protected $model;
    public function __construct(User $model )
    {
        $this->model = $model;
    }
    public function index()
    {
        return view('dashboard.users.index');
    }
    public function data()
    {
        $data = $this->model->withTrashed()->latest();
        return DataTables::of($data)
        ->addColumn('action',function($data){
            return view('dashboard.users.action',['data'=>$data,'type'=>'action']);
        })
        ->editColumn('image',function($data){
            return view('dashboard.users.action',['data'=>$data,'type'=>'image']);
        })
        ->editColumn('plan_id',function($data){
            return optional($data->plan)->name;
        })
        ->editColumn('points',function($data){
            return view('dashboard.users.action',['data'=>$data,'type'=>'points']);
            
        })
        ->editColumn('account_type',function($data){
            return view('dashboard.users.action',['data'=>$data,'type'=>'account_type']);
        })
        ->addColumn('status',function($data){
            return view('dashboard.users.action',['data'=>$data,'type'=>'status']);
        })
        
        ->make(true);
    }
    public function show($id)
    {
        $data = $this->model->with('advertisment')->findOrFail($id);
        return view('dashboard.users.show',['data'=>$data]);
    }
    public function toggleActive(Request $request)
    {
        $data = $this->model->withTrashed()->findOrFail($request->id);
        if($data->deleted_at ==null)
        {
            $data->delete();
        }else{
            $data->restore();
        }
        return response()->json(['status'=>true]);
    }
    public function updatePoints(Request $request)
    {
        $data = $this->model->findOrFail($request->id);
        $data->update(['points'=>$request->points]);
        return response()->json(['status'=>true]);
    }

    public function delete($id)
    {
        $user = $this->model->withTrashed()->findOrFail($id);
        if($user->image != null)
        {
            $this->deleteFile($user->image,config('filepath.USER_PATH'));
        }
        $user->forceDelete();
        return redirect()->back()->with('success','User Deleted');
       
    }

    // public function forceDelete($id)
    // {
    //     $user = $this->model->withTrashed()->findOrFail($id);
    //     if($user->image != null)
    //     {
    //         $this->deleteFile($user->image,config('filepath.USER_PATH'));
    //     }
    //     $user->forceDelete();
    //     return redirect()->back()->with('success','User Deleted');
        
    // }
}
