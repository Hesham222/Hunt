<?php
namespace Admin\Actions\User\Developer;
use Illuminate\Http\Request;
use Admin\Models\{
    Developer
};

class BlockAction
{
    public function execute(Request $request)
    {
        $record = Developer::find($request->resource_id);
        $record->status = $record->status !=='blocked' ? 'blocked' : 'notVerified';
        $record->save();
        return $record->id;
    }
}
