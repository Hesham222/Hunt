<?php
namespace Admin\Actions\PostReport;;

use Illuminate\Http\Request;
use Admin\Models\Reports\{
    PostReport
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = PostReport::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
