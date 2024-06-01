<?php
namespace Admin\Actions\Notification;
use Illuminate\Http\Request;
use Admin\Models\{
    Notification
};
class StoreAction
{
    public function execute(Request $request): void
    {
        $users = [];
        $users = ($request->input('specific_users'))?  $users [] = $request->input('selected_specific_users') : null ;
        $record =  Notification::create([
            'title'         => $request->input('title'),
            'message'       => $request->input('message'),
            'type'          => $request->input('type'),
            'specific_type' => $request->input('specific_users'),
            'users'         => $users ? json_encode( $users) : $users,
            'created_by'    => auth('admin')->user()->id,
        ]);
    }
}
