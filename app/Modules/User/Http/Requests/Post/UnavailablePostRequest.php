<?php

namespace User\Http\Requests\Post;
use User\Http\Requests\BaseRequest;

class UnavailablePostRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'post_id'       =>'required|integer|exists:posts,id',
            'individualId'  => 'nullable|required_without_all:brokerId,developerId|integer|exists:individuals,id',
            'brokerId'      => 'nullable|required_without_all:individualId,developerId|integer|exists:brokers,id',
            'developerId'   => 'nullable|required_without_all:brokerId,individualId|integer|exists:developers,id',
            'rate'          =>'required|numeric|between:1,5',

        ];
    }

}
