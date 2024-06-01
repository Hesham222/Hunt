<?php

namespace User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Actions\Message\{
    Listing\MessageListingAction,
    Post\MessagePostAction,
    MessageAction,
    MessageDetailAction,
    RepliesAction
};
use User\Http\Requests\Message\{
    Listing\MessageListingRequest,
    Post\MessagePostRequest,
    MessageDetailRequest
};
use User\Http\Resources\Message\{
    Post\MessagePostResource,
    Listing\MessageListingResource,
    MessageCollection
};
use User\Actions\Individual\Profile\ReplayMessageAction;
use User\Http\Resources\Message\Individual\ReplayMessageResource;

class MessageController extends BaseResponse
{
    public function Message(Request $request,MessageAction $messageAction)
    {
        $user = auth($request->input('activeGuard'))->user();
        $record = $messageAction->execute($user,$request);

        return $this->response(200,'view your post messages', 200, [], 0, [
            'messages' => new MessageCollection($record),
        ]);
    }

    public function MessageDetail(Request $request,MessageDetailAction $messageDetailAction, RepliesAction $repliesAction)
    {
        $user = auth($request->input('activeGuard'))->user();

        $record = $messageDetailAction->execute($request);
        if(!$record)
            return $this->response(500, 'Failed, record not found .', 200);

        $replies = $repliesAction->execute($request,$user);

        if ($request->input('activeGuard') == 'individualApi'){
            if ($request->input('type') == 1){
                return $this->response(200,'your message post details', 200, [], 0, [
                    'message' => new MessagePostResource($record),
                    'replies' => $replies,
                ]);
            }elseif ($request->input('type') == 0){
                return $this->response(200,'your message post details', 200, [], 0, [
                    'message' => new MessageListingResource($record),
                    'replies' => $replies,
                ]);
            }


        }elseif ($request->input('activeGuard') == 'brokerApi'){

            if ($request->input('type') == 1){
                return $this->response(200,'your message post details', 200, [], 0, [
                    'message' => new MessagePostResource($record),
                    'replies' => $replies,
                ]);
            }elseif ($request->input('type') == 0){
                return $this->response(200,'your message post details', 200, [], 0, [
                    'message' => new MessageListingResource($record),
                    'replies' => $replies,
                ]);
            }

        }elseif($request->input('activeGuard') == 'developerApi'){
            if ($request->input('type') == 1){
                return $this->response(200,'your message post details', 200, [], 0, [
                    'message' => new MessagePostResource($record),
                    'replies' => $replies,
                ]);
            }elseif ($request->input('type') == 0){
                return $this->response(200,'your message post details', 200, [], 0, [
                    'message' => new MessageListingResource($record),
                    'replies' => $replies,
                ]);
            }
        }

    }


        public function messagePost(MessagePostRequest $request , MessagePostAction $sendAction){

            DB::beginTransaction();
            try {
                $user = auth($request->input('activeGuard'))->user();
                $record = $sendAction->execute($request, $user);
                DB::commit();
                return $this->response(200, 'The Message has been sent successfully.', 200, [], 0, [
                    'message' => new MessagePostResource($record),
                ]);
            }
            catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }
        }

    public function messageListing(MessageListingRequest $request , MessageListingAction $sendAction){

        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();
            $record = $sendAction->execute($request, $user);
            DB::commit();
            return $this->response(200, 'The Message has been sent successfully.', 200, [], 0, [
                'message' => new MessageListingResource($record),
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }

    }


    public function replayMessage(Request $request ,ReplayMessageAction $replayMessageAction ,\User\Actions\Broker\Profile\ReplayMessageAction $brokerAction,\User\Actions\Developer\Profile\ReplayMessageAction $developerAction){

        if ($request->input('activeGuard') == 'individualApi'){

            DB::beginTransaction();
            try {
                $user = auth($request->input('activeGuard'))->user();
                $record = $replayMessageAction->execute($request,$user);
                if(!$record)
                    return $this->response(500, 'Failed, record not found .', 200);
                DB::commit();
                return $this->response(200,'The Reply to Message Sent Successfully', 200, [], 0, [
                    'Individual Replay Message' => new ReplayMessageResource($record),
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }
        }elseif ($request->input('activeGuard') == 'brokerApi'){

            DB::beginTransaction();
            try {
                $user = auth($request->input('activeGuard'))->user();
                $record = $brokerAction->execute($request,$user);
                if(!$record)
                    return $this->response(500, 'Failed, record not found .', 200);
                DB::commit();
                return $this->response(200,'The Reply to Message Sent Successfully', 200, [], 0, [
                    'Broker Replay Message' => new ReplayMessageResource($record),
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }
        }else{
            DB::beginTransaction();
            try {
                $user = auth($request->input('activeGuard'))->user();
                $record = $developerAction->execute($request,$user);
                if(!$record)
                    return $this->response(500, 'Failed, record not found .', 200);
                DB::commit();
                return $this->response(200,'The Reply to Message Sent Successfully', 200, [], 0, [
                    'Developer Replay Message' => new ReplayMessageResource($record),
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }
        }

    }
}
