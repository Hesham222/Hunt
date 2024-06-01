<?php
namespace Admin\Actions\PostReport;;

use Illuminate\Http\Request;
use Admin\Models\Reports\{
    PostReport,
};
class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = PostReport::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
