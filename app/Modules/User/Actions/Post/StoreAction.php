<?php
namespace User\Actions\Post;

use Admin\Models\Posts\Post;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use User\Models\PostImage;

class StoreAction
{
    public function execute(Request $request,$user)
    {

        $record = Post::create([
            'individual_id'             => $user->id,
            'post_reason_id'            => $request->input('post_reason_id'),
            'post_reason_option_id'     => $request->input('post_reason_option_id'),
            'city_id'                   => $request->input('city_id'),
            'area_id'                   => $request->input('area_id'),
            'post_type_id'              => $request->input('post_type_id'),
            'in_a_compound'             => $request->input('in_a_compound'),
            'start_price'               => $request->input('start_price'),
            'end_price'                 => $request->input('end_price'),
            'post_sale_id'              => $request->input('post_sale_id'),
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
            'description'               => $request->input('description'),
            'post_completion_id'        => $request->input('post_completion_id'),
            'post_status_id'            => 1,
        ]);


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
        return $record;
    }
}
