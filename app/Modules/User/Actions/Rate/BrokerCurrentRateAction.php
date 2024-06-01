<?php
namespace User\Actions\Rate;

use Admin\Models\Broker;
use Illuminate\Http\Request;
use User\Models\BrokerReview;

class BrokerCurrentRateAction
{
    public function execute(Request $request)
    {
        $userReviews = BrokerReview::where('broker_id',$request->input('broker_id'))->select('rate','id')->get();
        $countRate = $userReviews ->count();
        $sumRate = 0;
        foreach ($userReviews as $rate){
            $sumRate += $rate['rate'] ;
        }
        $currentRate =  $sumRate/$countRate;

        return $broker = Broker::find($request->input('broker_id'))->update(['current_rate'=>$currentRate]);
    }
}
