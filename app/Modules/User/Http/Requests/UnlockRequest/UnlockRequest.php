<?php

namespace User\Http\Requests\UnlockRequest;
use User\Http\Requests\BaseRequest;

class UnlockRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'individual_id'                   =>'required|integer|exists:individuals,id',

        ];
    }

}
