<?php

namespace Admin\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('post');
        return [
            'city_id'                   =>'required|integer|exists:cities,id',
            'area_id'                   =>'required|integer|exists:areas,id',
            'post_type_id'              =>'required|integer|exists:post_types,id',
            'post_completion_id'        =>'required|integer|exists:post_completions,id',
            'description'               => 'required|string|min:3|max:255',
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
            "attachment"                => "nullable|array",
            "attachment.*"              => "nullable|mimes:jpeg,png,jpg,gif,svg|max:2000000",
        ];
    }
}
