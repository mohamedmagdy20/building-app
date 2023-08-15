<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\PlanResource;
use App\Http\Resources\UserResource;
use App\Models\Plan;
use App\Models\User;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;

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
    
}
