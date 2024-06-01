<?php
namespace User\Actions\UnlockRequest;

use Illuminate\Http\Request;
use User\Models\UnlockRequests;

class toggleApproveRequestAction
{
    public function execute(Request $request)
    {
        $record = UnlockRequests::find($request->input('requestId'));

        if ($request->input('status') == 1){

            $record ->status = "Approved";

        }elseif ($request->input('status') == 0){
            $record ->status = "Rejected";

        }



        $record->save();
        return $record;
    }
}
