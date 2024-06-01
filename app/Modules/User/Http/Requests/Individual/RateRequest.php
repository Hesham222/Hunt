<?php

namespace User\Http\Requests\Individual;

use User\Http\Requests\BaseRequest;

class RateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'individual_id'                   =>'required|integer|exists:individuals,id',
            'rate'                            =>'required|numeric|between:1,5',
        ];
    }
}
