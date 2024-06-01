<?php

namespace User\Http\Resources\Message;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Image\ImageCollection;
use User\Http\Resources\Individual\IndividualResource;
use User\Http\Resources\Listing\ListingResource;
use User\Http\Resources\Post\PostResource;


class MessageResource extends JsonResource
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
                'images'            => $this->checkImage() == 'post'?new ImageCollection($this->images) : new ImageCollection($this->images),
                'post'              => $this->post_id ? new PostResource($this->post):null,
                'listing'           => $this->listing_id ? new ListingResource($this->Listing):null,
            ];
        }elseif ($this->broker_id){
            return [
                'id'                => intval($this->id),
                'user'              => new BrokerResource($this->broker),
                'title'             => $this->title,
                'message'           => $this->message,
                'createdDate'       => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
                'images'            => $this->checkImage() == 'post'?new ImageCollection($this->images) : new ImageCollection($this->images),
                'post'              => $this->post_id ? new PostResource($this->post):null,
                'listing'           => $this->listing_id ? new ListingResource($this->Listing):null,
            ];
        }else{
            return [
                'id'                 => intval($this->id),
                'user'              => new DeveloperResource($this->developer),
                'title'             => $this->title,
                'message'           => $this->message,
                'createdDate'       => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
                'images'            => $this->checkImage() == 'post'?new ImageCollection($this->images) : new ImageCollection($this->images),
                'post'              => $this->post_id ? new PostResource($this->post):null,
                'listing'           => $this->listing_id ? new ListingResource($this->Listing):null,
            ];
        }

    }
}
