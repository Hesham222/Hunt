<?php
namespace User\Actions\Listing;

use App\Modules\Admin\Models\Listings\ListingFavourite;
use Illuminate\Http\Request;

class UnSaveListingAction
{
    public function execute(Request $request,$user)
    {

        $record = ListingFavourite::where(['listing_id'=> $request->input('listing_Id'),'individual_id'=>$user->id])->first();

        return $record->forceDelete();

    }
}
