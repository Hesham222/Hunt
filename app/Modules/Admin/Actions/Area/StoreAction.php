<?php
namespace Admin\Actions\Area;
use Illuminate\Http\Request;
use Admin\Models\{
    Area
};
class StoreAction
{
    public function execute(Request $request): void
    {
        $record =  Area::create([
            'en' => [
                'name'   => $request->input(['name_en']),
            ],
            'ar' => [
                'name'   => $request->input('name_ar'),
            ],
            'city_id'    => $request->input('city_id'),
            'created_by' => auth('admin')->user()->id,
        ]);

    }
}
