<?php
namespace User\Actions\Rate;

use Admin\Models\Developer;
use Illuminate\Http\Request;
use User\Models\DeveloperReview;

class DeveloperCurrentRateAction
{
    public function execute(Request $request)
    {
        $userReviews = DeveloperReview::where('developer_id',$request->input('developer_id'))->select('rate','id')->get();
        $countRate = $userReviews ->count();
        $sumRate = 0;
        foreach ($userReviews as $rate){
            $sumRate += $rate['rate'] ;
        }
        $currentRate =  $sumRate/$countRate;

        return $developer = Developer::find($request->input('developer_id'))->update(['current_rate'=>$currentRate]);
    }
}
