<?php
namespace User\Actions\Post;

use Admin\Models\Posts\Post;
use App\Modules\Admin\Models\Posts\PostFavourite;
use Illuminate\Http\Request;

class UnavailablePostAction
{
    public function execute(Request $request,$user)
    {

        $record = Post::find($request->input('post_id'));


            $record->post_status_id = $record->post_status_id !== 3 ? 3 : 2;
            $record->save();

            return $record;


    }
}
