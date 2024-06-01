<?php
namespace Admin\Actions\User\Developer;;

use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;

use Admin\Models\{
    Developer
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Developer::withTrashed()->find($id);
        if(!$record)
            return false;

        if($record->image)
            FileTrait::RemoveSingleFile($record->image);
        $record->forceDelete();
        return $request->resource_id;
    }
}
