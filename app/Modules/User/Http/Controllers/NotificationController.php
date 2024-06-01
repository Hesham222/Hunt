<?php

namespace User\Http\Controllers;
use Illuminate\Http\Request;
use Admin\Actions\Notification\FilterAction;
use User\Http\Resources\{
    Notification\NotificationCollection,
    Notification\NotificationResource,
    PaginationResource
};

class NotificationController extends BaseResponse
{
    public function index(Request $request, FilterAction $getData)
    {
        $user = auth($request->input('activeGuard'))->user();
        $records = $getData->execute($request)
            ->orderBy('id','DESC')
            ->where('type','all')
            ->when($request->input('activeGuard') == 'individualApi' , function ($query) use ($request) {
                return $query->orWhere('type','individuals');
            })
            ->when($request->input('activeGuard') == 'individualApi' , function ($query) use ($request, $user) {
                return $query->orWhere('specific_type','individuals')->whereJsonContains('users',"$user->id");
            })
            ->when($request->input('activeGuard') == 'brokerApi' , function ($query) use ($request) {
                return $query->orWhere('type','brokers');
            })
            ->when($request->input('activeGuard') == 'brokerApi' , function ($query) use ($request, $user) {
                return $query->orWhere('specific_type','brokers')->whereJsonContains('users',"$user->id");
            })
            ->when($request->input('activeGuard') == 'developerApi' , function ($query) use ($request) {
                return $query->orWhere('type','developers');
            })
            ->when($request->input('activeGuard') == 'developerApi' , function ($query) use ($request, $user) {
                return $query->orWhere('specific_type','developers')->whereJsonContains('users',"$user->id");
            })

            ->take(100)->get();
        return $this->response(200, 'List Notifications', 200, [], 0, [
            'notifications'   => new NotificationCollection($records),
        ]);
    }

}
