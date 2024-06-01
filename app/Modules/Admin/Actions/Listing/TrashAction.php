<?php
namespace Admin\Actions\Listing;
use Illuminate\Http\Request;
use Admin\Models\Listings\{
    Listing
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Listing::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
