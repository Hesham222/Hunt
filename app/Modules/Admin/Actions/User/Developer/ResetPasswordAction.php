<?php
namespace Admin\Actions\User\Developer;;
use Illuminate\Http\Request;
use Admin\Models\{
    Developer
};

class ResetPasswordAction
{
    public function execute(Request $request): void
    {
        $record = Developer::find($request->resource_id);
        $record->password            = bcrypt($request->password);
        $record->save();
    }
}
