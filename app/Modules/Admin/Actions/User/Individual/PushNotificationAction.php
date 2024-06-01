<?php
namespace Admin\Actions\User\Individual;
use Admin\Http\Controllers\Notification\SendPushNotificationController;
use Illuminate\Http\Request;
use Admin\Models\Individual;
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

        Individual::where('deviceType', '!=', 'IOS')->whereNotNull('firebaseToken')->when($request->input('users'), function ($query) use ($request) {
            return $query->where('id', $request->input('users'));
        })->chunk(500, function ($users) use ($sendNotify,$data) {
            $sendNotify->sendAndroidNotification($data, $users->pluck('firebaseToken')->toArray());
        });

        Individual::where('deviceType', 'IOS')->whereNotNull('firebaseToken')->when($request->input('users'), function ($query) use ($request) {
            return $query->where('id', $request->input('users'));
        })->chunk(500, function ($users) use ($sendNotify, $data) {
            $sendNotify->sendIosNotification($data,$users->pluck('firebaseToken')->toArray());
        });
    }

}
