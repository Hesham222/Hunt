<?php

namespace User\Http\Controllers\Developer;

use Admin\Models\Listings\Listing;
use User\Http\Controllers\BaseResponse;
use Illuminate\Support\Facades\DB;

use  User\Actions\{
    Developer\Profile\MyMessagesListingAction,
    Developer\Profile\UpdateAction,
    Developer\Profile\ReplayMessageAction,

};
use User\Http\Requests\{
    Developer\UpdateProfileRequest,
    Message\Developer\ReplayMessageRequest,

};
use User\Http\Resources\{
    Developer\DeveloperResource,
    Message\Individual\ReplayMessageResource,

};
use User\Http\Resources\Listing\ListingCollection;

class ProfileController extends BaseResponse
{
    public function index()
    {
        $user = auth('developerApi')->user();
        return $this->response(200,__('User::messages.profileDetails'), 200, [], 0, [
            'developer' => new DeveloperResource($user),
        ]);
    }

    public function update(UpdateProfileRequest $request,UpdateAction $updateAction)
    {
        DB::beginTransaction();
        try {
            $user = auth('developerApi')->user();
            $record = $updateAction->execute($request, $user);
            DB::commit();
            return $this->response(200,'Your profile data has been updated successfully', 200, [], 0, [
                'developer' => new DeveloperResource($record),
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
            $user = auth('developerApi')->user();
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
