<?php
namespace User\Actions\Post;

use App\Modules\Admin\Models\Posts\PostFavourite;
use Illuminate\Http\Request;
use User\Models\BrokerReview;
use User\Models\DeveloperReview;
use User\Models\UserReview;

class UnavailableRateAction
{
    public function execute(Request $request,$user)
    {

        if($request->input('individualId')){
            $rate = UserReview::create([
                'individual_id'                   => $request->input('individualId'),
                'model_type'                      => 'Admin/Models/Individual',
                'model_id'                        => $user->id,
                'rate'                            => $request->input('rate')
            ]);
        }elseif ($request->input('brokerId')){
            $rate = BrokerReview::crete([
                'broker_id'                       => $request->input('brokerId'),
                'model_type'                      => 'Admin/Models/Individual',
                'model_id'                        => $user->id,
                'rate'                             => $request->input('rate')
            ]);
        }elseif ($request->input('developerId')){
            $rate = DeveloperReview::crete([
                'broker_id'                       => $request->input('developerId'),
                'model_type'                      => 'Admin/Models/Individual',
                'model_id'                        => $user->id,
                'rate'                             => $request->input('rate')
            ]);
        }else
            return $this->response(500, 'Failed,  User not found .', 200);

        return $rate;


    }
}
