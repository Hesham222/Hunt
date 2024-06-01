<?php
namespace Admin\Actions\Listing;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\Listings\{
    Listing
};
class UpdateAction
{
    public function execute(Request $request,$id): void
    {
        $record                             = Listing::find($id);
        $record->developer                  = $request->input('developer');
        $record->rooms                      = $request->input('rooms');
        $record->size_of_property           = $request->input('size_of_property');
        $record->payment                    = $request->input('payment');
        $record->in_a_compound              = $request->input('in_a_compound');
        $record->start_down_payment         = $request->input('start_down_payment');
        $record->end_down_payment           = $request->input('end_down_payment');
        $record->start_monthly_installment  = $request->input('start_monthly_installment');
        $record->end_monthly_installment    = $request->input('end_monthly_installment');
        $record->start_payment_duration     = $request->input('start_payment_duration');
        $record->end_payment_duration       = $request->input('end_payment_duration');
        $record->start_price                = $request->input('start_price');
        $record->end_price                  = $request->input('end_price');
        $record->delivery_date              = $request->input('delivery_date');
        $record->title                      = $request->input('title');
        $record->listing_completion_id      = $request->input('listing_completion_id');
        $record->city_id                    = $request->input('city_id');
        $record->area_id                    = $request->input('area_id');
        $record->listing_type_id            = $request->input('listing_type_id');
        $record->listing_sale_id            = $request->input('listing_sale_id');
        $record->listing_reason_id          = $request->input('listing_reason_id');
        $record->listing_status_id          = $request->input('listing_status_id');
        $record->save();

        foreach ($record->images as $image)
        {
            $file = $request->file('attachment-'.$image->id);

            if (!is_null($file))
            {
                FileTrait::RemoveSingleFile($image->attachment);
                $newFile = FileTrait::storeSingleFile($file,'listings');
                $image->attachment = $newFile;
            }
            $image->save();
        }
    }
}