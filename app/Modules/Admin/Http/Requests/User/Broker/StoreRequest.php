<?php

namespace Admin\Http\Requests\User\Broker;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'first_name' => 'required|string|min:1|max:191',
            'last_name' => 'required|string|min:1|max:191',
            'brokerage_firm_name' => 'required|string|min:1|max:191',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:brokers|max:191',
            'phone' => 'required|string|regex:/^\+?\d+$/|unique:brokers|min:10|max:15',
            'password' => 'required|alpha_num|max:191|min:6',
            'date_of_birth' => 'required|date_format:Y-m-d|after_or_equal:1920-01-01',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480000000',

        ];
    }
}
