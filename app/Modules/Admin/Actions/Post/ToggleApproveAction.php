<?php
namespace Admin\Actions\Post;;
use Illuminate\Http\Request;
use Admin\Models\Posts\{
    Post
};

class ToggleApproveAction
{
    public function execute(Request $request, $action)
    {
        $record = Post::withTrashed()->find($request->resource_id);
        if($action)
            $record->post_status_id = 2;
        else
            $record->post_status_id = 3;
        $record->save();
        return $record->id;
    }
}
