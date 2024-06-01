<?php
namespace User\Actions\Listing;

use Admin\Models\Listings\Listing;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use User\Models\PostImage;

class StoreAction
{
    public function execute(Request $request,$user)
    {

        $record = Listing::create([

            'broker_id'                 => $request->input('activeGuard')=='brokerApi'?$user->id:null,
            'developer_id'              => $request->input('activeGuard')=='developerApi'?$user->id:null ,
            'listing_reason_id'         => $request->input('listing_reason_id'),
            'listing_status_id'         => $request->input('listing_status_id'),
            'city_id'                   => $request->input('city_id'),
            'area_id'                   => $request->input('area_id'),
            'listing_type_id'           => $request->input('listing_type_id'),
            'in_a_compound'             => $request->input('in_a_compound'),
            'start_price'               => $request->input('start_price'),
            'end_price'                 => $request->input('end_price'),
            'listing_sale_id'           => $request->input('listing_sale_id'),
            'developer'                 => $request->input('developer'),
            'rooms'                     => $request->input('rooms'),
            'size_of_property'          => $request->input('size_of_property'),
            'start_down_payment'        => $request->input('start_down_payment'),
            'end_down_payment'          => $request->input('end_down_payment'),
            'start_monthly_installment' => $request->input('start_monthly_installment'),
            'end_monthly_installment'   => $request->input('end_monthly_installment'),
            'payment'                   => $request->input('payment'),
            'start_payment_duration'    => $request->input('start_payment_duration'),
            'end_payment_duration'      => $request->input('end_payment_duration'),
            'delivery_date'             => $request->input('delivery_date'),
            'title'                     => $request->input('title'),
            'listing_completion_id'     => $request->input('listing_completion_id'),
        ]);

        foreach ($request['image'] as $key => $value) {

            $image = FileTrait::storeSingleFile($value, 'listings');
            if(!empty($value)){
                $post_image = new PostImage();
                $post_image->attachment   = $image;
                $post_image->model_type   = 'Listing';
                $post_image->model_id     = $record->id;
                $post_image->save();
            }
        }
        return $record;
    }
}
