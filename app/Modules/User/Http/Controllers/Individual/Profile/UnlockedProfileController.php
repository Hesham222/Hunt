<?php

namespace User\Http\Controllers\Individual\Profile;

use User\Actions\Individual\LockedProfile\LockedAction;
use User\Actions\Individual\LockedProfile\LockedProfileAction;
use User\Http\Controllers\BaseResponse;

use Illuminate\Support\Facades\DB;

use  User\Actions\{
    Individual\UnlockedProfile\UnlockedProfileAction,
};
use User\Http\Requests\{
    Individual\LockedProfileRequest,
};
use User\Http\Resources\{
    Individual\UnlockedProfile\UnlockedProfileResource,
};
use User\Http\Resources\Individual\LockedProfile\LockedProfileResource;


class UnlockedProfileController extends BaseResponse
{
    public function index(lockedProfileRequest $request ,UnlockedProfileAction $unlockedProfileAction )
    {
        DB::beginTransaction();
        try {
             $user = auth($request->input('activeGuard'))->user();

            $record = $unlockedProfileAction->execute($request);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);

            DB::commit();
            return $this->response(200, 'View unlocked profile.', 200, [], 0, [
                'Individual unlocked profile' => new UnlockedProfileResource($record),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

}
