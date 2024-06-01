<?php

namespace User\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use User\Http\Controllers\BaseResponse;
use Illuminate\Http\Request;

class LogoutController extends BaseResponse
{

    public function __invoke(Request $request)
    {
        DB::beginTransaction();
        try {
            $record = auth($request->input('activeGuard'))->user();
            $record->api_token = null;
            $record->save();
            DB::commit();
            return $this->response(200, "Logged out Successfully", 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }


}
