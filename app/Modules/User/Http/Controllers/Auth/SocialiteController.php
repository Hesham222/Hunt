<?php

namespace User\Http\Controllers\Auth;

use Admin\Models\Broker;
use Admin\Models\Developer;
use Admin\Models\Individual;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use User\Http\Controllers\BaseResponse;
use Illuminate\Http\Request;
use User\Http\Requests\Auth\LoginRequest;
use App\Events\User\UserLoggedIn;
use User\Http\Resources\{
    Developer\DeveloperResource,
    Individual\IndividualResource,
    Broker\BrokerResource,
};
use User\Http\Requests\Auth\{
    LoginProviderRequest,
};

use User\Models\UserVerification;

class SocialiteController extends BaseResponse
{

    public function loginProvider(LoginProviderRequest $request)
    {
        DB::beginTransaction();
        try {
             $socialUser = Socialite::driver($request->input('from'))->userFromToken($request->input('token'));
            if (empty($socialUser->getEmail()))
                return $this->response(101, 'Validation Error', 200, [__('User::messages.registerWithYourSocialAcc')]);
            $activeGuard =  $this->activeGuard();

            $record = $this->getUser($request);
            $user = $record['user'];

            if (is_null($user)) {
                if ($this->getUser($request)->where('email', $socialUser->getEmail())->count() > 0)
                    return $this->response(101, 'Validation Error', 200, [__('User::messages.emailAlreadyExists')]);
                else {
                    $user = $this->getUser($request)->create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'password' => bcrypt($socialUser->getId()),
                        'provider' => $request->input('from'),
                        'provider_id' => $socialUser->getId(),
                        'isVerified' => 1
                    ]);
                }
            }

            $user->deviceType = $request->input('deviceType');
            $user->firebaseToken = $request->input('firebaseToken');
            if (!$user->api_token) {
                $user->api_token = Str::random(80);
            }
            $user->save();
            auth()->login($user);

            switch($activeGuard)
            {
                case "broker":
                {
                    event(new UserLoggedIn($user, 'Admin\Models\Broker'));
                    DB::commit();
                    return $this->response(200, $user->api_token, 200, [], 0, [
                        'userType'      => $activeGuard,
                        'user'          => new BrokerResource($user)
                    ]);
                }
                case "developer":
                {
                    event(new UserLoggedIn($user, 'Admin\Models\Developer'));
                    DB::commit();
                    return $this->response(200, $user->api_token, 200, [], 0, [
                        'userType'      => $activeGuard,
                        'user'          => new DeveloperResource($user)
                    ]);
                }
                case "individual":
                {
                    event(new UserLoggedIn($user, 'Admin\Models\Individual'));
                    DB::commit();
                    return $this->response(200, $user->api_token, 200, [], 0, [
                        'userType'      => $activeGuard,
                        'user'          => new IndividualResource($user)
                    ]);
                }
                default:
                    return $this->response(101, 'Validation Error', 200, [__('auth.failed')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(101, 'Validation Error', 200, [__('User::messages.invalidSocialAccount')]);
        }

    }
    private function getUser(Request $request)
    {
        $socialUser = Socialite::driver($request->input('from'))->userFromToken($request->input('token'));

        if($record = Individual::when($request->input('from'), function ($query) use ($request) {
            return $query->where('provider', $request->input('from'));
        })->where('provider_id', $socialUser->getId())->first())
            return ['user'=> $record, 'userType' => 'individual' ];

        if($record = Broker::when($request->input('from'), function ($query) use ($request) {
            return $query->where('provider', $request->input('from'));
        })->where('provider_id', $socialUser->getId())->first())
            return ['user'=> $record, 'userType' => 'broker'];

        if($record = Developer::when($request->input('from'), function ($query) use ($request) {
            return $query->where('provider', $request->input('from'));
        })->where('provider_id', $socialUser->getId())->first())
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
