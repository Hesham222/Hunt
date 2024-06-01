<?php

namespace User\Http\Requests\Post;
use User\Http\Requests\BaseRequest;

class TemporaryUnlockRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'userId'       =>'required|integer|exists:unlock_requests,model_id',
            'post_id'       =>'required|integer|exists:posts,id',

        ];
    }

}
