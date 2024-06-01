<?php

namespace User\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use User\Http\Controllers\BaseResponse;

class BrokerDeveloperAuthorizedUser
{

    public function handle($request, Closure $next)
    {
        $guards = ['brokerApi', 'developerApi'];
        foreach($guards as $guard)
            if(auth()->guard($guard)->check())
                return $next($request->merge(['activeGuard' => $guard]));
        $response = new BaseResponse();
        throw new HttpResponseException($response->response(101, 'Validation Error', 200, ['User not found']));
    }
}
