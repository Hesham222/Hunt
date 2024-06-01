<?php
namespace Admin\Actions\Comment;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\{
    Comment
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record        = Comment::find($id);
        $record->individual_id  = $request->input('individual_id');
        $record->broker_id  = $request->input('broker_id');
        $record->developer_id  = $request->input('developer_id');
        $record->post_id  = $request->input('post_id');
        $record->translate('en')->description  = $request->input(['description']);
        $record->save();
    }
}
