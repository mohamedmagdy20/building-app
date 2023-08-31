<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    //
    protected $model;
    public function __construct(Plan $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $data = $this->model->latest()->get();
        return view('dashboard.plans.index',['data'=>$data]);
    }
    public function Addplan()
    {
     return view('dashboard.plans.create');
    }
    public function storeplan(Request $request)
    {
     $request->validate([
        'num_ads'     => 'required|numeric',
        'num_days'    => 'required|numeric',
        'price'       => 'required|numeric',
        'is_permium'  => 'required|numeric',
        'description' => 'required|string',

    ]);
     $book = Plan::create([
        'num_ads'     => $request->num_ads,
        'num_days'    => $request->num_days,
        'price'       => $request->price,
        'is_permium'  => $request->is_permium,
        'description' => $request->description,
    ]);
     return redirect( route('admin.plans.index') )->with('success','Added');
    }
    public function Editplan($id)
    {
     $Advertise = Plan::findOrFail($id);
     return view('dashboard.plans.edit',compact('Advertise'));
    }
    public function updateplan(Request $request, $id)
    {
     $Advertise = Plan::findOrFail($id);
     $Advertise->update([
        'num_ads'     => $request->num_ads,
        'num_days'    => $request->num_days,
        'price'       => $request->price,
        'is_permium'  => $request->is_permium,
        'description' => $request->description,
     ]);
     return redirect( route('admin.plans.index', $id) )->with('success','Updated');
    }
    public function Deleteplan($id)
    {
     $Plan = Plan::findOrFail($id);
     $Plan->delete();
     return redirect( route('admin.plans.index') )->with('success','Deleted');
    }

}
