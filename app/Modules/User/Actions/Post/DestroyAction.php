<?php
namespace User\Actions\Post;

use Admin\Models\Posts\Post;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class DestroyAction
{
    public function execute(Request $request,$user)
    {

        $record        = Post::find($request->input('postId'));

        if ($record->individual_id == $user->id){
            if(!$record)
                return false;
            if($record->image)
                FileTrait::RemoveSingleFile($record->image);
            $record->forceDelete();
            return $request->input('postId');
        }
    }
}
