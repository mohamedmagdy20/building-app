<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotifcationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $data = Notification::where('user_id',auth()->user()->id)->latest()->simplePaginate(7);
        return response()->json([
            'data'=>new NotifcationResource($data),
            'status'=>200,
            'message'=>'success'
        ]);
    }
}
