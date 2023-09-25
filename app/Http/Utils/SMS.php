<?php

namespace App\Http\Utils;

use Illuminate\Support\Facades\Http;

class SMS{

    public static function sendSms($mobile, $lang,$message)
    {
        $request = Http::post('https://www.kwtsms.com/API/send/',
        [
            'username'=>config('app.SMS_USERNAME'),
            'password'=>config('app.SMS_PASSWORD'),
            'sender'=>config('app.SMS_SENDER'),
            'mobile'=>$mobile,
            'lang'=>$lang,
            'message'=>$message
        ]);
        if($request->ok())
        {
            return true;
        }else{
            return $request->body();
        }
    }
}