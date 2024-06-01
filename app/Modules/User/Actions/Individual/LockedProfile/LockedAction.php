<?php
namespace User\Actions\Individual\LockedProfile;

use Admin\Models\Individual;
use Illuminate\Http\Request;
use User\Http\Resources\Individual\UnlockedProfile\UnlockedProfileResource;
use User\Models\UnlockRequests;

class LockedAction
{
    public function execute(Request $request,$user)
    {
        if($user){
            if(UnlockRequests::where(['model_id'=> $user->id,'individual_id'=> $request->input('individual_id')])->exists()){

                $unlockRequestCheck = UnlockRequests::where(['individual_id' => $request->input('individual_id'),'model_id'=>$user->id])->select(['status'])->first();

                if ($unlockRequestCheck->status == "Approved"){

                    return  $individual = Individual::where('id',$request->input('individual_id'))->first();

                }

            }
        }

    }
}
