<?php

namespace Admin\Http\Requests\User\Broker;

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
        $id = $this->route('broker');
        return [
            'first_name' => 'required|string|min:1|max:191',
            'last_name' => 'required|string|min:1|max:191',
            'brokerage_firm_name' => 'required|min:1|max:191',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|max:191|unique:brokers,email,' . $id,
            'phone' => 'required|string|regex:/^\+?\d+$/|min:10|max:15|unique:brokers,phone,' . $id,
            'date_of_birth' => 'required|date_format:Y-m-d|after_or_equal:1920-01-01' .$id,
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048000000',

        ];
    }
}
