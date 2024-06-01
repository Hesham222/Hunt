<?php

namespace User\Http\Controllers\Auth;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use User\Http\Controllers\BaseResponse;
use Illuminate\Http\Request;
use User\Mail\ForgotPassword;
use App\Events\User\UserLoggedIn;
use User\Models\UserVerification;

use User\Http\Requests\Auth\{
    ForgotPasswordRequest,
    ResetPasswordRequest,
};
use User\Http\Resources\{
    Developer\DeveloperResource,
    Individual\IndividualResource,
    Broker\BrokerResource,
};
use Admin\Models\{
    Developer,
    Individual,
    Broker,
};

class ForgotPasswordController extends BaseResponse
{
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $record = $this->getUser($request);
            if (!$record)
                return $this->response(101, 'Validation Error', 200, [__('User::messages.userNotFound')]);
            $userType = $record['userType'];
            $record   = $record['user'];
            if ($record->status == 'notVerified')
                return $this->response(105, 'Validation Error', 200, ['Verify your account.'], $record->id, [
                    'userType'      => $userType,
                ]);

            if ($record->status == 'blocked')
                return $this->response(105, 'Validation Error', 200, ['Your account was permanently banned.'], $record->id, [
                    'userType'      => $userType,
                ]);


            switch($userType) {
                case "individual":
                    $type = 'Admin\Models\Individual';
                    break;
                case "broker":
                    $type = 'Admin\Models\Broker';
                    break;
                case "developer":
                    $type = 'Admin\Models\Developer';
                    break;
                default:
                    return $this->response(101, ' Error', 200, ['User is not found.']);
            }
            $code = rand(1000,9999);
            $verification = UserVerification::create([
                'code'               => $code,
                'model_id'           => $record->id,
                'model_type'         => $type,
                'codeType'           => 'Forget',
            ]);

            // $this->smsService->sendSMS($record->phone, $code . __('User::messages.yourCodeForSite'));
            //Mail::to($record)->send(new ForgotPassword($record, $code));

            DB::commit();
            return $this->response(200, 'Verification code has been sent.', 200, [], $record->id,[
                'userType'  => $userType,
                'code'      => $verification->code,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $record = $this->getUser($request);
            if (!$record)
                return $this->response(101, 'Validation Error', 200, [__('User::messages.userNotFound')]);
            $userType = $record['userType'];
            $record   = $record['user'];
            $record->password = bcrypt($request->input('password'));
            $record->deviceType = $request->input('deviceType');
            $record->firebaseToken = $request->input('firebaseToken');
            $record->api_token = Str::random(80);
            $record->save();
            auth()->login($record);
            $activeGuard = $request->input('userType');
            switch($activeGuard)
            {
                case "individual":
                {
                    UserVerification::where('codeType','Forget')->where('model_id', $record->id)->where('model_type', 'Admin\Models\Individual')->delete();
                    event(new UserLoggedIn($record, 'Admin\Models\individual'));
                    DB::commit();
                    return $this->response(200, $record->api_token, 200, [], 0, [
                        'userType'      => $activeGuard,
                        'user'          => new IndividualResource($record)
                    ]);
                }
                case "broker":
                {
                    UserVerification::where('codeType','Forget')->where('model_id', $record->id)->where('model_type', 'User\Models\Broker')->delete();
                    event(new UserLoggedIn($record, 'User\Models\Broker'));
                    DB::commit();
                    return $this->response(200, $record->api_token, 200, [], 0, [
                        'userType'      => $activeGuard,
                        'user'          => new BrokerResource($record)
                    ]);
                }
                case "developer":{
                    UserVerification::where('codeType','Forget')->where('model_id', $record->id)->where('model_type', 'User\Models\Developer')->delete();
                    event(new UserLoggedIn($record, 'User\Models\Developer'));
                    DB::commit();
                    return $this->response(200, $record->api_token, 200, [], 0, [
                        'userType'      => $activeGuard,
                        'user'          => new DeveloperResource($record)
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

    private function getUser(Request $request)
    {

        $record = Individual::when($request->input('username') , function ($query)  use ($request){
            return $query->where('phone', $request->input('username'))->orWhere('email', $request->input('username'));
        })->when($request->input('userType') == 'individual' , function ($query)  use ($request){
            return $query->where('id', $request->input('userId'));
        })->whereNull('provider_id')
            ->first();
        if($record)
            return ['user'=> $record, 'userType' => 'individual'];

        $record = Broker::when($request->input('username') , function ($query)  use ($request){
            return $query->where('phone', $request->input('username'))->orWhere('email', $request->input('username'));
        })->when($request->input('userType') == 'broker' , function ($query)  use ($request){
            return $query->where('id', $request->input('userId'));
        })->whereNull('provider_id')
            ->first();
        if($record)
            return ['user'=> $record, 'userType' => 'broker'];

        $record = Developer::when($request->input('username') , function ($query)  use ($request){
            return $query->where('phone', $request->input('username'))->orWhere('email', $request->input('username'));
        })->when($request->input('userType') == 'developer' , function ($query)  use ($request){
            return $query->where('id', $request->input('userId'));
        })->whereNull('provider_id')
            ->first();
        if($record)
            return ['user'=> $record, 'userType' => 'developer'];

        return null;
    }

    private function activeGuard()
    {
        foreach(array_keys(config('auth.guards')) as $guard)
            if(auth()->guard($guard)->check())
                return $guard;
        return 0;
    }
}
