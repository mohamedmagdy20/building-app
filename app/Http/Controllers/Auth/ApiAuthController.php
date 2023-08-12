<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\FilesTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Shetabit\Visitor\Traits\Visitable;
class ApiAuthController extends Controller
{
    use FilesTrait;
    public function handleRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email|max:100',
            'password'     => 'required|confirmed|string|max:50|min:5',
            'phone'        => 'required|string|max:100',
            'type'=>'required',
            'image'=>'image'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }
        $is_user = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if(! $is_user)
        {

            if($request->hasFile('image'))
            {
                $imageName = $this->saveFile($request->file('image'),config('filepath.USER_PATH'));
            }
            
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'phone'    => $request->phone,
                'access_token' => Str::random(64),
                'image'=>$imageName,
                'type'=>$request->type,
                'account_type'=>$request->account_type
            ]);
            return response()->json([
                'status'      => 200,
                'message'     => $request->name . ' ' .'added succesfully',
                'access_token'=> $user->access_token
            ]);
        }
        else{
            return response()->json([
                 'status'  => 404,
                 'message' => "Email Already exsit",
                 'data'    => NULL

            ]);
        }
    }
    public function handleLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|max:100',
            'password' => 'required|string|max:50|min:5',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $is_user = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if(! $is_user)
        {
            // visitor()->visit();

            return response()->json([
                'status'=> 404,
                'message'=> "credentials are not correct",
                'data'=> NULL
            ]);
        }
        $user = User::where('email', '=', $request->email)->first();
        $new_access_token = Str::random(64);
        $user->update([
            'access_token' => $new_access_token
        ]);
        $userData = User::where('email', '=', $request->email)->first();
        $data = new UserResource($userData);
        return response()->json([
            'status'=>200,
            'message'=>'LOGGED IN SUCCESSFULY',
            'data'=> $data
        ]);
    }
    public function logout(Request $request)
    {
        $access_token = $request->header('access_token');
        $user = User::where('access_token', $access_token)->first();
        if($user == null) {
            return response()->json([
                'status'=> '404',
                'message'=> 'This Token Are Not Correct',
                'data'=> NULL
            ]);
        }
        $user->update([
            'access_token' => NULL
        ]);
        return response()->json([
            'status'  => '200',
            'message' => 'Logged Out Successfully',
            'data'   => NULL
        ]);
    }
}
