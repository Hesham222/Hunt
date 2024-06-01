<?php

namespace User\Http\Requests\Individual;

use User\Http\Requests\BaseRequest;

class RemoveConnectionRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'model_id'                   =>'required|integer|exists:unlock_requests,model_id',
        ];
    }
}
