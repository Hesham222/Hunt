<?php
namespace Admin\Actions\Area;
use Illuminate\Http\Request;
use Admin\Models\{
    Area
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Area::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
