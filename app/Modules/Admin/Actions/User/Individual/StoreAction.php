<?php
namespace Admin\Actions\User\Individual;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\{
    Individual
};
class StoreAction
{
    public function execute(Request $request): void
    {
        $image = FileTrait::storeSingleFile($request->file('image'), 'individuals');

        $record =  Individual::create([
            'first_name'      => $request->input('first_name'),
            'last_name'       => $request->input('last_name'),
            'email'           => $request->input('email'),
            'phone'           => $request->input('phone'),
            'image'           => $image,
            'date_of_birth'   => $request->input('date_of_birth'),
            'password'        => bcrypt($request->input('password')),
            'created_by'      => auth('admin')->user()->id,
        ]);

    }
}
