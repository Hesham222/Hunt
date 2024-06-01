<?php
namespace Admin\Actions\User\Developer;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\{
    Developer
};
class StoreAction
{
    public function execute(Request $request): void
    {
        $image = FileTrait::storeSingleFile($request->file('image'), 'developers');

        $record =  Developer::create([
            'first_name'      => $request->input('first_name'),
            'last_name'       => $request->input('last_name'),
            'developer_name'  => $request->input('developer_name'),
            'email'           => $request->input('email'),
            'phone'           => $request->input('phone'),
            'image'           => $image,
            'date_of_birth'   => $request->input('date_of_birth'),
            'password'        => bcrypt($request->input('password')),
            'created_by'      => auth('admin')->user()->id,
        ]);

    }
}
