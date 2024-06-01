<?php

namespace User\Http\Requests\Developer;

use User\Http\Requests\BaseRequest;

class UpdateProfileRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'first_name'            => 'required|string|min:1|max:191',
            'last_name'             => 'required|string|min:1|max:191',
            'developer_name'        => 'required|min:1|max:191',
            'email'                 => 'nullable|email|max:191|unique:developers,email,' . auth('developerApi')->user()->id,
            'phone'                 => ['required', 'unique:developers,phone,' . auth('developerApi')->user()->id, 'string', 'regex:/^\+?\d+$/', 'max:15'],
            'date_of_birth'         => 'required|date|date_format:Y-m-d',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048000000',
        ];
    }
}
