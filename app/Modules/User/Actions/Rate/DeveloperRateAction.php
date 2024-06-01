<?php
namespace User\Actions\Rate;

use Illuminate\Http\Request;
use User\Models\DeveloperReview;

class DeveloperRateAction
{
    public function execute(Request $request,$user,$model)
    {

        $record = DeveloperReview::create([
            'developer_id'                    => $request->input('developer_id'),
            'model_type'                      => $model,
            'model_id'                        => $user->id,
            'rate'                            => $request->input('rate')
        ]);

        return $record;
    }
}
