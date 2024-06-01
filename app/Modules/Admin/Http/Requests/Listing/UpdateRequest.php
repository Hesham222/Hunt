<?php

namespace Admin\Http\Requests\Listing;

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
        $id = $this->route('listing');
        return [
            'listing_reason_id'         =>'required|integer|exists:listing_reasons,id',
            'listing_status_id'         =>'required|integer|exists:listing_statuses,id',
            'city_id'                   =>'required|integer|exists:cities,id',
            'area_id'                   =>'required|integer|exists:areas,id',
            'listing_type_id'           =>'required|integer|exists:listing_types,id',
            'listing_completion_id'     =>'required|integer|exists:listing_completions,id',
            'title'                     => 'required|string|min:3|max:255',
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
