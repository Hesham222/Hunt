<?php
namespace User\Actions\Message;

use Admin\Models\Listings\ListingMessage;
use Admin\Models\Posts\PostMessage;

class MessageDetailAction
{
    public function execute($request)
    {
        if ($request->input('type') == 1){

            if ($request->input('activeGuard') == 'individualApi'){

                $messages = PostMessage::find($request->input('message_id'));


            }elseif ($request->input('activeGuard') == 'brokerApi'){

                $messages = PostMessage::find($request->input('message_id'));

            }else{

                $messages = PostMessage::find($request->input('message_id'));
            }
        }elseif ($request->input('type') == 0){

            if ($request->input('activeGuard') == 'individualApi'){

                $messages = ListingMessage::find($request->input('message_id'));


            }elseif ($request->input('activeGuard') == 'brokerApi'){

                $messages = ListingMessage::find($request->input('message_id'));

            }else{

                $messages = ListingMessage::find($request->input('message_id'));
            }
        }

        return $messages;
    }
}
