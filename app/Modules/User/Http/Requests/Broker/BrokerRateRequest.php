<?php

namespace User\Http\Requests\Broker;

use User\Http\Requests\BaseRequest;

class BrokerRateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'broker_id'                   =>'required|integer|exists:brokers,id',
            'rate'                        =>'required|numeric|between:1,5',
        ];
    }
}
