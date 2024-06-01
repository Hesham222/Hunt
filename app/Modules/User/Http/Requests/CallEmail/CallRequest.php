<?php

namespace User\Http\Requests\CallEmail;
use User\Http\Requests\BaseRequest;

class CallRequest extends BaseRequest
{

    public function rules()
    {
        return [
//            'brokerId'      => 'nullable|required_without:developerId|integer|exists:brokers,id',
//            'developerId'   => 'nullable|required_without:brokerId|integer|exists:developers,id',
            //'individualId' => ['nullable','required_without:brokerId,developerId', 'integer','exists:individuals,id'],
            //'brokerId'     => ['nullable','required_without:individualId,developerId', 'integer','exists:brokers,id'],
            //'developerId'  => ['nullable','required_without:brokerId,individualId', 'integer','exists:developers,id'],
            'brokerId' => ['required_without:developerId', 'nullable', 'integer','exists:brokers,id'],
            'developerId' => ['required_without:brokerId', 'nullable', 'integer','exists:developers,id'],
        ];
    }

}
