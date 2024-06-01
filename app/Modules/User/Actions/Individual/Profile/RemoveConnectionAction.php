<?php
namespace User\Actions\Individual\Profile;

use Illuminate\Http\Request;
use User\Models\IndividualReplayMessage;
use User\Models\UnlockRequests;

class RemoveConnectionAction
{
    public function execute($request,$user)
    {
        $record = UnlockRequests::where(['individual_id'=>$user->id ,'model_id'=>$request->input('model_id')])->first();
        return $record ->forceDelete();
    }
}
