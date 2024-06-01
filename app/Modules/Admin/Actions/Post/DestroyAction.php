<?php
namespace Admin\Actions\Post;;

use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\Posts\{
    Post
};
class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Post::withTrashed()->find($id);
        if(!$record)
            return false;
        if($record->image)
            FileTrait::RemoveSingleFile($record->image);
        $record->forceDelete();
        return $request->resource_id;
    }
}
