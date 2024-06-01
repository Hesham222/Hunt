<?php

namespace User\Http\Requests\Auth;

use User\Http\Requests\BaseRequest;

class ResendCodeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'userId' => ['required'],
            'userType' => 'required|in:broker,developer,individual',
        ];
    }
}
