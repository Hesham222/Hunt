<?php
namespace Admin\Http\Controllers\Notification;
use App\Http\Controllers\Controller;

class NewFirebaseController extends Controller
{
    public function sendIOSNotification($tokens,$json,$data)
    {
        if (is_array($tokens))
            $tokenIds = $tokens;
        else
            $tokenIds = [$tokens];

        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AAAAiM57JHA:APA91bGoJ4Ga6rGibyYFerxTnSVa_8LZWmb6HzN8o0HCSx0M8YT8IRHZTgDpuKhVvbYiN4uOauqnpblAJkNaGZGUpERmFAepd7LVuxToVgRwKuCduQcBYLBovz7PG_Vv7PBx_R5S44a5';
        $arrayToSend = array('content_available' => true, 'registration_ids' => $tokenIds,'data' => $data,'notification' => $json,'priority'=>'high');
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayToSend));
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Send the request
        $result = curl_exec($ch);
        if ($result === FALSE)
        {
            die('FCM Send Error: ' . curl_error($ch));
        }
        $result = json_decode($result,true);
        //Close request
        curl_close($ch);
        $response['firebase'] = $result;
        $response['json'] = $arrayToSend;
        return $response;
        //return $result;
    }

    public function fillIOSJson($title,$body)
    {
        $json['title'] = $title;
        $json['body'] = $body;
        $json['sound'] = 'default';
        return $json;
    }

    public function sendAndroidNotification($tokens,$json)
    {
        if (is_array($tokens))
            $tokenIds = $tokens;
        else
            $tokenIds = [$tokens];

        define('SERVER_KEY', 'AAAAiM57JHA:APA91bGoJ4Ga6rGibyYFerxTnSVa_8LZWmb6HzN8o0HCSx0M8YT8IRHZTgDpuKhVvbYiN4uOauqnpblAJkNaGZGUpERmFAepd7LVuxToVgRwKuCduQcBYLBovz7PG_Vv7PBx_R5S44a5' );

        $fields = array
        (
            'registration_ids'  => $tokenIds,
            'data' => $json
        );

        $headers = array
        (
            'Authorization: key=' . SERVER_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch );

        if ($result === FALSE)
        {
            die('FCM Send Error: ' . curl_error($ch));
        }

        $result = json_decode($result,true);
        curl_close( $ch );

        $response['firebase'] = $result;
        $response['json'] = $fields;
        return $response;
    }

    public function fillAndroidJson($data)
    {
        $json =  array();
        $json['title'] = $data['title'];
        $json['body'] = $data['message'];
        $json['type'] = intval($data['type']);
        $json['id'] = intval($data['order']);
        $json['searchKey'] = $data['searchKey'];
        return $json;
    }
}
