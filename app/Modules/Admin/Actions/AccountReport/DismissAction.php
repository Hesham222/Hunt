<?php
namespace Admin\Actions\AccountReport;
use Illuminate\Http\Request;
use Admin\Models\Reports\{
    AccountReport
};

class DismissAction
{
    public function execute(Request $request)
    {
        $record = AccountReport::find($request->resource_id);
        $record->status = $record->status !=='Dismissed' ? 'Dismissed' : 'Pending';
        $record->save();
        return $record->id;
    }
}
