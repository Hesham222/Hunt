<?php
namespace Admin\Actions\PostReport;;
use Illuminate\Http\Request;
use Admin\Models\Reports\{
    PostReport
};

class ToggleApproveAction
{
//    public function execute(Request $request, $action)
//    {
//        $record = PostReport::withTrashed()->find($request->resource_id);
//        if($action)
//            $record->post_report_status_id = 2;
//        else
//            $record->post_report_status_id = 3;
//        $record->save();
//        return $record->id;
//    }
}
