<?php
namespace Admin\Actions\Comment;;
use Illuminate\Http\Request;
use Admin\Models\{
    Comment
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Comment::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
