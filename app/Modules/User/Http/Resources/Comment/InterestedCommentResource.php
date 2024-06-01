<?php

namespace User\Http\Resources\Comment;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Individual\IndividualResource;
use User\Http\Resources\Post\PostResource;

class InterestedCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->input('activeGuard') == 'individualApi') {
            return [
                'id'                        => intval($this->id),
                'user'                      => new IndividualResource($this->Individual),
                'post'                      => $this->post_id,
                'comment'                   => $this->comment,
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }elseif ($request->input('activeGuard') == 'brokerApi'){
            return [
                'id'                        => intval($this->id),
                'user'                      => new BrokerResource($this->Broker),
                'post'                      => $this->post_id,
                'comment'                   => $this->comment,
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }elseif ($request->input('activeGuard') == 'developerApi'){
            return [
                'id'                        => intval($this->id),
                'user'                      => new DeveloperResource($this->Developer),
                'post'                      => $this->post_id,
                'comment'                   => $this->comment,
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }

    }
}
