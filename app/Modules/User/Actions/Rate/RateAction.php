<?php
namespace User\Actions\Rate;

use Illuminate\Http\Request;
use User\Models\UserReview;

class RateAction
{
    public function execute(Request $request,$user,$model)
    {

        $record = UserReview::create([
            'individual_id'                   => $request->input('individual_id'),
            'model_type'                      => $model,
            'model_id'                        => $user->id,
            'rate'                            => $request->input('rate')
        ]);

        return $record;
    }
}
