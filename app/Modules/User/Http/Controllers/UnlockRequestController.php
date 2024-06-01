<?php

namespace User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use User\Actions\UnlockRequest\{
    UnlockRequestAction,
    DestroyUnlockRequestAction,
};
use User\Http\Requests\UnlockRequest\{
    UnlockRequest,
};
use User\Http\Resources\UnlockRequest\{
    UnlockRequestResource,
};
use User\Models\{
    UnlockRequests
};

class UnlockRequestController extends BaseResponse
{
    public function sendRequest(UnlockRequest $request , UnlockRequestAction $sendAction, DestroyUnlockRequestAction $destroyUnlockRequestAction){

        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();

            $activeGuard = $request->input('activeGuard');

            if ($activeGuard == 'individualApi'){
                $model = 'Admin/Models/Individual';
            }elseif($activeGuard == 'brokerApi'){
                $model = 'Admin/Models/Broker';
            }else
                $model = 'Admin/Models/Developer';

            DB::commit();
            if(!UnlockRequests::where(['model_id'=> $user->id,'individual_id'=>$request->input('individual_id')])->exists()){

                $record = $sendAction->execute($request, $user,$model);

            }else{

                $record =  $destroyUnlockRequestAction->execute($request,$user);
                return $this->response(200, 'Unlock Request has been Deleted From unblock requests list successfully.', 200, []);
            }

            return $this->response(200, 'The Request has been sent successfully.', 200, [], 0, [
                'Unlock Request' => new UnlockRequestResource($record),
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }


}
