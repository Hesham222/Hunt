<?php
namespace User\Actions\Individual\LockedProfile;

use Admin\Models\Individual;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use User\Http\Controllers\BaseResponse;
use User\Http\Resources\Individual\UnlockedProfile\UnlockedProfileResource;
use User\Models\UnlockRequests;

class LockedProfileAction extends BaseResponse
{
    public function execute(Request $request,$user)
    {
        if($user){
            if(UnlockRequests::where(['model_id'=> $user->id,'individual_id'=> $request->input('individual_id')])->exists()){

                $individual = Individual::find($request->input('individual_id'))->select(['public'])->first();

                $unlockRequestCheck = UnlockRequests::where(['individual_id' => $request->input('individual_id'),'model_id'=>$user->id])->select(['status'])->first();

                if ($individual->public == "0" || $unlockRequestCheck->status == "Pending" || $unlockRequestCheck->status == "Rejected"){

                    return $record  = Individual::with('posts')->find($request->input('individual_id'));

                }

            }else{
                return $record  = Individual::with('posts')->find($request->input('individual_id'));

            }
        }

    }
}
