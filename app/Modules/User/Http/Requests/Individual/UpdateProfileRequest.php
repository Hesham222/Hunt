<?php

namespace User\Http\Requests\Individual;

use User\Http\Requests\BaseRequest;

class UpdateProfileRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'first_name'    => 'required|string|max:191',
            'last_name'     => 'required|string|max:191',
            'email'         => 'nullable|email|max:191|unique:individuals,email,' . auth('individualApi')->user()->id,
            'phone'         => ['nullable', 'unique:individuals,phone,' . auth('individualApi')->user()->id, 'string', 'regex:/^\+?\d+$/', 'max:15'],
            'date_of_birth' => 'required|date_format:Y-m-d',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000000000',
        ];
    }
}
