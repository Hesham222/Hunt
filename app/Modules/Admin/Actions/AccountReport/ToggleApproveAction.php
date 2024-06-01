<?php
namespace Admin\Actions\AccountReport;;
use Illuminate\Http\Request;
use Admin\Models\Reports\{
    AccountReport
};

class ToggleApproveAction
{
    public function execute(Request $request, $action)
    {
        $record = AccountReport::withTrashed()->find($request->resource_id);
        if($action)
            $record->post_report_status_id = 2;
        $record->save();
        return $record->id;
    }
}
