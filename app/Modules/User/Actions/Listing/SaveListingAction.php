<?php
namespace User\Actions\Listing;

use App\Modules\Admin\Models\Listings\ListingFavourite;
use Illuminate\Http\Request;

class SaveListingAction
{
    public function execute(Request $request,$user)
    {

        $record = ListingFavourite::create([
            'listing_id'       => $request->input('listing_Id'),
            'individual_id' => $user->id,
        ]);
        return $record;
    }
}
