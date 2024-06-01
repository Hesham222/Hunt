<?php

namespace User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Actions\Comment\{
    CommentPostAction,
    InterestedCommentAction,
};
use User\Http\Requests\Comment\{
    CommentPostRequest,
    InterestedCommentRequest,
};
use User\Http\Resources\Comment\{
    CommentResource,
};
use User\Http\Resources\Comment\InterestedCommentResource;

class CommentController extends BaseResponse
{

        public function commentPost(CommentPostRequest $request , CommentPostAction $sendAction){

            DB::beginTransaction();
            try {
                $user = auth($request->input('activeGuard'))->user();
                $record = $sendAction->execute($request, $user);
                //return $record;
                DB::commit();
                return $this->response(200, 'The Comment has been sent successfully.', 200, [], 0, [
                    'comment' => new CommentResource($record),
                ]);
            }
            catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }

        }

    public function InterestedComment(Request $request , InterestedCommentAction $interestedCommentAction){

        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();
            $record = $interestedCommentAction->execute($request, $user);
            if ($record){
                DB::commit();
                return $this->response(200, 'The Comment has been sent successfully.', 200, [], 0, [
                    'comment' => new InterestedCommentResource($record),
                ]);
            }else{
                return $this->response(200, 'This Post Reason not looking for renter Or looking to sell.', 200, [], 0, [

                ]);
            }
            //return $record;

        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }

    }

}
