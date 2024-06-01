<?php

namespace Admin\Http\Controllers\Notification;

class SendPushNotificationController
{
    public function sendAndroidNotification($data, $userTokens)
    {
        $newFirebaseInstance = new NewFirebaseController();
        $json = $newFirebaseInstance->fillAndroidJson($data);
        return $newFirebaseInstance->sendAndroidNotification($userTokens,$json);
    }

    public function sendIosNotification($data, $userTokens)
    {
        $newFirebaseInstance = new NewFirebaseController();
        $json = $newFirebaseInstance->fillIOSJson($data['title'],$data['message']);
        return $newFirebaseInstance->sendIOSNotification($userTokens,$json,$data);
    }
}
