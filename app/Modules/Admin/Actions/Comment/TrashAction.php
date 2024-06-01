<?php
namespace Admin\Actions\Comment;
use Illuminate\Http\Request;
use Admin\Models\{
    Comment
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Comment::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
