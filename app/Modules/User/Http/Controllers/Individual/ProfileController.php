<?php

namespace User\Http\Controllers\Individual;

use Illuminate\Http\Request;
use User\Http\Controllers\BaseResponse;

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

class ProfileController extends BaseResponse
{

    public function update(UpdateProfileRequest $request, UpdateAction $updateAction)
    {
        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();
            $record = $updateAction->execute($request, $user);
            DB::commit();
            return $this->response(200,'Your profile data has been updated successfully', 200, [], 0, [
                'individual' => new IndividualResource($record),
            ]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function unlockProfile(){

        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();
            $user->public = $user->public == '1' ? '0' : '1';
            $user->save();
            DB::commit();
            return $this->response(200, __('User::messages.statusUpdated'), 200, [], 0, [
                'user' => new IndividualResource($user),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function myRequests(){
        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();
            $unlockRequests = UnlockRequests::where(['individual_id'=>$user->id,'status'=>'Pending'])->get();
            if(!$unlockRequests)
                return $this->response(500, 'Failed, record not found .', 200);
            DB::commit();
            return $this->response(200,'Unlock Requests', 200, [], 0, [
                'My Unlock Requests' => new UnlockRequestCollection($unlockRequests),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
    public function replayMessage(Request $request ,ReplayMessageAction $replayMessageAction){

        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();
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

    public function toggleApproveRequest(toggleApproveRequest $request ,toggleApproveRequestAction $toggleApproveRequestAction){

        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();

            $record = $toggleApproveRequestAction->execute($request,$user);

            DB::commit();
            return $this->response(200, 'The Request Status has been changed successfully.', 200, [], 0, [
                'Unlock Request' => new UnlockRequestResource($record),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function connections(ConnectionAction $connectionAction){

        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();

            $record = $connectionAction->execute($user);
            if(!$record)
                return $this->response(500, 'Failed, record not found .', 200);

            DB::commit();
            return $this->response(200, 'Connections.', 200, [], 0, [
                'Connections' => new ConnectionCollection($record),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function blockedList(BlockedListAction $blockedListAction){

        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();

            $record = $blockedListAction->execute($user);
            if(!$record)
                return $this->response(500, 'Failed, record not found .', 200);

            DB::commit();
            return $this->response(200, 'Blocked List.', 200, [], 0, [
                'Blocked List' => new ConnectionCollection($record),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
    public function removeConnection(RemoveConnectionRequest $request ,RemoveConnectionAction $removeConnectionAction){


        DB::beginTransaction();
        try {
            $user = auth('individualApi')->user();

            $record = $removeConnectionAction->execute($request,$user);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);

            DB::commit();
            return $this->response(200, 'The user has been removed Successfully from Connections.', 200, [], 0);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }


}
