<?php
namespace Admin\Actions\User\Broker;
use Illuminate\Http\Request;
use Admin\Models\{
    Broker
};

class BlockAction
{
    public function execute(Request $request)
    {
        $record = Broker::find($request->resource_id);
        $record->status = $record->status !=='blocked' ? 'blocked' : 'notVerified';
        $record->save();
        return $record->id;
    }
}
