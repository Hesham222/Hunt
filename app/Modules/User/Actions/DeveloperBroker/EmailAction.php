<?php
namespace User\Actions\DeveloperBroker;

use Admin\Models\Broker;
use Admin\Models\Developer;
use Illuminate\Http\Request;


class EmailAction
{
    public function execute(Request $request)
    {
        if($request ->input('brokerId')){
            $record = Broker::Select(['email'])->find($request->input('brokerId'));
        }else{
            $record = Developer::select(['email'])->find($request->input('developerId'));
        }

        return $record;
    }
}
