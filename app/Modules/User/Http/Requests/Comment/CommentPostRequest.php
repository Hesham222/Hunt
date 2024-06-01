<?php

namespace User\Http\Requests\Comment;
use User\Http\Requests\BaseRequest;

class CommentPostRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'post_id'                   =>'required|integer|exists:posts,id',
            'post_completion_id'        =>'required|integer|exists:post_completions,id',
            'post_status_id'            =>'required|integer|exists:post_statuses,id',
            'description'               => 'required|string|min:3|max:99999',
            'developer'                 => 'required|string|min:3|max:255',
            'rooms'                     => 'required|numeric|min:0|max:999999999.99',
            'size_of_property'          => 'required|numeric|min:0|max:999999999.99',
            'payment'                   => 'required|numeric|min:0|max:999999999.99',
            'start_down_payment'        => 'required|numeric|min:0|max:999999999.99',
            'end_down_payment'          => 'nullable|numeric|gt:start_down_payment|max:999999999.99',
            'start_monthly_installment' => 'required|numeric|min:0|max:999999999.99',
            'end_monthly_installment'   => 'nullable|numeric|gt:start_monthly_installment|max:999999999.99',
            'start_payment_duration'    => 'required|numeric|min:0|max:999999999.99',
            'end_payment_duration'      => 'nullable|numeric|gt:start_payment_duration|max:999999999.99',
            'delivery_date'             => 'required|date_format:Y-m-d|after_or_equal:1920-01-01',
            'image'                     => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',


        ];
    }

}