<?php
namespace User\Actions\Broker\Profile;

use Admin\Models\Listings\Listing;
use Admin\Models\Listings\ListingMessage;


class MyMessagesListingAction
{
    public function execute($user)
    {

        $listings = Listing::orderBy('created_at','desc')->where(['broker_id'=>$user->id])->get();
        $messages = array();
        foreach ($listings as $listing){
            $messages[] = ListingMessage::with('Listing')->orderBy('created_at','desc')->orderBy('created_at','desc')->where(['listing_id'=>$listing->id])->get();
        }
        return $messages;
    }
}
