<?php

namespace User\Http\Requests\Auth;
use User\Http\Requests\BaseRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use User\Models\UserVerification;

class ResetPasswordRequest extends BaseRequest
{

    public function rules()
    {


        return [
            'userId' => ['required'],
            'deviceType' => 'required|in:Web,Android,IOS',
            'firebaseToken' => 'nullable|string|max:65000',
            'userType' => 'required|in:individual,developer,broker',
            'code' => ['required', 'string', Rule::exists('user_verifications')->where(function ($query) {
                $query->where('id', UserVerification::where('model_id', $this->input('userId'))->orderBy('created_at', 'desc')->value('id'))
                    ->where('codeType', 'Forget')
                    ->when($this->input('userType') == 'individual' , function ($query){
                        return $query->where('model_type', 'Admin\Models\Individual');
                    })
                    ->when($this->input('userType') == 'developer' , function ($query){
                        return $query->where('model_type', 'User\Models\Developer');
                    })
                    ->when($this->input('userType') == 'broker' , function ($query){
                        return $query->where('model_type', 'User\Models\Broker');
                    })
                    ->where('created_at', '>', Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s'));
            })],
            'password' => 'required|string|max:191|confirmed',

        ];

    }

}
