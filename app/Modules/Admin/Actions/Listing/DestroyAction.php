<?php
namespace Admin\Actions\Listing;;

use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\Listings\{
    Listing
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Listing::withTrashed()->find($id);
        if(!$record)
            return false;
        if($record->image)
            FileTrait::RemoveSingleFile($record->image);
        $record->forceDelete();
        return $request->resource_id;
    }
}
