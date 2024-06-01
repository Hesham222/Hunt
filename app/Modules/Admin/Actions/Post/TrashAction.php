<?php
namespace Admin\Actions\Post;
use Illuminate\Http\Request;
use Admin\Models\Posts\{
    Post
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Post::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
