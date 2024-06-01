<?php

namespace User\Http\Requests\Developer;
use User\Http\Requests\BaseRequest;
use User\Rules\{
    CheckExistedEmail,
    CheckExistedPhone,
};
class RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'firstName'             => 'required|string|max:191',
            'lastName'              => 'required|string|max:191',
            'phone'                 => ['required','min:9','max:15','regex:/^\+?\d+$/',new CheckExistedPhone() ],
            'email'                 => ['required','email',new CheckExistedEmail() ],
            'developerName'         => 'required|string|max:191',
            'dateOfBirth'           => 'nullable|date|date_format:Y-m-d',
            'password'              => 'required|string|max:191|confirmed',
            'image'                 => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ];
    }

}
