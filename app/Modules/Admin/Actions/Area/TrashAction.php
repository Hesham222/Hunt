<?php
namespace Admin\Actions\Area;
use Illuminate\Http\Request;
use Admin\Models\{
    Area
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Area::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
