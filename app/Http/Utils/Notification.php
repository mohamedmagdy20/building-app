<?php

namespace App\Http\Utils;
class Notification{
    public static function send($type,$id,$token){
        
        $SERVER_API_KEY = config('app.FCM_KEY');

        $message = $type == 'accept' ? 'Congratulations, your advertisement request has been approved' : 'Unfortunately, your request to publish the advertisement has been rejected. Please try again';
        $data = [
    
            "to" => [
                $token
            ],
    
            "notification" => [
    
                "title" => 'Alfreeg',
    
                "body" =>$message ,
    
                "sound"=> "default" // required for sound on ios
    
            ],
    
        ];
    
        $dataString = json_encode($data);
    
        $headers = [
    
            'Authorization: key=' . $SERVER_API_KEY,
    
            'Content-Type: application/json',
    
        ];
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    
        curl_setopt($ch, CURLOPT_POST, true);
    
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    
        $response = curl_exec($ch);

        \App\Models\Notification::create([
            'user_id'=>$id,
            'type'=>$type,
            'message'=>$message
        ]);
        return $response;
    

    }
}