<?php
namespace Admin\Actions\User\Broker;
use Admin\Http\Controllers\Notification\SendPushNotificationController;
use Admin\Models\Broker;
use Illuminate\Http\Request;
class PushNotificationAction
{
    public function execute(Request $request): void
    {
        $data  =
        [
            'title'   => $request->input('title') ,
            'message' => $request->input('message'),
        ];

        $sendNotify = new SendPushNotificationController();

        Broker::where('deviceType', '!=', 'IOS')->whereNotNull('firebaseToken')->when($request->input('users'), function ($query) use ($request) {
            return $query->where('id', $request->input('users'));
        })->chunk(500, function ($users) use ($sendNotify,$data) {
            $sendNotify->sendAndroidNotification($data, $users->pluck('firebaseToken')->toArray());
        });

        Broker::where('deviceType', 'IOS')->whereNotNull('firebaseToken')->when($request->input('users'), function ($query) use ($request) {
            return $query->where('id', $request->input('users'));
        })->chunk(500, function ($users) use ($sendNotify, $data) {
            $sendNotify->sendIosNotification($data,$users->pluck('firebaseToken')->toArray());
        });
    }

}
