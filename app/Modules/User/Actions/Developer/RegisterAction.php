<?php
namespace User\Actions\Developer;

use Admin\Models\Developer;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class RegisterAction
{
    public function execute(Request $request)
    {
        $image = FileTrait::storeSingleFile($request->file('image'),'developers');
        $user = Developer::create([
            'first_name'           => $request->input('firstName'),
            'last_name'            => $request->input('lastName'),
            'phone'                => $request->input('phone'),
            'email'                => $request->input('email'),
            'developer_name'       => $request->input('developerName'),
            'date_of_birth'        => $request->input('dateOfBirth'),
            'password'             => bcrypt($request->input('password')),
            'image'                => $image,
        ]);
        return $user;
    }
}
