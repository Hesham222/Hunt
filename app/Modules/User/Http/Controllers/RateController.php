<?php

namespace User\Http\Controllers;

use Illuminate\Support\Facades\DB;

use User\Actions\Rate\{
    RateAction,
    BrokerRateAction,
    DeveloperRateAction,
    IndividualCurrentRateAction,
    BrokerCurrentRateAction,
    DeveloperCurrentRateAction,
};
use User\Http\Requests\{
    Individual\RateRequest,
    Broker\BrokerRateRequest,
    Developer\DeveloperRateRequest,
};
use User\Http\Resources\UnlockRequest\{
    UnlockRequestResource,
};
use User\Models\{
    UnlockRequests
};

class RateController extends BaseResponse
{
    public function rateIndividual(RateRequest $request , RateAction $rateAction, IndividualCurrentRateAction $currentRateAction){

        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();

            $activeGuard = $request->input('activeGuard');

            if ($activeGuard == 'individualApi'){
                $model = 'Admin/Models/Individual';
            }elseif($activeGuard == 'brokerApi'){
                $model = 'Admin/Models/Broker';
            }else
                $model = 'Admin/Models/Developer';

                $record = $rateAction->execute($request, $user,$model);

                $individual = $currentRateAction->execute($request);

                DB::commit();

            return $this->response(200, 'submit Rate individual has been successful.', 200, [], 0,Null);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function rateBroker(BrokerRateRequest $request , BrokerRateAction $rateAction, BrokerCurrentRateAction $currentRateAction){

        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();

            $activeGuard = $request->input('activeGuard');

            if ($activeGuard == 'individualApi'){
                $model = 'Admin/Models/Individual';
            }elseif($activeGuard == 'brokerApi'){
                $model = 'Admin/Models/Broker';
            }else
                $model = 'Admin/Models/Developer';

            $record = $rateAction->execute($request, $user,$model);

            $broker = $currentRateAction->execute($request);

            DB::commit();

            return $this->response(200, 'submit Rate Broker has been successful.', 200, [], 0,Null);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
    public function rateDeveloper(DeveloperRateRequest $request , DeveloperRateAction $rateAction, DeveloperCurrentRateAction $currentRateAction){

        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();

            $activeGuard = $request->input('activeGuard');

            if ($activeGuard == 'individualApi'){
                $model = 'Admin/Models/Individual';
            }elseif($activeGuard == 'brokerApi'){
                $model = 'Admin/Models/Broker';
            }else
                $model = 'Admin/Models/Developer';

            $record = $rateAction->execute($request, $user,$model);

            $developer = $currentRateAction->execute($request);

            DB::commit();

            return $this->response(200, 'submit Rate developer has been successful.', 200, [], 0,Null);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

}
