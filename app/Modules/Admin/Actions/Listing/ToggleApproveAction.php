<?php
namespace Admin\Actions\Listing;;
use Illuminate\Http\Request;
use Admin\Models\Listings\{
    Listing
};

class ToggleApproveAction
{
    public function execute(Request $request, $action)
    {
        $record = Listing::withTrashed()->find($request->resource_id);
        if($action)
            $record->listing_status_id = 2;
        else
            $record->listing_status_id = 3;
        $record->save();
        return $record->id;
    }
}
