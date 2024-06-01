<?php
namespace Admin\Actions\User\Broker;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\{
    Broker
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record = Broker::find($id);
        $image = $record->image;
        if($request->file('image'))
        {
            if (is_file($image)){
                FileTrait::RemoveSingleFile($image);
            }
            $image = FileTrait::storeSingleFile($request->file('image'), 'brokers');
        }
        $record->first_name    = $request->input('first_name');
        $record->last_name     = $request->input('last_name');
        $record->brokerage_firm_name  = $request->input('brokerage_firm_name');
        $record->email         = $request->input('email');
        $record->phone         = $request->input('phone');
        $record->date_of_birth = $request->input('date_of_birth');
        $record->image         = $image;
        $record->save();
    }
}
