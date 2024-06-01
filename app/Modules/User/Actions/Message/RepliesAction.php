<?php
namespace User\Actions\Message;

use Admin\Models\Listings\ListingMessage;
use Admin\Models\Posts\PostMessage;
use User\Http\Resources\Message\Individual\ReplayMessageResource;
use User\Http\Resources\ReplayResource;
use User\Models\BrokerReplayMessage;
use User\Models\DeveloperReplayMessage;
use User\Models\IndividualReplayMessage;

class RepliesAction
{
    public function execute($request,$user)
    {
        if ($request->input('activeGuard') == 'individualApi'){

            if($request->input('type') == 1){

                $post_message = PostMessage::find($request->input('message_id'));

                if ($post_message->post->individual_id == $user->id){

                    $individual_replies = IndividualReplayMessage::orderBy('created_at', 'desc')->where('post_message_id',$post_message->id)->get();

                    if ($post_message->individual_id) {

                        $replies = $individual_replies;

                    }elseif ($post_message->broker_id){

                        $replies = BrokerReplayMessage::orderBy('created_at', 'desc')->where('post_message_id',$post_message->id)->get();

                    }else{
                        $replies = DeveloperReplayMessage::orderBy('created_at', 'desc')->where('post_message_id',$post_message->id)->get();

                    }

                    $all_replies = [];
                    foreach ($replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }

                    foreach ($individual_replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }
                }
            }

            elseif ($request->input('type') == 0){

                $post_message = ListingMessage::find($request->input('message_id'));

                if ($post_message->post->individual_id == $user->id){

                    $individual_replies = IndividualReplayMessage::orderBy('created_at', 'desc')->where('listing_message_id',$post_message->id)->get();

                    if ($post_message->Listing->broker_id) {

                        $replies = BrokerReplayMessage::orderBy('created_at', 'desc')->where('listing_message_id',$post_message->id)->get();

                    }elseif ($post_message->Listing->developer_id){

                        $replies = DeveloperReplayMessage::orderBy('created_at', 'desc')->where('listing_message_id',$post_message->id)->get();
                    }

                    $all_replies = [];
                    foreach ($replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }

                    foreach ($individual_replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }
                }
            }


        }elseif ($request->input('activeGuard') == 'brokerApi'){

            if($request->input('type') == 0){

                $post_message = ListingMessage::find($request->input('message_id'));

                if ($post_message->Listing->broker_id == $user->id){

                    $broker_replies = BrokerReplayMessage::orderBy('created_at', 'desc')->where('listing_message_id',$post_message->id)->get();

                    if ($post_message->individual_id) {

                        $replies = IndividualReplayMessage::orderBy('created_at', 'desc')->where('listing_message_id',$post_message->id)->get();

                    }elseif ($post_message->broker_id){

                        $replies = $broker_replies;

                    }else{
                        $replies = DeveloperReplayMessage::orderBy('created_at', 'desc')->where('listing_message_id',$post_message->id)->get();

                    }

                    $all_replies = [];
                    foreach ($replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }

                    foreach ($broker_replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }
                }

            }elseif ($request->input('type') == 1){

                $post_message = PostMessage::find($request->input('message_id'));

                if ($post_message->broker_id == $user->id){

                    $broker_replies = BrokerReplayMessage::orderBy('created_at', 'desc')->where('post_message_id',$post_message->id)->get();

                    $replies        = IndividualReplayMessage::orderBy('created_at', 'desc')->where('post_message_id',$post_message->id)->get();

                    $all_replies = [];

                    foreach ($replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }

                    foreach ($broker_replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }
                }
            }


        }else{
            if($request->input('type') == 0){

                    $post_message       = ListingMessage::find($request->input('message_id'));

                if ($post_message->Listing->developer_id == $user->id){

                    $developer_replies  = DeveloperReplayMessage::orderBy('created_at', 'desc')->where('listing_message_id',$post_message->id)->get();

                    if ($post_message->individual_id) {

                        $replies = IndividualReplayMessage::orderBy('created_at', 'desc')->where('listing_message_id',$post_message->id)->get();

                    }elseif ($post_message->broker_id){

                        $replies = BrokerReplayMessage::orderBy('created_at', 'desc')->where('listing_message_id',$post_message->id)->get();

                    }else{
                        $replies = $developer_replies;

                    }

                    $all_replies = [];
                    foreach ($replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }

                    foreach ($developer_replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }
                }


            }elseif ($request->input('type') == 1){

                $post_message = PostMessage::find($request->input('message_id'));
                if ($post_message->developer_id == $user->id){

                    $developer_replies  = DeveloperReplayMessage::orderBy('created_at', 'desc')->where('post_message_id',$post_message->id)->get();

                    $replies        = IndividualReplayMessage::orderBy('created_at', 'desc')->where('post_message_id',$post_message->id)->get();
                    //dd($replies);


                    $all_replies = [];
                    foreach ($replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }

                    foreach ($developer_replies as $replay) {

                        array_push($all_replies,new ReplayMessageResource($replay)

                        );
                    }
                }

            }


        }
//        $result = array();
//        $sortedArr = collect($all_replies)->sortByDesc('created_at')->all();
//        $result [] = $sortedArr;
        return $all_replies;
    }
}
