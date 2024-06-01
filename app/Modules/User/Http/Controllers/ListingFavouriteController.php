<?php

namespace User\Http\Controllers;

use App\Http\Controllers\Controller;
use User\Actions\Listing\{
    SaveListingAction,
    UnSaveListingAction,
};
use App\Modules\Admin\Models\{
    Listings\ListingFavourite
};
use User\Http\Resources\Listing\ListingFavourite\{
    ListingFavouriteResource,
    ListingFavouriteCollection,
};
use User\Http\Requests\Listing\{
    SaveListingRequest,
};
use Illuminate\Support\Facades\DB;

class ListingFavouriteController extends BaseResponse
{
    public function favourite(SaveListingRequest $request , SaveListingAction $favouriteAction, UnSaveListingAction $unSavePostAction){

        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();
            DB::commit();

            if(!ListingFavourite::where(['listing_id'=> $request->input('listing_Id'),'individual_id'=>$user->id])->exists()){

                $record = $favouriteAction->execute($request,$user);

            }else{
                $record =  $unSavePostAction->execute($request,$user);

                return $this->response(200, 'Listing has been Deleted From Favourite list successfully.', 200, []);
            }
            return $this->response(200, 'Listing has been Added to favourite list successfully successfully.', 200, [], 0, [
                'listing' => new ListingFavouriteResource($record),

            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
    public function savedPosts(){
        $user = auth('individualApi')->user();

        $posts = ListingFavourite::where(['individual_id'=>$user->id])->get();
        return $this->response(200, 'List saved listings', 200, [], 0, [
            'saved listings' => new ListingFavouriteCollection($posts),
        ]);
    }

}
