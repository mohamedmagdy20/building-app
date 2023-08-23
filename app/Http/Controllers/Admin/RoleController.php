<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    protected $model;
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
    public function index()
    {
        $data =$this->model->all();
        return view('dashboard.roles.index',['data'=>$data]);
    }
}

