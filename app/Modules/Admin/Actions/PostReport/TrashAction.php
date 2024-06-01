<?php
namespace Admin\Actions\PostReport;
use Illuminate\Http\Request;
use Admin\Models\Reports\{
    PostReport
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = PostReport::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
