<?php
namespace Admin\Actions\User\Individual;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\{
    Individual
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record        = Individual::find($id);
        $image = $record->image;
        $file = ($request->file('image'));
        if(!is_null($file))
        {
            if (is_file($image)){
                FileTrait::RemoveSingleFile($image);
            }
            $image = FileTrait::storeSingleFile($request->file('image'), 'individuals');
        }
        $record->first_name    = $request->input('first_name');
        $record->last_name     = $request->input('last_name');
        $record->email         = $request->input('email');
        $record->phone         = $request->input('phone');
        $record->date_of_birth = $request->input('date_of_birth');
        $record->image = $image;
        $record->save();
    }
}
