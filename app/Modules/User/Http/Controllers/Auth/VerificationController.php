<?php

namespace User\Http\Controllers\Auth;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use User\Http\Controllers\BaseResponse;
use Illuminate\Http\Request;
use User\Http\Requests\Auth\VerifyUserRequest;
use User\Http\Requests\Auth\ResendCodeRequest;
use App\Events\User\UserLoggedIn;
use User\Http\Resources\{
    Developer\DeveloperResource,
    Individual\IndividualResource,
    Broker\BrokerResource,
};
use Admin\Models\{
    Developer,
    Broker,
    Individual,
};
use User\Mail\VerifyUser;
use User\Models\UserVerification;

class VerificationController extends BaseResponse
{
    public function listCodes()
    {
        return UserVerification::select('model_id','model_type', 'code', 'codeType')->orderBy('id', 'DESC')->take(6)->get();
    }

    public function verifyAccount(VerifyUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $record = $this->getUser($request);
            if (!$record)
                return $this->response(101, 'Validation Error', 200, ['User is not found.']);
            $record->status = 'verified';
            $record->deviceType = $request->input('deviceType');
            $record->firebaseToken = $request->input('firebaseToken');
            $record->api_token = Str::random(80);
            $record->save();
            auth()->login($record);
            $activeGuard = $request->input('userType');
            switch($activeGuard)
            {
                case "broker":
                {
                    event(new UserLoggedIn($record, 'Admin\Models\Broker'));
                    UserVerification::where('model_id', $record->id)->where('model_type', 'Admin\Models\Broker')->delete();
                    DB::commit();
                    return $this->response(200, $record->api_token, 200, [], 0, [
                        'userType'      => $activeGuard,
                        'user'          => new BrokerResource($record)
                    ]);
                }
                case "developer":
                {
                    event(new UserLoggedIn($record, 'Admin\Models\Developer'));
                    UserVerification::where('model_id', $record->id)->where('model_type', 'Admin\Models\Developer')->delete();
                    DB::commit();
                    return $this->response(200, $record->api_token, 200, [], 0, [
                        'userType'      => $activeGuard,
                        'user'          => new DeveloperResource($record)
                    ]);
                }
                case "individual":
                {
                    event(new UserLoggedIn($record, 'Admin\Models\Individual'));
                    UserVerification::where('model_id', $record->id)->where('model_type', 'Admin\Models\Individual')->delete();
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

    public function resendCode(ResendCodeRequest $request)
    {
        DB::beginTransaction();
        try {
            $record = $this->getUser($request);
            if (!$record)
                return $this->response(101, 'Validation Error', 200, ['User is not found.']);
            $code = rand(1000,9999);
            $userType = $request->input('userType');
            switch($userType) {
                case "broker":
                    $userType = 'Admin\Models\Broker';
                    break;
                case "developer":
                    $userType = 'Admin\Models\Developer';
                    break;
                case "individual":
                    $userType = 'Admin\Models\Individual';
                    break;
                default:
                    return $this->response(101, 'Validation Error', 200, ['User is not found.']);
            }
            UserVerification::create([
                'code'               => $code,
                'model_id'           => $record->id,
                'model_type'         => $userType,
                'codeType'           => $record->status=='verified' ? 'Forget' : 'Verify',
            ]);
            //$this->smsService->sendSMS($record->phone, $code . __('User::messages.codeSent'));
            //Mail::to($record)->send(new VerifyUser($record, $code));
            DB::commit();
            return $this->response(200, 'Verification code has been sent.', 200, [], $record->id,[
                'userType'=> $request->input('userType'),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function getUser(Request $request)
    {
        switch($request->input('userType'))
        {
            case "broker":
                return Broker::find($request->input('userId'));
            case "developer":
                return Developer::find($request->input('userId'));
            case "individual":
                return Individual::find($request->input('userId'));
            default:
                $userType = null;
        }
    }
}
