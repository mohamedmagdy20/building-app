<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Imports\AreaImport;
use App\Models\Area;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AreaController extends Controller
{
    //
    protected $model;
    public function __construct(Area $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return view('dashboard.areas.index',['data'=>$this->model->latest()->get()]);
    }
    public function create()
    {
        return view('dashboard.areas.create');
    }
    public function edit($id)
    {
        return view('dashboard.areas.edit',['data'=>$this->model->findOrFail($id)]);
    }

    public function delete($id)
    {
        $this->model->findOrFail($id)->delete();
        return redirect()->back()->with('success','Deleted');
    }

    public function store(AreaRequest $request)
    {
        $data= $request->validated();
        $this->model->create($data);
        return redirect()->back()->with('success','Created');
    }

    public function update(AreaRequest $request,$id)
    {
        $data= $request->validated();
        $this->model->findOrFail($id)->update($data);
        return redirect()->back()->with('success','Updated');
    }

    public function uploadAreas(Request $request)
    {
        $request->validate(['file'=>'required|file']);
        if($request->hasFile('file'))
        {
            Excel::import(new AreaImport, $request->file);
            return redirect()->route('admin.areas.index')->with('success', 'Areas Uploaded');
        }
    }
    
}
