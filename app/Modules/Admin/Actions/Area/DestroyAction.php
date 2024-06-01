<?php
namespace Admin\Actions\Area;;
use Illuminate\Http\Request;

use Admin\Models\{
    Area
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Area::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
