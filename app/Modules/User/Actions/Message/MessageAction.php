<?php
namespace User\Actions\Message;

use Admin\Models\Listings\Listing;
use Admin\Models\Listings\ListingMessage;
use Admin\Models\Posts\Post;
use Admin\Models\Posts\PostMessage;

class MessageAction
{
    public function execute($user,$request)
    {
        if ($request->input('activeGuard') == 'individualApi'){

            $messages = PostMessage::orderBy('created_at','desc')->whereHas('post',function ($query) use ($user){
                $query->where(['individual_id'=>$user->id]);
            })->get();

        }elseif ($request->input('activeGuard') == 'brokerApi'){

            $messages = ListingMessage::orderBy('created_at','desc')->whereHas('Listing',function ($query) use ($user){
                $query->where('broker_id',$user->id);
            })->get();
        }else{

            $messages = ListingMessage::orderBy('created_at','desc')->whereHas('Listing',function ($query) use ($user){
                $query->where('developer_id',$user->id);
            })->get();

        }
        return $messages;
    }
}
