<?php
namespace Admin\Actions\ProfileColour;
use Illuminate\Http\Request;
use Admin\Models\{
    ProfileColour
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record               = ProfileColour::find($id);
        $record->accountType  = $request->input('account_type');
        $record->colour       = $request->input('colour');
        $record->save();
    }
}
