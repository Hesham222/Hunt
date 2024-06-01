<?php
namespace User\Actions\Developer\Profile;

use Admin\Models\Listings\ListingMessage;
use Admin\Models\Posts\PostMessage;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use User\Models\DeveloperReplayMessage;
use User\Models\ReplayImage;

class ReplayMessageAction
{
    public function execute(Request $request,$user)
    {
        if ($request->input('type') == 1){

            $post_message = PostMessage::find($request->input('message_id'));

            if ($post_message->developer_id == $user->id){

                $record = DeveloperReplayMessage::create([
                    'developer_id'              => $user->id,
                    'post_message_id'           => $post_message->id,
                    'model_id'                  => $post_message->post->individual_id ,
                    'model_type'                => 'Admin\Models\Individual' ,
                    'message'                   => $request->input('message'),
                ]);

                if ($request['image']){
                    foreach ($request['image'] as $key => $value) {

                        $image = FileTrait::storeSingleFile($value, 'developer_replay_images');
                        if(!empty($value)){
                            $post_image = new ReplayImage();
                            $post_image->attachment   = $image;
                            $post_image->model_type   = 'DeveloperReplay';
                            $post_image->model_id     = $record->id;
                            $post_image->save();
                        }
                    }
                }


            }

        }elseif($request->input('type') == 0){

            $post_message = ListingMessage::find($request->input('message_id'));

            if ($post_message->individual_id){

                $record = DeveloperReplayMessage::create([
                    'developer_id'             => $user->id,
                    'listing_message_id'        => $post_message->id,
                    'model_id'                  => $post_message->individual_id ,
                    'model_type'                => 'Admin\Models\Individual' ,
                    'message'                   => $request->input('message'),
                ]);

                if ($request['image']){

                    foreach ($request['image'] as $key => $value) {

                        $image = FileTrait::storeSingleFile($value, 'developer_replay_images');
                        if(!empty($value)){
                            $post_image = new ReplayImage();
                            $post_image->attachment   = $image;
                            $post_image->model_type   = 'DeveloperReplay';
                            $post_image->model_id     = $record->id;
                            $post_image->save();
                        }
                    }
                }



            }elseif ($post_message->broker_id){

                $record = DeveloperReplayMessage::create([
                    'developer_id'              => $user->id,
                    'listing_message_id'        => $post_message->id,
                    'model_id'                  => $post_message->broker_id ,
                    'model_type'                => 'Admin\Models\Broker' ,
                    'message'                   => $request->input('message'),
                ]);


                if ($request['image']){

                    foreach ($request['image'] as $key => $value) {

                        $image = FileTrait::storeSingleFile($value, 'developer_replay_images');
                        if(!empty($value)){
                            $post_image = new ReplayImage();
                            $post_image->attachment   = $image;
                            $post_image->model_type   = 'DeveloperReplay';
                            $post_image->model_id     = $record->id;
                            $post_image->save();
                        }
                    }
                }



            }else{

                $record = DeveloperReplayMessage::create([
                    'developer_id'              => $user->id,
                    'listing_message_id'        => $post_message->id,
                    'model_id'                  => $post_message->developer_id ,
                    'model_type'                => 'Admin\Models\Developer' ,
                    'message'                   => $request->input('message'),
                ]);

                if ($request['image']){

                    foreach ($request['image'] as $key => $value) {

                        $image = FileTrait::storeSingleFile($value, 'developer_replay_images');
                        if(!empty($value)){
                            $post_image = new ReplayImage();
                            $post_image->attachment   = $image;
                            $post_image->model_type   = 'DeveloperReplay';
                            $post_image->model_id     = $record->id;
                            $post_image->save();
                        }
                    }
                }


            }
        }

        return $record;
    }
}
