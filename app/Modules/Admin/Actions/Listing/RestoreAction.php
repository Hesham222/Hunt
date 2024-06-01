<?php
namespace Admin\Actions\Listing;;
use Illuminate\Http\Request;
use Admin\Models\Listings\{
    Listing
};
class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Listing::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
