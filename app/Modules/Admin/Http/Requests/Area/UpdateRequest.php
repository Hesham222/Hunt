<?php

namespace Admin\Http\Requests\Area;

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
        $id = $this->route('area');
        return [
            'name_en' => 'required|string|min:4|max:191',
            'name_ar' => 'required|string|min:4|max:191',
        ];
    }
}
