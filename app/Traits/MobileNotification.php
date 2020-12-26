<?php

namespace App\Traits;


trait MobileNotification
{
    public function sendNotification(array $data)
    {
        $token = $this->fcm_token;
        $device_info = $this->deviceInfo($token);
        $device_type = isset($device_info->platform) ? $device_info->platform : null;
        if ($device_type == 'IOS') {
            $this->sendIOSNotification($data);
        } else if ($device_type == 'ANDROID') {
            $this->sendAndroidNotification($data);
        }
    }

    protected function sendIOSNotification(array $data)
    {

        $token = $this->fcm_token;
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $extraNotificationData = [
            'type' => $data['type'],
            "shop_id" => (isset($data['shop_id']) ? $data['shop_id'] : 0),
            "id" => $data['id']
        ];

        $notification = [
            'title' => @$data['title'],
            'body' => @$data['description'],
            "icon" => "myicon"
        ];

        $fcmNotification = [
            'to' => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
        $headers = [
            'Authorization: key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    protected function sendAndroidNotification(array $data)
    {
        $token = $this->fcm_token;
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $extraNotificationData = [
            'text' => $data['title'],
            'body' => $data['description'],
            'type' => $data['type'],
            "shop_id" => (isset($data['shop_id']) ? $data['shop_id'] : 0),
            "id" => $data['id']
        ];

        $fcmNotification = [
            'to' => $token, //single token
            'data' => $extraNotificationData
        ];
        $headers = [
            'Authorization: key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    protected function deviceInfo($token)
    {
        $url = 'https://iid.googleapis.com/iid/info/' . $token . '?details=true';
        $headers = [
            'Authorization: key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        return $result;
    }


}
