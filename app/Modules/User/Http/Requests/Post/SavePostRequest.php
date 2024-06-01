<?php

namespace User\Http\Requests\Post;
use User\Http\Requests\BaseRequest;

class SavePostRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'post_Id'            =>'required|integer|exists:posts,id',
        ];
    }

}
