<?php

namespace User\Http\Controllers;

use App\Modules\Admin\Models\Posts\PostFavourite;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Admin\Actions\{
    Post\FilterAction as PostFilterAction,
    Listing\FilterAction as ListingFilterAction,
    User\Individual\FilterAction as IndividualFilterAction,
    User\Broker\FilterAction as BrokerFilterAction,
    User\Developer\FilterAction as DeveloperFilterAction,
};
use User\Http\Resources\{
    PostListing\PostListingCollection,
    Post\PostCollection,
    PaginationResource,
    Individual\IndividualCollection,
    Broker\BrokerCollection,
    Developer\DeveloperCollection,
    Listing\ListingCollection
};
use Admin\Models\{
    Listings\Listing,
    Posts\Post
};
use User\Http\Resources\PostListing\PostListingGuestCollection;

class PostListController extends BaseResponse
{

    public function index(){

            $posts = Post::orderBy('created_at', 'desc')->where('post_status_id','!=',1)->get();

            $listings = Listing::orderBy('created_at', 'desc')->where('listing_status_id','!=',1)->get();

            $postsListings =  $posts->merge($listings)->sortByDesc('created_at');

            return $this->response(200, 'recent posts an listings', 200, [], 0, [
                'Recent Post and listing'   => new PostListingCollection($postsListings),
            ]);

    }

    public function indexGuest(){

        $posts = Post::orderBy('created_at', 'desc')->where('post_status_id','!=',1)->get();
        $listings = Listing::orderBy('created_at', 'desc')->where('listing_status_id','!=',1)->get();


        $postsListings =  $posts->merge($listings)->sortByDesc('created_at');

        return $this->response(200, 'recent posts an listings', 200, [], 0, [
            'Recent Post and listing'   => new PostListingGuestCollection($postsListings),
        ]);

    }


    public function search(Request $request,PostFilterAction $postFilterAction ,ListingFilterAction $listingFilterAction ){
        try {

            $posts    = $postFilterAction->execute($request)->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));
            $listings = $listingFilterAction->execute($request)->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));
            $search   = $posts->merge($listings)->sortByDesc('created_at')->paginate(20)->appends($request->except('page'));

            return $this->response(200, 'Search Property', 200, [], 0, [
                'Search Property' => new PostListingCollection($search),
                'pagination'      => new PaginationResource($search),

            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }

    }
    public function searchGuest(Request $request,PostFilterAction $postFilterAction ,ListingFilterAction $listingFilterAction ){
        try {

            $posts    = $postFilterAction->execute($request)->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));
            $listings = $listingFilterAction->execute($request)->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));
            $search   = $posts->merge($listings)->sortByDesc('created_at')->paginate(20)->appends($request->except('page'));

            return $this->response(200, 'Search Property', 200, [], 0, [
                'Search Property' => new PostListingGuestCollection($search),
                'pagination'      => new PaginationResource($search),

            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }

    }
    public function searchUser(Request $request,IndividualFilterAction $individualFilterAction ,BrokerFilterAction $brokerFilterAction,DeveloperFilterAction $developerFilterAction ){
        try {
            if($request->input('userType')=='individual'){
                $individuals  = $individualFilterAction->execute($request)->where(['status'=>'verified'])->paginate(10)->appends($request->except('page'));
                return $this->response(200, 'Search user', 200, [], 0, [
                    'Search a user Results' => new IndividualCollection($individuals),
                    'pagination' => new PaginationResource($individuals),
                ]);

            }elseif ($request->input('userType')=='broker'){
                $brokers      = $brokerFilterAction->execute($request)->where(['status'=>'verified'])->paginate(10)->appends($request->except('page'));
                return $this->response(200, 'Search Property', 200, [], 0, [
                    'Search user Results' => new BrokerCollection($brokers),
                    'pagination' => new PaginationResource($brokers),
                ]);
            }elseif($request->input('userType')=='developer'){
                $developers   = $developerFilterAction->execute($request)->where(['status'=>'verified'])->paginate(10)->appends($request->except('page'));
                return $this->response(200, 'Search Property', 200, [], 0, [
                    'Search user Results' => new DeveloperCollection($developers),
                    'pagination' => new PaginationResource($developers),
                ]);
            }else{
                return $this->response(105, 'User Not Found', 200, ['Please try again.']);

            }

        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }

    }
}
