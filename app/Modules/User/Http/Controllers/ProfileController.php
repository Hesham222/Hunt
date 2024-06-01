<?php

namespace User\Http\Controllers;


use Admin\Models\Listings\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use  User\Actions\{
    Individual\Profile\UpdateAction,
    UnlockRequest\toggleApproveRequestAction,
    Individual\Profile\MyMessagesPostAction,
    Individual\Profile\ReplayMessageAction,
    Individual\Profile\ConnectionAction,
    Individual\Profile\BlockedListAction,
    Individual\Profile\RemoveConnectionAction,
};
use User\Http\Requests\{
    Individual\UpdateProfileRequest,
    Individual\RemoveConnectionRequest,
    Message\Individual\ReplayMessageRequest,
    UnlockRequest\toggleApproveRequest,
};
use User\Http\Resources\{
    Post\PostCollection,
    UnlockRequest\UnlockRequestCollection,
    UnlockRequest\UnlockRequestResource,
    Individual\IndividualResource,
    Individual\Connection\ConnctionResource,
    Individual\Connection\ConnectionCollection,
    Message\Individual\ReplayMessageResource,

};
use User\Models\{
    UnlockRequests,
};
use Admin\Models\{
    Posts\Post,

};
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Listing\ListingCollection;

class ProfileController extends BaseResponse
{

    public function index(Request $request)
    {
        if ($request->input('activeGuard') == 'individualApi'){

            $user = auth($request->input('activeGuard'))->user();
            return $this->response(200,__('User::messages.profileDetails'), 200, [], 0, [
                'individual' => new IndividualResource($user),
            ]);

        }elseif ($request->input('activeGuard') == 'brokerApi'){

            $user = auth($request->input('activeGuard'))->user();
            return $this->response(200,__('User::messages.profileDetails'), 200, [], 0, [
                'broker' => new BrokerResource($user),
            ]);

        }else{
            $user = auth($request->input('activeGuard'))->user();
            return $this->response(200,__('User::messages.profileDetails'), 200, [], 0, [
                'developer' => new DeveloperResource($user),
            ]);
        }
    }


    public function posts(Request $request)
    {
        if ($request->input('activeGuard') == 'individualApi'){
            DB::beginTransaction();
            try {
                $user = auth($request->input('activeGuard'))->user();

                $posts = Post::where(['individual_id'=> $user->id])->get();
                DB::commit();
                return $this->response(200,'Your Posts', 200, [], 0, [
                    'posts' => new PostCollection($posts),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }

        }elseif ($request->input('activeGuard') == 'brokerApi'){

            DB::beginTransaction();
            try {
                $user = auth('brokerApi')->user();
                $listings = Listing::where(['broker_id'=> $user->id])->get();
                DB::commit();
                return $this->response(200,'Your Listings', 200, [], 0, [
                    'listings' => new ListingCollection($listings),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }

        }else{
            DB::beginTransaction();
            try {
                $user = auth('developerApi')->user();
                $listings = Listing::where(['developer_id'=> $user->id])->get();
                DB::commit();
                return $this->response(200,'Your Listings', 200, [], 0, [
                    'listings' => new ListingCollection($listings),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }
        }
    }


    public function PostDetails(Request $request)
    {
        if ($request->input('type') == 1){
            DB::beginTransaction();
            try {

                $posts = Post::where(['id'=> $request->input('post_id')])->get();
                DB::commit();
                return $this->response(200,'Post', 200, [], 0, [
                    'post' => new PostCollection($posts),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }

        }elseif ($request->input('type') == 0){

            DB::beginTransaction();
            try {
                $listings = Listing::where(['id'=> $request->input('post_id')])->get();
                DB::commit();
                return $this->response(200,'Listing', 200, [], 0, [
                    'listing' => new ListingCollection($listings),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }

        }
    }

}
