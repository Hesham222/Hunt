<?php
namespace User\Actions\Broker;

use Admin\Models\Broker;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class RegisterAction
{
    public function execute(Request $request)
    {
        $image = FileTrait::storeSingleFile($request->file('image'),'brokers');
        $user = Broker::create([
            'first_name'           => $request->input('firstName'),
            'last_name'            => $request->input('lastName'),
            'phone'                => $request->input('phone'),
            'email'                => $request->input('email'),
            'brokerage_firm_name'  => $request->input('firmName'),
            'date_of_birth'        => $request->input('dateOfBirth'),
            'password'             => bcrypt($request->input('password')),
            'image'                 => $image,
        ]);
        return $user;
    }
}
