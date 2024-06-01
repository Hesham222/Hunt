<?php
namespace User\Actions\Listing;

use Admin\Models\Listings\Listing;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class DestroyAction
{
    public function execute(Request $request,$user)
    {

        $record        = Listing::find($request->input('listingId'));
        if ($record->developer_id == Null){
            if ($record->broker_id == $user->id){
                if(!$record)
                    return false;
                if($record->image)
                    FileTrait::RemoveSingleFile($record->image);
                $record->forceDelete();
                return $request->input('listingId');
            }
        }else{
            if ($record->developer_id == $user->id){
                if(!$record)
                    return false;
                if($record->image)
                    FileTrait::RemoveSingleFile($record->image);
                $record->forceDelete();
                return $request->input('listingId');
            }
        }

    }
}
