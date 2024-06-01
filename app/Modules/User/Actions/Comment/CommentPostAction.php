<?php
namespace User\Actions\Comment;

use Admin\Models\Comments\Comment;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;

class CommentPostAction
{
    public function execute(Request $request,$user)
    {
        $image = FileTrait::storeSingleFile($request->file('image'), 'comments');

        $record = Comment::create([
            'broker_id'                 => $request->input('activeGuard')=='brokerApi'?$user->id:null,
            'developer_id'              => $request->input('activeGuard')=='developerApi'?$user->id:null ,
            'individual_id'             => $request->input('activeGuard')=='individualApi'?$user->id:null ,
            'post_id'                   => $request->input('post_id'),
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
            'image'                     => $image,
            'description'               => $request->input('description'),
            'post_completion_id'        => $request->input('post_completion_id'),
            'post_status_id'            => $request->input('post_status_id'),
        ]);

        return $record;
    }
}
