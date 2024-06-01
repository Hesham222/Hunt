<?php
namespace User\Actions\Developer\Profile;

use Admin\Models\Listings\Listing;
use Admin\Models\Listings\ListingMessage;
use Admin\Models\Posts\Post;
use Admin\Models\Posts\PostMessage;

class MyMessagesListingAction
{
    public function execute($user)
    {

        $listings = Listing::where(['developer_id'=>$user->id])->get();
        $messages = array();
        foreach ($listings as $listing){
            $messages[] = ListingMessage::with('Listing')->orderBy('created_at','desc')->where(['listing_id'=>$listing->id])->get();
        }
        return $messages;
    }
}
