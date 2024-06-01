<?php
namespace Admin\Actions\AccountReport;;
use Illuminate\Http\Request;
use Admin\Models\Reports\{
    AccountReport,
};
class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = AccountReport::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
