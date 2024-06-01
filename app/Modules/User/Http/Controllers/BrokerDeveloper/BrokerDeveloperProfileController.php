<?php

namespace User\Http\Controllers\BrokerDeveloper;

use Admin\Actions\Listing\FilterAction;
use Admin\Models\Broker;
use Admin\Models\Developer;
use Illuminate\Http\Request;
use User\Http\Controllers\BaseResponse;

use Illuminate\Support\Facades\DB;

use  User\Actions\{
    DeveloperBroker\CallAction,
    DeveloperBroker\EmailAction,
    DeveloperBroker\BrokerDeveloperAction,
    DeveloperBroker\BrokerDeveloperDAction,
};
use User\Http\Requests\{
    CallEmail\CallRequest,
};
use User\Http\Resources\{
    Individual\Developer\DeveloperProfileResource,
    BrokerDeveloper\BrokerDeveloperProfileResource,
};

use User\Http\Resources\Listing\ListingCollection;
use User\Http\Resources\PaginationResource;


class BrokerDeveloperProfileController extends BaseResponse
{
    public function filter(Request $request ,BrokerDeveloperAction $brokerDeveloperAction , BrokerDeveloperDAction $brokerDeveloperDAction )
    {
        if ($request->input('type') == 1 ){
            try {
                $record = $brokerDeveloperAction->execute($request)->where('broker_id',$request->id)->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));

                return $this->response(200, 'Broker Filter Posts.', 200, [], 0, [
                    'Broker Filter Posts' => new ListingCollection($record),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }
        }elseif ($request->input('type') ==0){
            try {
                $record = $brokerDeveloperDAction->execute($request)->where('developer_id',$request->id)->orderBy('created_at','desc')->paginate(10)->appends($request->except('page'));

                return $this->response(200, 'Developer Filter posts.', 200, [], 0, [
                    'Developer Filter posts' => new ListingCollection($record),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }
        }

    }

    public function viewProfile(Request $request)
    {

        if ($request->input('type') == 1){
            DB::beginTransaction();
            try {
                $broker = Broker::find($request->input('id'));
                DB::commit();
                return $this->response(200,'broker', 200, [], 0, [
                    'broker' => new BrokerDeveloperProfileResource($broker),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }

        }elseif ($request->input('type') == 0){

            DB::beginTransaction();
            try {
                $developer = Developer::find($request->input('id'));
                DB::commit();
                return $this->response(200,'developer', 200, [], 0, [
                    'developer' => new BrokerDeveloperProfileResource($developer),
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }

        }
    }

    public function call(CallRequest $request ,CallAction $callAction)
    {

        DB::beginTransaction();
        try {
            $record = $callAction->execute($request);
            DB::commit();
            return $this->response(200,'User Phone', 200, [], 0, [
                'User Phone' => $record,
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function email(Request $request ,EmailAction $emailAction)
    {

        DB::beginTransaction();
        try {
            $record = $emailAction->execute($request);
            DB::commit();
            return $this->response(200,'User Email', 200, [], 0, [
                'User Email' => $record,
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }


}
