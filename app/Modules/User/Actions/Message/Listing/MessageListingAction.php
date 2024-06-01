<?php
namespace User\Actions\Message\Listing;

use Admin\Models\Listings\ListingMessage;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use User\Models\SendImage;

class MessageListingAction
{
    public function execute(Request $request,$user)
    {

        $record = ListingMessage::create([
            'broker_id'                 => $request->input('activeGuard')=='brokerApi'?$user->id:null,
            'developer_id'              => $request->input('activeGuard')=='developerApi'?$user->id:null ,
            'individual_id'             => $request->input('activeGuard')=='individualApi'?$user->id:null ,
            'listing_id'                => $request->input('listing_id'),
            'title'                     => $request->input('title'),
            'message'                   => $request->input('message'),
        ]);
        if ($request['image']){
            foreach ($request['image'] as $key => $value) {

                $image = FileTrait::storeSingleFile($value, 'listing_message_images');
                if(!empty($value)){
                    $post_image = new SendImage();
                    $post_image->attachment   = $image;
                    $post_image->model_type   = 'ListingMessage';
                    $post_image->model_id     = $record->id;
                    $post_image->save();
                }
            }
        }
        return $record;
    }
}
