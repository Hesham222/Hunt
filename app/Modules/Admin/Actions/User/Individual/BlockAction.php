<?php
namespace Admin\Actions\User\Individual;
use Illuminate\Http\Request;
use Admin\Models\{
    Individual
};

class BlockAction
{
    public function execute(Request $request)
    {
        $record = Individual::find($request->resource_id);
        $record->status = $record->status !=='blocked' ? 'blocked' : 'notVerified';
        $record->save();
        return $record->id;
    }
}
