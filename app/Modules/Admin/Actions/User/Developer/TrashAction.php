<?php
namespace Admin\Actions\User\Developer;
use Illuminate\Http\Request;
use Admin\Models\{
    Developer
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Developer::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
