<?php

namespace User\Http\Requests\Comment;
use User\Http\Requests\BaseRequest;

class InterestedCommentRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'post_id'                   =>'required|integer|exists:posts,id',

        ];
    }

}
