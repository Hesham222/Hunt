<?php

namespace User\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use User\Http\Requests\ChangePasswordRequest;
class ChangePasswordController extends BaseResponse
{
    public function __invoke(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();
            if (Hash::check($request->input('currentPassword'), $user->password))
            {
                $user->password = bcrypt($request->input('newPassword'));
                $user->save();
                DB::commit();
                return $this->response(200, 'The Password has been changed successfully', 200);
            }
            return $this->response(101, 'Validation Error', 200, ['The old password is invalid']);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

}
