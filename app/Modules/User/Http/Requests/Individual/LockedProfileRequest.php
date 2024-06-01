<?php

namespace User\Http\Requests\Individual;

use User\Http\Requests\BaseRequest;

class LockedProfileRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'individual_id'                   =>'required|integer|exists:individuals,id',
        ];
    }
}
