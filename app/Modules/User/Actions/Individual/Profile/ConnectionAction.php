<?php
namespace User\Actions\Individual\Profile;

use Illuminate\Http\Request;
use User\Models\IndividualReplayMessage;
use User\Models\UnlockRequests;

class ConnectionAction
{
    public function execute($user)
    {
        $record = UnlockRequests::orderBy('created_at','desc')->where(['individual_id'=>$user->id ,'status'=>'Approved'])->get();

        return $record;
    }
}
