<?php

namespace User\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use User\Actions\Individual\RegisterAction;

use User\Http\Controllers\BaseResponse;
use User\Http\Requests\Individual\RegisterRequest;
use User\Models\UserVerification;

class IndividualRegisterController extends BaseResponse
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
                'model_type'         => 'Admin\Models\Individual',
                'codeType'           => 'Verify',
            ]);
            //Mail::to($record)->send(new VerifyUser($record, $code));
            //$this->smsService->sendSMS($record->phone, $code . ' is your code');
            DB::commit();
            return $this->response(200, 'Verification code has been sent successfully. ', 200, [], $record->id,
                [
                    'userType'      => 'individual',
                ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
}
