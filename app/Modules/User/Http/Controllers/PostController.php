<?php

namespace User\Http\Controllers;
use Admin\Actions\Post\FilterAction;
use Admin\Models\Posts\Post;
use Admin\Models\Posts\PostStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Actions\Post\{
    StoreAction,
    UpdateAction,
    DestroyAction,
    UnavailableRateAction,
    UnavailablePostAction,
    TemporaryUnlockAction,
};
use Admin\Models\{
    City,
    Posts\PostType,
    Posts\PostSale,
    Posts\PostReasonOption,
    Posts\PostReason,
    Posts\PostCompletion,
};
use User\Http\Resources\{
    City\CityCollection,
    Post\Completion\CompletionCollection,
    Post\PostResource,
    Post\Status\StatusCollection,
    Post\Reason\ReasonCollection,
    Post\ReasonOption\ReasonOptionCollection,
    Post\Sale\SaleCollection,
    Post\Type\TypeCollection,
    Post\PostCollection,
    PaginationResource,
};
use User\Http\Requests\Post\{
    UpdateRequest,
    RemoveRequest,
    StoreRequest,
    UnavailablePostRequest,
    TemporaryUnlockRequest,
};

class PostController extends BaseResponse
{
    public function index(Request $request, FilterAction $getData){

        $records = $getData->execute($request)->where(['post_status_id'=>2])->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));
        return $this->response(200, 'posts', 200, [], 0, [
            'posts'   => new PostCollection($records),
            'pagination' => new PaginationResource($records),
        ]);
    }
    public function create()
    {
        $reasons = PostReason::with(['translations' => function ($query) {
            return $query->select(['reason', 'post_reason_id', 'locale']);
        }])->select(['id'])->get();

        $reasonOptions = PostReasonOption::with(['translations' => function ($query) {
            return $query->select(['option', 'post_reason_option_id', 'locale']);
        }])->select(['id'])->get();

        $cities = City::with(['translations' => function ($query) {
            return $query->select(['name', 'city_id', 'locale']);
        },'areas'])->select(['id'])->get();

        $types = PostType::with(['translations' => function ($query) {
            return $query->select(['type', 'post_type_id', 'locale']);
        }])->select(['id'])->get();

        $sales = PostSale::with(['translations' => function ($query) {
            return $query->select(['sale','post_sale_id','locale']);
        }])->select(['id'])->get();

        $completions = PostCompletion::with(['translations' => function ($query) {
            return $query->select(['completion','post_completion_id','locale']);
        }])->select(['id'])->get();

        $statuses = PostStatus::where('id','!=',1)->with(['translations' => function ($query) {
            return $query->select(['status', 'post_status_id', 'locale']);
        }])->select(['id'])->get();

        return $this->response(200, 'List Post', 200, [], 0, [
            'reasons' => new ReasonCollection($reasons),
            'statuses' => new StatusCollection($statuses),
            'reasonOptions' => new ReasonOptionCollection($reasonOptions),
            'cities' => new CityCollection($cities),
            'types' => new TypeCollection($types),
            'sales' => new SaleCollection($sales),
            'completions' => new CompletionCollection($completions),
        ]);
    }

    public function store(StoreRequest $request, StoreAction $storeAction){

        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();
            $record = $storeAction->execute($request, $user);
            DB::commit();
            return $this->response(200, 'Post has been created successfully.', 200, [], 0, [
                'post' => new PostResource($record),
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function update(Request $request,UpdateAction $updateAction ){
        DB::beginTransaction();
        try {
            $user   = auth('individualApi')->user();

            $record = $updateAction->execute($request,$user);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Post has been Updated successfully.', 200, [], 0, [
                'post' => new PostResource($record),
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction)
    {
        DB::beginTransaction();
        try {
            $user   = auth('individualApi')->user();
            $record =  $destroyAction->execute($request,$user);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Post has been Deleted successfully.', 200, [], 0);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function markUnavailable(UnavailablePostRequest $request, UnavailableRateAction $unavailableRateAction , UnavailablePostAction $unavailablePostAction)
    {
        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();
            $record =  $unavailablePostAction->execute($request,$user);
            if(!$record){
                return $this->response(500, 'Failed, This record is not found .', 200);
            }else{
                $rate =  $unavailableRateAction->execute($request,$user);

            }
            DB::commit();
            return $this->response(200, 'Post status has been changed successfully and user has been rated successfully.', 200, [], 0);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, $ex->getMessage(), 500);
        }
    }

    public function temporaryUnlock(TemporaryUnlockRequest $request, TemporaryUnlockAction $temporaryUnlockAction)
    {
        DB::beginTransaction();
        try {

             $record =  $temporaryUnlockAction->execute($request);
             if(!$record)
                return $this->response(500, 'Failed, user not found .', 200);

            DB::commit();
            return $this->response(200, 'Profile has been locked for this user successfully.', 200, [], 0);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, $ex->getMessage(), 500);
        }
    }
}
