<?php
namespace User\Actions\Rate;

use Admin\Models\Individual;
use Illuminate\Http\Request;
use User\Models\UserReview;

class IndividualCurrentRateAction
{
    public function execute(Request $request)
    {
        $userReviews = UserReview::where('individual_id',$request->input('individual_id'))->select('rate','id')->get();
        $countRate = $userReviews ->count();
        $sumRate = 0;
        foreach ($userReviews as $rate){

            $currentRate =  $sumRate/$countRate;            $sumRate += $rate['rate'] ;
        }

        return $individual = Individual::find($request->input('individual_id'))->update(['current_rate'=>$currentRate]);
    }
}
