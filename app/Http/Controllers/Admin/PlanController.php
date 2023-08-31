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
    
}
