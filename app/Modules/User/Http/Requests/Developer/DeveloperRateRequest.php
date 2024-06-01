<?php

namespace User\Http\Requests\Developer;

use User\Http\Requests\BaseRequest;

class DeveloperRateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'developer_id'            =>'required|integer|exists:developers,id',
            'rate'                    =>'required|numeric|between:1,5',
        ];
    }
}
