<?php

namespace User\Http\Requests\Auth;

use User\Http\Requests\BaseRequest;

class ForgotPasswordRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'username' => ['required', 'string'],

        ];
    }

}
