<?php
namespace Admin\Actions\User\Broker;
use Illuminate\Http\Request;
use Admin\Models\{
    Broker
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Broker::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
