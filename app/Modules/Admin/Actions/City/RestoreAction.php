<?php
namespace Admin\Actions\City;;
use Illuminate\Http\Request;
use Admin\Models\{
    City
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = City::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        foreach($record->areasOnlyTrashed as $area)
        {
            $area->deleted_by = null;
            $area->restore();
            $area->save();
        }
        $record->save();
        $record->restore();
        return $record->id;
    }
}
