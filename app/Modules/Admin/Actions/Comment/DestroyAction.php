<?php
namespace Admin\Actions\Comment;;

use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;

use Admin\Models\{
    Comment
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Comment::withTrashed()->find($id);
        if(!$record)
            return false;

        if($record->image)
            FileTrait::RemoveSingleFile($record->image);
        $record->forceDelete();
        return $request->resource_id;
    }
}
