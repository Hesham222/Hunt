<?php
namespace Admin\Actions\Notification;
use Illuminate\Http\Request;
use Admin\Models\{
    Notification
};
class UnsendAction
{
    public function execute(Request $request)
    {
        $record = Notification::find($request->resource_id);
        if(!$record)
            return false;
        $record->delete();
        return $request->resource_id;
    }
}
