<?php
namespace User\Actions\Message\Post;

use Admin\Models\Posts\PostMessage;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use User\Models\SendImage;

class MessagePostAction
{
    public function execute(Request $request,$user)
    {

        $record = PostMessage::create([
            'broker_id'                 => $request->input('activeGuard')=='brokerApi'?$user->id:null,
            'developer_id'              => $request->input('activeGuard')=='developerApi'?$user->id:null ,
            'individual_id'             => $request->input('activeGuard')=='individualApi'?$user->id:null ,
            'post_id'                   => $request->input('post_id'),
            'title'                     => $request->input('title'),
            'message'                   => $request->input('message'),
        ]);

        if ($request['image']){
            foreach ($request['image'] as $key => $value) {

                $image = FileTrait::storeSingleFile($value, 'post_message_images');
                if(!empty($value)){
                    $post_image = new SendImage();
                    $post_image->attachment   = $image;
                    $post_image->model_type   = 'PostMessage';
                    $post_image->model_id     = $record->id;
                    $post_image->save();
                }
            }
        }
        return $record;
    }
}
