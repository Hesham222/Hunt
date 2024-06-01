<?php

namespace User\Http\Requests\Post;
use User\Http\Requests\BaseRequest;

class UnSavePostRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'post_Id'            =>'required|integer|exists:posts,id',
        ];
    }

}
