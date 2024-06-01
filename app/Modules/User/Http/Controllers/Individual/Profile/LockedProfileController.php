<?php

namespace User\Http\Controllers\Individual\Profile;

use User\Http\Controllers\BaseResponse;

use Illuminate\Support\Facades\DB;

use  User\Actions\{
    Individual\LockedProfile\LockedProfileAction,
    Individual\LockedProfile\LockedAction,
};
use User\Http\Requests\{
    Individual\LockedProfileRequest,
};
use User\Http\Resources\{
    Individual\LockedProfile\LockedProfileResource,
};
use User\Http\Resources\Individual\UnlockedProfile\UnlockedProfileResource;


class LockedProfileController extends BaseResponse
{
    public function index(LockedProfileRequest $request ,LockedProfileAction $lockedProfileAction ,LockedAction $lockedAction )
    {
        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();
            $unlock = $lockedAction->execute($request,$user);
            if ($unlock){
                return $this->response(200, 'View unlocked profile.', 200, [], 0, [
                    'Individual unlocked profile' => new UnlockedProfileResource($unlock),
                ]);
            }else{
                $record = $lockedProfileAction->execute($request,$user);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);

                DB::commit();
                return $this->response(200, 'View locked profile.', 200, [], 0, [
                    'Individual locked profile' => new LockedProfileResource($record),
                ]);
            }

        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }


}
