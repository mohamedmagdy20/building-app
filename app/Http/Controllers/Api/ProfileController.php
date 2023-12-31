<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\PlanResource;
use App\Http\Resources\UserResource;
use App\Models\Plan;
use App\Models\User;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    use FilesTrait;
    public $model;
    public function __construct(User $model)
    {
        $this->model =$model;
    }

    /**
     * User Profile 
     */
    public function profile(Request $request)
    {
       return response()->json([
            'data'=>new UserResource($this->auth($request->access_token)),
            'status'=>true,
            'message'=>'success'
       ]);
    }

    /**
     * Update User Profile 
     */
    public function update(UserRequest $request)
    {
        $data = $request->validated();
        $user = $this->model->findOrFail($this->auth($request->access_token)->id);
        
        if($request->hasFile('image'))
        {
            $data['image'] = $this->updateFile($request->file('image'),$user->image,config('filepath.USER_PATH'));
        }
        $user->update($data);
        return response()->json([
            'message'=>'Profile Updated',
            'status'=>200,
            'data'=>new UserResource($user)
        ]);
    }


    // public function 
    public function index(Request $request)
    {
        $data = Plan::filter($request->all())->get();
        return response()->json(
            [
                'data'=>PlanResource::collection($data),
                'message'=>'Success',
                'status'=>200
            ]
            );
    }
    
    public function userPoint(Request $request)
    {
        $user = $this->model->find($this->auth($request->access_token)->id);
        return response()->json([
            'data'=>$user->points,
            'status'=>200,
            'message'=>'success'
        ]);
    }
    
    public function deleteAccount(Request $request)
    {
        $user = $this->model->find($this->auth($request->access_token)->id);
        if($user)
        {
            $user->forceDelete();
            return response()->json([
               'data'=>null,
               'status'=>200,
               'message'=>'Account Deleted'
            ]);
        }else{
            return response()->json([
               'data'=>null,
               'status'=>404,
               'message'=>'User Not Found'
            ],404);
        }
    
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = $this->model->findOrFail($this->auth($request->access_token)->id);
        if(Hash::check($user->password,$data['old_password']))
        {
            $user->update([
                'password'=>Hash::make($data['password'])
            ]);
            return response()->json([
                'data'=>NULL,
                'status'=>200,
                'message'=>'Password Changed'
            ]);
        }else{
            return response()->json([
                'data'=>NULL,
                'status'=>400,
                'message'=>'Invaild Old Password'
            ],400);
        }
    }
    
}
