<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //
    protected $model;
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }
    public function index()
    {
        $data = $this->model->latest()->get();
        return view('dashboard.admins.index',['data'=>$data]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.admins.create',['roles'=>$roles]);
    }

    public function edit($id)
    {
        $data = $this->model->findOrFail($id);
        $roles = Role::all();

        return view('dashboard.admins.edit',['data'=>$data,'roles'=>$roles]);
    }
    
    public function store(AdminRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        try{
            DB::beginTransaction();
            $user =  $this->model->create($data);
            $user->assignRole($data['role_id']);   
            DB::commit();
            return redirect()->back()->with('success','Added');
        }catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function update(AdminRequest $request, $id)
    {
        $data = $request->validated();
        $user = $this->model->findOrFail($id);

        try{
            DB::beginTransaction();
            $user =  $user->update($data);
            if($request->role_id)
            {
                $user->syncRoles([$data['role_id']]);   
            }
            DB::commit();
            return redirect()->route('admin.users.index');
        }catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function delete($id)
    {
        $this->model->findOrFail($id)->delete();
        return redirect()->back()->with('success','Deleted');
    }

}
