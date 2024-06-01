<?php
namespace Admin\Actions\City;
use Illuminate\Http\Request;
use Admin\Models\{
    City
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = City::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        foreach($record->areas as $area)
        {
            $area->deleted_by = auth('admin')->user()->id;
            $area->save();
            $area->delete();
        }
        $record->save();
        $record->delete();
        return $record->id;
    }
}
