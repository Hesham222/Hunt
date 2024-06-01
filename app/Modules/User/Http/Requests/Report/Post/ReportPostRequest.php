<?php

namespace User\Http\Requests\Report\Post;
use User\Http\Requests\BaseRequest;

class ReportPostRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'post_id'               =>'required|integer|exists:posts,id',
            'post_report_reason_id' =>'required|integer|exists:post_report_reasons,id',
            'other_reason'          => 'nullable|string|min:3|max:191',
            'comments'              => 'required|string|min:3|max:99999',
        ];
    }

}
