<?php

namespace User\Http\Requests\Auth;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use User\Http\Requests\BaseRequest;
use User\Models\UserVerification;

class VerifyUserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'userId' => ['required'],
            'deviceType' => 'required|in:Web,Android,IOS',
            'firebaseToken' => 'nullable|string|max:65000',
            'userType' => 'required|in:broker,developer,individual',
            'code' => ['required', 'string', Rule::exists('user_verifications')->where(function ($query) {
                $query->where('id', UserVerification::where('model_id', $this->input('userId'))->orderBy('created_at', 'desc')->value('id'))
                    ->where('codeType', 'Verify')
                    ->when($this->input('userType') == 'broker' , function ($query){
                        return $query->where('model_type', 'Admin\Models\Broker');
                    })
                    ->when($this->input('userType') == 'developer' , function ($query){
                        return $query->where('model_type', 'Admin\Models\Developer');
                    })
                    ->when($this->input('userType') == 'individual' , function ($query){
                        return $query->where('model_type', 'Admin\Models\Individual');
                    })
                    ->where('created_at', '>', Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s'));
            })],
        ];
    }
}
