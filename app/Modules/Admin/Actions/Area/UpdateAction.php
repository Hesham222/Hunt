<?php
namespace Admin\Actions\Area;
use Illuminate\Http\Request;
use Admin\Models\{
    Area
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record   = Area::find($id);
        $record->translate('en')->name  = $request->input(['name_en']);
        $record->translate('ar')->name  = $request->input(['name_ar']);
        $record->city_id                = $request->input('city_id');
        $record->save();
    }
}
