<?php
namespace Admin\Actions\City;
use Illuminate\Http\Request;
use Admin\Models\{
    City
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record        = City::find($id);
        $record->translate('en')->name  = $request->input(['name_en']);
        $record->translate('ar')->name  = $request->input(['name_ar']);
        $record->save();
    }
}
