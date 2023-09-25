<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotifcationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Notification::where('user_id',$this->auth($request->access_token)->id)->latest()->simplePaginate(7);
        // return $data;
        return response()->json([
            'data'=>NotifcationResource::collection($data),
            'status'=>200,
            'message'=>'success'
        ]);
    }
}
