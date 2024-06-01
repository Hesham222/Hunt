<?php
namespace User\Actions\Post;

use App\Modules\Admin\Models\Posts\PostFavourite;
use Illuminate\Http\Request;

class UnSavePostAction
{
    public function execute(Request $request,$user)
    {

        $record = PostFavourite::where(['post_id'=> $request->input('post_Id'),'individual_id'=>$user->id])->first();

        return $record->forceDelete();

    }
}
