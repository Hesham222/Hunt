<?php
namespace User\Actions\UnlockRequest;

use Illuminate\Http\Request;
use User\Models\UnlockRequests;

class UnlockRequestAction
{
    public function execute(Request $request,$user,$model)
    {

        $record = UnlockRequests::create([
            'individual_id'                   => $request->input('individual_id'),
            'model_type'                      => $model,
            'model_id'                        => $user->id,
            'status'                          => "Pending"

        ]);

        return $record;
    }
}
