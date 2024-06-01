<?php
namespace Admin\Actions\City;
use Illuminate\Http\Request;
use Admin\Models\{
    City
};
class StoreAction
{
    public function execute(Request $request): void
    {
         City::create([
            'en'    => [
                'name'             => $request->input('name_en'),
            ],
            'ar'     => [
                'name'              => $request->input('name_ar'),
            ],
            'created_by' => auth('admin')->user()->id,
        ]);

    }
}



