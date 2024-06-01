<?php

namespace User\Http\Requests\Message\Post;
use User\Http\Requests\BaseRequest;

class MessagePostRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'post_id'  =>'required|integer|exists:posts,id',
            'title'    => 'required|string|min:3|max:191',
            'message'  => 'required|string|min:3|max:99999',
        ];
    }

}
