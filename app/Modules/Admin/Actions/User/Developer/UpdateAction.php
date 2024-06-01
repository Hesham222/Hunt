<?php
namespace Admin\Actions\User\Developer;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\{
    Developer
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record = Developer::find($id);
        $image = $record->image;
        if($request->file('image'))
        {
            if (is_file($image)){
                FileTrait::RemoveSingleFile($image);
            }
            $image = FileTrait::storeSingleFile($request->file('image'), 'developers');
        }
        $record->first_name      = $request->input('first_name');
        $record->last_name       = $request->input('last_name');
        $record->developer_name  = $request->input('developer_name');
        $record->email           = $request->input('email');
        $record->phone           = $request->input('phone');
        $record->date_of_birth   = $request->input('date_of_birth');
        $record->image           = $image;
        $record->save();
    }
}
