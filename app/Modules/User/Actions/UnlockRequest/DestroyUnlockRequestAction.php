<?php
namespace User\Actions\UnlockRequest;

use Illuminate\Http\Request;
use User\Models\UnlockRequests;

class DestroyUnlockRequestAction
{
    public function execute(Request $request,$user)
    {

        $record = UnlockRequests::where(['model_id'=> $user->id,'individual_id'=>$request->input('individual_id')])->first();

        return $record->forceDelete();
    }
}
