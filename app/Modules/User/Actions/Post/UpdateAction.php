<?php
namespace User\Actions\Post;

use Admin\Models\Posts\Post;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use User\Models\PostImage;

class UpdateAction
{
    public function execute(Request $request,$user)
    {

            $record        = Post::find($request->input('postId'));
        if ($record->individual_id == $user->id){

            $record->developer                 = $request->input('developer');
            $record->rooms                     = $request->input('rooms');
            $record->size_of_property          = $request->input('size_of_property');
            $record->payment                   = $request->input('payment');
            $record->in_a_compound             = $request->input('in_a_compound');
            $record->start_down_payment        = $request->input('start_down_payment');
            $record->end_down_payment          = $request->input('end_down_payment');
            $record->start_monthly_installment = $request->input('start_monthly_installment');
            $record->end_monthly_installment   = $request->input('end_monthly_installment');
            $record->start_payment_duration    = $request->input('start_payment_duration');
            $record->end_payment_duration      = $request->input('end_payment_duration');
            $record->start_price               = $request->input('start_price');
            $record->end_price                 = $request->input('end_price');
            $record->delivery_date             = $request->input('delivery_date');
            $record->description               = $request->input('description');
            $record->post_completion_id        = $request->input('post_completion_id');
            $record->city_id                   = $request->input('city_id');
            $record->area_id                   = $request->input('area_id');
            $record->post_type_id              = $request->input('post_type_id');
            $record->post_sale_id              = $request->input('post_sale_id');
            $record->post_reason_id            = $request->input('post_reason_id');
            $record->post_reason_option_id     = $request->input('post_reason_option_id');
            $record->save();

            if ($request['image']){
                PostImage::where('model_id',$record->id)->delete();

                foreach ($request['image'] as $key => $value) {

                    $image = FileTrait::storeSingleFile($value, 'posts');
                    if(!empty($value)){
                        $post_image = new PostImage();
                        $post_image->attachment   = $image;
                        $post_image->model_type   = 'Post';
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
