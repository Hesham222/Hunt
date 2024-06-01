<?php

namespace User\Http\Resources\Message\Post;
use Admin\Models\Posts\Post;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Image\ImageCollection;
use User\Http\Resources\Individual\IndividualResource;
use User\Http\Resources\Post\PostResource;

class MessagePostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
             if ($this->individual_id){
                 return [
                     'id'                => intval($this->id),
                     'user'              => new IndividualResource($this->individual),
                     'title'             => $this->title,
                     'message'           => $this->message,
                     'createdDate'       => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
                     'images'            => $this->checkImage() == 'post'?new ImageCollection($this->images) : Null,
                     'post'              => new PostResource($this->post),

                 ];
             }elseif ($this->broker_id){
                 return [
                     'id'                => intval($this->id),
                     'user'              => new BrokerResource($this->broker),
                     'title'             => $this->title,
                     'message'           => $this->message,
                     'createdDate'       => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
                     'images'            => $this->checkImage() == 'post'?new ImageCollection($this->images) : Null,
                     'post'              => new PostResource($this->post),


                 ];
             }else{
                 return [
                     'id'                => intval($this->id),
                     'user'              => new DeveloperResource($this->developer),
                     'title'             => $this->title,
                     'message'           => $this->message,
                     'createdDate'       => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
                     'images'            => $this->checkImage() == 'post'?new ImageCollection($this->images) : Null,
                     'post'              => new PostResource($this->post),

                 ];
             }
    }
}
