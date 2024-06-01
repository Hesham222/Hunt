<?php

namespace User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Listings\ListingFavourite;
use User\Actions\Post\{
    SavePostAction,
    UnSavePostAction,
};
use App\Modules\Admin\Models\{
    Posts\PostFavourite
};
use User\Http\Resources\Post\PostFavourite\{
    PostFavouriteResource,
    PostFavouriteCollection,
};
use User\Http\Requests\Post\{
    SavePostRequest,
};
use Illuminate\Support\Facades\DB;

class PostFavouriteController extends BaseResponse
{
    public function favourite(SavePostRequest $request , SavePostAction $favouriteAction, UnSavePostAction $unSavePostAction){

        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();
            DB::commit();

            if(!PostFavourite::where(['post_id'=> $request->input('post_Id'),'individual_id'=>$user->id])->exists()){

                $record = $favouriteAction->execute($request,$user);

            }else{
                $record =  $unSavePostAction->execute($request,$user);

                return $this->response(200, 'Post has been Deleted From Favourite list successfully.', 200, []);
            }
            return $this->response(200, 'Post has been Added to favourite list successfully successfully.', 200, [], 0, [
                'post' => new PostFavouriteResource($record),

            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
    public function savedPosts(){
        $user = auth('individualApi')->user();

        $posts = PostFavourite::orderBy('created_at','desc')->where(['individual_id'=>$user->id])->get();
        $listings = ListingFavourite::orderBy('created_at','desc')->where(['individual_id'=>$user->id])->get();

        $postsListings =  $posts->merge($listings)->sortByDesc('created_at');

        if(!$posts)
            return $this->response(500, 'Failed, record not found .', 200);

        return $this->response(200, 'List saved posts', 200, [], 0, [
            'saved posts' => new PostFavouriteCollection($postsListings),
        ]);
    }

}
