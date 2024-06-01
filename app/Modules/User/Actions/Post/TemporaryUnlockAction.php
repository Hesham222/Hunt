<?php
namespace User\Actions\Post;

use Admin\Models\Posts\Post;
use App\Modules\Admin\Models\Posts\PostFavourite;
use Illuminate\Http\Request;
use User\Models\UnlockRequests;

class TemporaryUnlockAction
{
    public function execute(Request $request)
    {

        $record = Post::find($request->input('post_id'));

        $record = UnlockRequests::where(['model_id'=> $request->input('userId'),'individual_id'=>$record->individual->id])->first();

        return $record->forceDelete();

    }
}
