<?php

namespace User\Http\Controllers;
use Admin\Actions\Listing\FilterAction;
use Admin\Models\Listings\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Actions\Listing\{
    StoreAction,
    UpdateAction,
    DestroyAction,
    AvailabilityListingAction,
};
use Admin\Models\{
    City,
    Listings\ListingType,
    Listings\ListingSale,
    Listings\ListingStatus,
    Listings\ListingReason,
    Listings\ListingCompletion,
};


use User\Http\Requests\{
    Listing\RemoveRequest,
    Listing\StoreRequest,
    Listing\UpdateRequest,
    Listing\AvailabilityListingRequest,
};
use User\Http\Resources\{
    City\CityCollection,
    Listing\Completion\CompletionCollection,
    Listing\ListingResource,
    Listing\Reason\ReasonCollection,
    Listing\Status\StatusCollection,
    Listing\Sale\SaleCollection,
    Listing\Type\TypeCollection,
    PaginationResource
};
use User\Http\Resources\Listing\ListingCollection;


class ListingController extends BaseResponse
{

    public function index(Request $request, FilterAction $getData){

        $records = $getData->execute($request)->where(['listing_status_id'=>2])->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));
        return $this->response(200, 'Listings', 200, [], 0, [
            'listings'   => new ListingCollection($records),
            'pagination' => new PaginationResource($records),
        ]);

    }
    public function create()
    {
        $reasons = ListingReason::with(['translations' => function ($query) {
            return $query->select(['reason', 'listing_reason_id', 'locale']);
        }])->select(['id'])->get();

        $cities = City::with(['translations' => function ($query) {
            return $query->select(['name', 'city_id', 'locale']);
        },'areas'])->select(['id'])->get();

        $types = ListingType::with(['translations' => function ($query) {
            return $query->select(['type', 'listing_type_id', 'locale']);
        }])->select(['id'])->get();

        $sales = ListingSale::with(['translations' => function ($query) {
            return $query->select(['sale','listing_sale_id','locale']);
        }])->select(['id'])->get();

        $completions = ListingCompletion::with(['translations' => function ($query) {
            return $query->select(['completion','listing_completion_id','locale']);
        }])->select(['id'])->get();

        $statuses = ListingStatus::with(['translations' => function ($query) {
            return $query->select(['status', 'listing_status_id', 'locale']);
        }])->select(['id'])->get();

        return $this->response(200, 'Listing', 200, [], 0, [
            'reasons'   => new ReasonCollection($reasons),
            'statuses'  => new StatusCollection($statuses),
            'cities'    => new CityCollection($cities),
            'types'     => new TypeCollection($types),
            'sales'     => new SaleCollection($sales),
            'completions' => new CompletionCollection($completions),
        ]);
    }

    public function store(StoreRequest $request,StoreAction $storeAction){

        DB::beginTransaction();
        try {

            $user = auth($request->input('activeGuard'))->user();
            $record = $storeAction->execute($request, $user);
            DB::commit();
            return $this->response(200, 'Listing has been created successfully.', 200, [], 0, [
                'listing' => new ListingResource($record),
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function update(UpdateRequest $request,UpdateAction $updateAction ){
        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();
            $record = $updateAction->execute($request,$user);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Listing has been Updated successfully.', 200, [], 0, [
                'listing' => new ListingResource($record),
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
            $user = auth($request->input('activeGuard'))->user();

            $record =  $destroyAction->execute($request,$user);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Listing has been Deleted successfully.', 200, [], 0);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function toggleAvailability(AvailabilityListingRequest $request,AvailabilityListingAction $updateAction ){
        DB::beginTransaction();
        try {
            $record = $updateAction->execute($request);
            DB::commit();
            return $this->response(200, 'Availability has been changed successfully.', 200, [], 0, [
                'listing' => new ListingResource($record),
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }


}
