<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
     //
     protected $model;
     public function __construct(Category $model)
     {
         $this->model = $model;
     }
 
     public function index()
     {
         return view('dashboard.category.index',['data'=>$this->model->latest()->get()]);
     }
     public function create()
     {
         return view('dashboard.category.create');
     }
     public function edit($id)
     {
         return view('dashboard.category.edit',['data'=>$this->model->findOrFail($id)]);
     }
 
     public function delete($id)
     {
         $this->model->findOrFail($id)->delete();
         return redirect()->back()->with('success','Deleted');
     }
 
     public function store(CategoryRequest $request)
     {
         $data= $request->validated();
         $this->model->create($data);
         return redirect()->back()->with('success','Created');
     }
 
     public function update(CategoryRequest $request,$id)
     {
         $data= $request->validated();
         $this->model->findOrFail($id)->update($data);
         return redirect()->back()->with('success','Updated');
     }
     
 
}
