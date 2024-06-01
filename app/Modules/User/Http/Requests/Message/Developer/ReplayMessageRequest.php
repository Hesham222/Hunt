<?php

namespace User\Http\Requests\Message\Developer;
use User\Http\Requests\BaseRequest;

class ReplayMessageRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'message'       => 'required|string|min:3|max:99999',
            'individualId'  => 'nullable|required_without_all:brokerId,developerId|integer|exists:individuals,id',
            'brokerId'      => 'nullable|required_without_all:individualId,developerId|integer|exists:brokers,id',
            'developerId'   => 'nullable|required_without_all:brokerId,individualId|integer|exists:developers,id',
            //'individualId' => ['nullable','required_without:brokerId,developerId', 'integer','exists:individuals,id'],
            //'brokerId'     => ['nullable','required_without:individualId,developerId', 'integer','exists:brokers,id'],
            //'developerId'  => ['nullable','required_without:brokerId,individualId', 'integer','exists:developers,id'],
        ];
    }

}
