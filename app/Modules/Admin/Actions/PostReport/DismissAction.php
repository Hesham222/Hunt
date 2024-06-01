<?php
namespace Admin\Actions\PostReport;
use Illuminate\Http\Request;
use Admin\Models\Reports\{
    PostReport
};

class DismissAction
{
    public function execute(Request $request)
    {
        $record = PostReport::find($request->resource_id);
        $record->status = $record->status !=='Dismissed' ? 'Dismissed' : 'Pending';
        $record->save();
        return $record->id;
    }
}
