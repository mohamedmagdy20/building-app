<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecificationRequest;
use App\Http\Resources\SpecificationResource;
use App\Models\SiteSpecfication;
use Illuminate\Http\Request;

class SpecficationController extends Controller
{
    protected $model;
    public function __construct(SiteSpecfication $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return view('dashboard.specifications.index',['data'=>$this->model->latest()->get()]);
    }
    public function create()
    {
        return view('dashboard.specifications.create');
    }
    public function edit($id)
    {
        return view('dashboard.specifications.edit',['data'=>$this->model->findOrFail($id)]);
    }

    public function delete($id)
    {
        $this->model->findOrFail($id)->delete();
        return redirect()->back()->with('success','Deleted');
    }

    public function store(SpecificationRequest $request)
    {
        $data= $request->validated();
        $this->model->create($data);
        return redirect()->back()->with('success','Created');
    }

    public function update(SpecificationRequest $request,$id)
    {
        $data= $request->validated();
        $this->model->findOrFail($id)->update($data);
        return redirect()->back()->with('success','Updated');
    }

    public function getData(Request $request)
    {
        $data = SiteSpecfication::filter($request->all())->latest()->get();
        return response()->json([
            'data'=> SpecificationResource::collection($data),
            'status'=>200,
            'message'=>'success'
        ]);
    }

}
