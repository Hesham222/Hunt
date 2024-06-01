<?php
namespace Admin\Actions\AccountReport;
use Illuminate\Http\Request;
use Admin\Models\Reports\{
    AccountReport
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = AccountReport::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
