<?php

namespace User\Http\Requests\UnlockRequest;
use User\Http\Requests\BaseRequest;

class toggleApproveRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'requestId'                   =>'required|integer|exists:unlock_requests,id',

        ];
    }

}
