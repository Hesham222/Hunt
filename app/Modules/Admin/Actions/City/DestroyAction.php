<?php
namespace Admin\Actions\City;;
use Illuminate\Http\Request;
use Admin\Models\{
    City
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = City::withTrashed()->find($id);
        if(!$record)
            return false;
        foreach($record->areasWithTrashed as $area)
            $area->forceDelete();
        $record->forceDelete();
        return $request->resource_id;
    }
}
