<?php
namespace User\Actions\Rate;

use Illuminate\Http\Request;
use User\Models\BrokerReview;

class BrokerRateAction
{
    public function execute(Request $request,$user,$model)
    {

        $record = BrokerReview::create([
            'broker_id'                       => $request->input('broker_id'),
            'model_type'                      => $model,
            'model_id'                        => $user->id,
            'rate'                            => $request->input('rate')
        ]);

        return $record;
    }
}
