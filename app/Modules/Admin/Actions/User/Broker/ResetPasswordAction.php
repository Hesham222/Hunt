<?php
namespace Admin\Actions\User\Broker;;
use Illuminate\Http\Request;
use Admin\Models\{
    Broker
};

class ResetPasswordAction
{
    public function execute(Request $request): void
    {
        $record = Broker::find($request->resource_id);
        $record->password            = bcrypt($request->password);
        $record->save();
    }
}
