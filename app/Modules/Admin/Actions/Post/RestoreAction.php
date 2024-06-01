<?php
namespace Admin\Actions\Post;;
use Illuminate\Http\Request;
use Admin\Models\Posts\{
    Post
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Post::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
