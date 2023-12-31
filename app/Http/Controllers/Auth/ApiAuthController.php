<?php

namespace App\Http\Controllers\Auth;
use App\Http\Resources\UserResource;
use App\Http\Utils\SMS;
use App\Models\User;
use App\Traits\FilesTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Shetabit\Visitor\Traits\Visitable;
class ApiAuthController extends Controller
{
    use FilesTrait;
    public function handleRegister(RegisterRequest $request)
    {
        $data = $request->validated();

        // $validator = Validator::make($request->all(), [
        //     'name'         => 'required|string|max:100',
        //     'email'        => 'email|unique:users,email|max:100',
        //     'password'     => 'required|confirmed|string|max:50|min:5',
        //     'phone'        => 'required|regex:/^\+965\d{6,}$/',
        //     'type'=>'required',
        //     'image'=>'file'
        // ]);
        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     return response()->json($errors,400);
        // }

        $is_user = Auth::attempt(['phone' => $request->phone, 'password' => $request->password]);
        if(! $is_user)
        {
            $data=  $request->all();
            $data['otp'] = $this->generateOtp();
            if($request->hasFile('image'))
            {
                $data['image'] = $this->saveFile($request->file('image'),config('filepath.USER_PATH'));
            }
            $data['password'] = Hash::make($request->password);
            $data['access_token'] =Str::random(64); 
            
            $user = User::create($data);

            // send SMS //
            try{
                $message =  'Your Otp is'.$user->otp;
                $sms = SMS::sendSms($user->phone,$message); 
                return response()->json([
                    'status'  => 200,
                    'message' => 'SMS Sent',
                    'data'   => NULL
                ],200);
            }catch(Exception $e )
            {
                $user->delete();
                return response()->json([
                    'status'      => 500,
                    'message'     => $e->getMessage(),
                    'access_token'=> null
                 ],500);  

            }
            
        }
        else{
            $user = User::where('phone',$request->phone)->first();
            if($user->is_verified == false)
            {
                return response()->json([
                    'status'  => 400,
                    'message' => "Account Already exist but Not verified",
                    'data'    => $user->phone
               ],400);
            }else{
                return response()->json([
                    'status'  => 400,
                    'message' => "Account Already exsit",
                    'data'    => NULL
               ],400);
            }
            
        }
    }
    public function handleLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'    => 'required',
            'password' => 'required|string|max:50|min:5',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $is_user = Auth::attempt(['phone' => $request->phone, 'password' => $request->password]);

        if(! $is_user)
        {
            // visitor()->visit();

            return response()->json([
                'status'=> 404,
                'message'=> "credentials are not correct",
                'data'=> NULL
            ]);
        }

        $user = User::where('phone', '=', $request->phone)->with('plan')->first();
        if($user->is_verified == false)
        {
            return response()->json([
                'status'  => 400,
                'message' => "Account Already exist But Not verified",
                'data'    => $user->phone
           ],400);
        }else{
            $user->update(['notification_token'=>$request->notification_token]);
            $new_access_token = Str::random(64);
            $user->update([
                'access_token' => $new_access_token
            ]);
            // $userData = User::where('email', '=', $request->p)->with('plan')->first();
            
            $data = new UserResource($user);
            return response()->json([
                'status'=>200,
                'message'=>'LOGGED IN SUCCESSFULY',
                'data'=> $data
            ]);
        }
       
    }
    public function logout(Request $request)
    {
        $access_token = $request->header('access_token');
        $user = User::where('access_token', $access_token)->first();
        if($user == null) {
            return response()->json([
                'status'=> '403',
                'message'=> 'This Token Are Not Correct',
                'data'=> NULL
            ],403);
        }
        $user->update([
            'access_token' => NULL,
            'notification_token'=>NULL
        ]);
        return response()->json([
            'status'  => '200',
            'message' => 'Logged Out Successfully',
            'data'   => NULL
        ]);
    }

    public function verify(Request $request)
    {
        $user = User::where('otp',$request->otp)->first();
        if($user)
        {
            $user->update([
                'is_verified'=>true,
                'otp'=>null
            ]);
            return response()->json([
                'status'  => 200,
                'message' => 'Account Verified',
                'data'   => new UserResource($user)
            ],200);  
        }else{
            return response()->json([
                'status'  => 400,
                'message' => 'Invaild Otp',
                'data'   => NULL
            ],400);    
        }
    }

    public function resend(Request $request)
    {
        $otp = $this->generateOtp();
        $user = User::where('phone',$request->phone)->first();
        if($user)
        {
            $user->update([
                'otp'=>$otp,
            ]);
            try{
                $message =  'Your Otp is'.$user->otp;
                $sms = SMS::sendSms($user->phone,$message); 
                return response()->json([
                    'status'  => 200,
                    'message' => 'SMS Sent',
                    'data'   => NULL
                ],200);
            }catch(Exception $e )
            {
                
                return response()->json([
                    'status'      => 500,
                    'message'     => $e->getMessage(),
                    'access_token'=> null
                 ],500);  
                
            }
           
        }else{
            return response()->json([
                'status'  => 404,
                'message' => 'User Not Found',
                'data'   => NULL
            ],404);    
        }
    }

    public function changePassword(ForgetPasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::findOrFail($data['id']);
        $user->update([
            'password'=>Hash::make($data['password'])
        ]);
        return response()->json([
            'status'  => 200,
            'message' => 'Password Changed Successfuly',
            'data'   => NULL
        ]);    
    }
    private function generateOtp()
    {
        $otp = rand(10000,99999);
        return $otp;
    }
}
