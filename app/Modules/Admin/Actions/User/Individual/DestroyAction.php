<?php
namespace Admin\Actions\User\Individual;

use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;

use Admin\Models\{
    Individual
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Individual::withTrashed()->find($id);
        if(!$record)
            return false;

        if($record->image)
            FileTrait::RemoveSingleFile($record->image);
        $record->forceDelete();
        return $request->resource_id;
    }
}
