<?php
namespace User\Actions\Listing;

use Admin\Models\Listings\Listing;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use User\Models\PostImage;

class UpdateAction
{
    public function execute(Request $request,$user)
    {

        $record        = Listing::find($request->input('listingId'));
        if ($record->developer_id == Null){
            if ($record->broker_id == $user->id){
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

                if ($request['image']){

                    PostImage::where('model_id',$record->id)->delete();

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
                }

                if ($request['imageId']){
                    foreach ($request['imageId'] as $key => $value) {

                        FileTrait::RemoveSingleFile($value);
                        PostImage::where('id',$value)->delete();

                    }
                }
                return $record;
            }

        }else{
            if ($record->developer_id == $user->id) {
                $record->developer = $request->input('developer');
                $record->rooms = $request->input('rooms');
                $record->size_of_property = $request->input('size_of_property');
                $record->payment = $request->input('payment');
                $record->in_a_compound = $request->input('in_a_compound');
                $record->start_down_payment = $request->input('start_down_payment');
                $record->end_down_payment = $request->input('end_down_payment');
                $record->start_monthly_installment = $request->input('start_monthly_installment');
                $record->end_monthly_installment = $request->input('end_monthly_installment');
                $record->start_payment_duration = $request->input('start_payment_duration');
                $record->end_payment_duration = $request->input('end_payment_duration');
                $record->start_price = $request->input('start_price');
                $record->end_price = $request->input('end_price');
                $record->delivery_date = $request->input('delivery_date');
                $record->title = $request->input('title');
                $record->listing_completion_id = $request->input('listing_completion_id');
                $record->city_id = $request->input('city_id');
                $record->area_id = $request->input('area_id');
                $record->listing_type_id = $request->input('listing_type_id');
                $record->listing_sale_id = $request->input('listing_sale_id');
                $record->listing_reason_id = $request->input('listing_reason_id');
                $record->listing_status_id = $request->input('listing_status_id');
                $record->save();


                if ($request['image']){

                    PostImage::where('model_id',$record->id)->delete();

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
                }

                if ($request['imageId']){
                    foreach ($request['imageId'] as $key => $value) {

                        FileTrait::RemoveSingleFile($value);
                        PostImage::where('id',$value)->delete();

                    }
                }
                return $record;
            }

            }


    }
}
