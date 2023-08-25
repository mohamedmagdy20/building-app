<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    //
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
        $data = $this->model->latest();
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
        $data = $this->model->findOrFail($id);
        return view('dashboard.users.show',['data'=>$data]);
    }
    public function delete($id)
    {
        $this->model->findOrFail($id)->delete();
        // $this->model->forceDelete();
        return response()->json(['status'=>true]);
    }
}
