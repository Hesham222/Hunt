<?php
namespace User\Actions\Comment;

use Admin\Models\Comments\Comment;
use Admin\Models\Posts\Post;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use User\Models\InterestedComment;

class InterestedCommentAction
{
    public function execute(Request $request,$user)
    {
        $post = Post::where('id',$request->input('post_id'))->first();

        if ($post->post_reason_id == 1 || $post->post_reason_id == 3){
            if ($request->input('activeGuard') == 'individualApi'){

                $record = InterestedComment::create([
                    'post_id'                   => $request->input('post_id'),
                    'model_id'                  => $user->id ,
                    'model_type'                => 'individual' ,
                    'comment'                   => $request->input('comment'),
                ]);


            }elseif ($request->input('activeGuard') == 'brokerApi'){
                $record = InterestedComment::create([
                    'post_id'                   => $request->input('post_id'),
                    'model_id'                  => $user->id ,
                    'model_type'                => 'broker' ,
                    'comment'                   => $request->input('comment'),
                ]);
            }else{
                $record = InterestedComment::create([
                    'post_id'                   => $request->input('post_id'),
                    'model_id'                  => $user->id ,
                    'model_type'                => 'developer' ,
                    'comment'                   => $request->input('comment'),
                ]);
            }
            return $record;
        }else{
            return false;
        }


    }
}
