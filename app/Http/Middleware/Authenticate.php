<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use User\Http\Controllers\BaseResponse;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $response = new BaseResponse();
            throw new HttpResponseException($response->response(101, 'Validation Error', 200, ['You are not authorized to view this page due to invalid authentication headers.']));
        }
    }
}
