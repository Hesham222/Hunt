<?php
namespace User\Actions\Broker\Profile;

use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class UpdateAction
{
    public function execute(Request $request,$user)
    {
        $image = $user->image;

        $file = ($request->file('image'));
        if(!is_null($file))
        {
            if (is_file($image)){
                FileTrait::RemoveSingleFile($image);
            }
            $image = FileTrait::storeSingleFile($request->file('image'), 'individuals');
        }
        $user->first_name           = $request->input('first_name');
        $user->last_name            = $request->input('last_name');
        $user->brokerage_firm_name  = $request->input('brokerage_firm_name');
        $user->email                = $request->input('email');
        $user->phone                = $request->input('phone');
        $user->date_of_birth        = $request->input('date_of_birth');
        $user->image = $image;
        $user->save();

        return $user;
    }
}
