<?php

namespace User\Http\Controllers\Broker;

use Admin\Models\Listings\Listing;
use User\Http\Controllers\BaseResponse;
use Illuminate\Support\Facades\DB;

use  User\Actions\{
    Broker\Profile\MyMessagesListingAction,
    Broker\Profile\UpdateAction,
    Broker\Profile\ReplayMessageAction,

};
use User\Http\Requests\{
    Broker\UpdateProfileRequest,
    Message\Broker\ReplayMessageRequest,

};
use User\Http\Resources\{
    Broker\BrokerResource,
    Message\Individual\ReplayMessageResource,
};
use User\Http\Resources\Listing\ListingCollection;

class ProfileController extends BaseResponse
{

    public function update(UpdateProfileRequest $request,UpdateAction $updateAction)
    {
        DB::beginTransaction();
        try {
            $user = auth('brokerApi')->user();
            $record = $updateAction->execute($request, $user);
            DB::commit();
            return $this->response(200,'Your profile data has been updated successfully', 200, [], 0, [
                'broker' => new BrokerResource($record),
            ]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }


    public function replayMessage(ReplayMessageRequest $request ,ReplayMessageAction $replayMessageAction){

        DB::beginTransaction();
        try {
            $user = auth('brokerApi')->user();
            $record = $replayMessageAction->execute($request,$user);
            DB::commit();
            return $this->response(200,'The Reply to Message Sent Successfully', 200, [], 0, [
                'Individual Replay Message' => new ReplayMessageResource($record),
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }

    }

}
