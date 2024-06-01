<?php
namespace Admin\Actions\User\Developer;;
use Illuminate\Http\Request;
use Admin\Models\{
    Developer
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Developer::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
