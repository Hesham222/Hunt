<?php
namespace User\Actions\DeveloperBroker;

use Admin\Models\Broker;
use Admin\Models\Developer;
use Illuminate\Http\Request;


class CallAction
{
    public function execute(Request $request)
    {
        if($request ->input('brokerId')){
            $record = Broker::Select(['phone'])->find($request->input('brokerId'));
        }else{
            $record = Developer::select(['phone'])->find($request->input('developerId'));
        }

        return $record;
    }
}
