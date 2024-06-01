<?php

namespace User\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use User\Actions\Developer\RegisterAction;

use User\Http\Requests\Developer\RegisterRequest;
use User\Models\UserVerification;

class DeveloperRegisterController extends BaseResponse
{
    public function __invoke(RegisterRequest $request, RegisterAction $registerAction)
    {
        DB::beginTransaction();
        try {
            $record = $registerAction->execute($request);
            $code = rand(1000,9999);
            UserVerification::create([
                'code'               => $code,
                'model_id'           => $record->id,
                'model_type'         => 'Admin\Models\Developer',
                'codeType'           => 'Verify',
            ]);
            //Mail::to($record)->send(new VerifyUser($record, $code));
            //$this->smsService->sendSMS($record->phone, $code . ' is your code');
            DB::commit();
            return $this->response(200, 'Verification code has been sent successfully. ', 200, [], $record->id,
                [
                    'userType'      => 'developer',
                ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
}
