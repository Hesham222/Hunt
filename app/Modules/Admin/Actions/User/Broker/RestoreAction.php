<?php
namespace Admin\Actions\User\Broker;;
use Illuminate\Http\Request;
use Admin\Models\{
    Broker
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Broker::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
