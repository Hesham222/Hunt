<?php
namespace Admin\Actions\User\Individual;;
use Illuminate\Http\Request;
use Admin\Models\{
    Individual
};

class ResetPasswordAction
{
    public function execute(Request $request): void
    {
        $record = Individual::find($request->resource_id);
        $record->password            = bcrypt($request->password);
        $record->save();
    }
}
