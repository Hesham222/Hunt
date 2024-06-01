<?php

namespace Admin\Http\Requests\Comment;

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
        $id = $this->route('comment');
        return [
            'individual_id' => 'nullable|exists:individuals,id',
            'broker_id' => 'nullable|exists:brokers,id',
            'developer_id' => 'nullable|exists:developers,id',
            'post_id' => 'required|exists:posts,id',
            'description' => 'required|string|regex:/^[\pL\s\-]+$/u|min:4|max:99999',
        ];
    }
}
