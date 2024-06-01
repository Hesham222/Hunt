<?php
namespace User\Actions\Listing;

use Admin\Models\Listings\Listing;
use Illuminate\Http\Request;

class AvailabilityListingAction
{
    public function execute(Request $request)
    {

        $record        = Listing::find($request->input('listingId'));

        $record->listing_status_id  = $record->listing_status_id  !== 3 ? 3 : 2;

        $record->save();

        return $record;
    }
}
