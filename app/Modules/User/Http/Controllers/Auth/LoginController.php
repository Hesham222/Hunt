<?php

namespace User\Http\Controllers\Auth;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use User\Http\Controllers\BaseResponse;
use Illuminate\Http\Request;
use App\Events\User\UserLoggedIn;
use User\Http\Resources\{
    Developer\DeveloperResource,
    Individual\IndividualResource,
    Broker\BrokerResource,
};
use User\Http\Requests\Auth\{
    LoginRequest,
};
use User\Models\UserVerification;

class LoginController extends BaseResponse
{
    public function login(LoginRequest $request)
    {
        if(!$this->checkCredentials($request))
            return $this->response(101, 'Validation Error', 200, ['Invalid Login']);
        $record = $this->checkCredentials($request);
        $activeGuard =  $this->activeGuard();

        if ($record->status == 'notVerified')
            return $this->response(105, 'Validation Error', 200, ['Verify your account.'], $record->id, [
                'userType'      => $activeGuard,
            ]);

        if ($record->status == 'blocked')
            return $this->response(105, 'Validation Error', 200, ['Your account was permanently banned.'], $record->id, [
                'userType'      => $activeGuard,
            ]);

        DB::beginTransaction();
        try {
                $record->deviceType = $request->input('deviceType');
                $record->firebaseToken = $request->input('firebaseToken');
                if (!$record->api_token)
                    $record->api_token = Str::random(80);
                $record->save();

            switch($activeGuard)
            {
                case "broker":
                    {
                        event(new UserLoggedIn($record, 'Admin\Models\Broker'));
                        DB::commit();
                        return $this->response(200, $record->api_token, 200, [], 0, [
                            'userType'      => $activeGuard,
                            'user'          => new BrokerResource($record)
                        ]);
                    }
                case "developer":
                    {
                        event(new UserLoggedIn($record, 'Admin\Models\Developer'));
                        DB::commit();
                        return $this->response(200, $record->api_token, 200, [], 0, [
                            'userType'      => $activeGuard,
                            'user'          => new DeveloperResource($record)
                        ]);
                    }
                case "individual":
                    {
                        event(new UserLoggedIn($record, 'Admin\Models\Individual'));
                        DB::commit();
                        return $this->response(200, $record->api_token, 200, [], 0, [
                            'userType'      => $activeGuard,
                            'user'          => new IndividualResource($record)
                        ]);
                    }
                default:
                    return $this->response(101, 'Validation Error', 200, [__('auth.failed')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }


    private function checkCredentials(Request $request)
    {
        if($this->checkGuard($request, 'individual'))
            return  $this->checkGuard($request, 'individual');
        elseif($this->checkGuard($request, 'broker'))
            return $this->checkGuard($request, 'broker');
        elseif($this->checkGuard($request, 'developer'))
             return $this->checkGuard($request, 'developer');
        else
            return false;
    }

    private function checkGuard(Request $request, $guard = null)
    {
        if(
            auth($guard)->attempt([
                'email' => $request->input('username'),
                'password' => $request->input('password')])
            ||
            auth($guard)->attempt([
                'phone' => $request->input('username'),
                'password' => $request->input('password')])
        )
            return auth($guard)->user();
        return false;
    }

    private function activeGuard()
    {
        foreach(array_keys(config('auth.guards')) as $guard)
            if(auth()->guard($guard)->check())
                return $guard;
        return 0;
    }
}
