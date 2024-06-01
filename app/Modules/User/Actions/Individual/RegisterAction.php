<?php
namespace User\Actions\Individual;

use Admin\Models\Individual;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class RegisterAction
{
    public function execute(Request $request)
    {
        $image = FileTrait::storeSingleFile($request->file('image'),'individuals');
        $user = Individual::create([
            'first_name'           => $request->input('firstName'),
            'last_name'            => $request->input('lastName'),
            'phone'                => $request->input('phone'),
            'email'                => $request->input('email'),
            'date_of_birth'        => $request->input('dateOfBirth'),
            'password'             => bcrypt($request->input('password')),
            'image'                => $image,
        ]);
        return $user;
    }
}
