<?php
namespace Admin\Actions\User\Individual;;
use Illuminate\Http\Request;
use Admin\Models\{
    Individual
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Individual::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
