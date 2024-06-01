<?php

namespace Admin\Http\Requests\User\Developer;
use Admin\Rules\ConfirmAdminPassword;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'admin_password' => ['required', new ConfirmAdminPassword()],
            'resource_id' => 'required|exists:developers,id',
            'password' => 'required|alpha_num|confirmed|max:191|min:6',
        ];
    }
}
