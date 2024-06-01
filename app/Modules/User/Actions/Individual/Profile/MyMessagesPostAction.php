<?php
namespace User\Actions\Individual\Profile;

use Admin\Models\Posts\Post;
use Admin\Models\Posts\PostMessage;
use Illuminate\Http\Request;

class MyMessagesPostAction
{
    public function execute($user)
    {

        $posts = Post::orderBy('created_at','desc')->where(['individual_id'=>$user->id])->get();
        $messages = array();
        foreach ($posts as $post){
            $messages[] = PostMessage::with('post')->orderBy('created_at','desc')->where(['post_id'=>$post->id])->get();
        }
        return $messages;
    }
}
