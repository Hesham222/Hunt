<?php
namespace Admin\Actions\AccountReport;;

use Illuminate\Http\Request;
use Admin\Models\Reports\{
    AccountReport
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = AccountReport::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
