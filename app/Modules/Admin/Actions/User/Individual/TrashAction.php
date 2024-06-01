<?php
namespace Admin\Actions\User\Individual;
use Illuminate\Http\Request;
use Admin\Models\{
    Individual
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Individual::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
