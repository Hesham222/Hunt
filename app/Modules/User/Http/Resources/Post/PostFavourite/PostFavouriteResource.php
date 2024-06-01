<?php

namespace User\Http\Resources\Post\PostFavourite;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Individual\IndividualResource;
use User\Http\Resources\Listing\ListingResource;
use User\Http\Resources\Post\PostResource;

class PostFavouriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->post_id){
            return [
                'id'            => intval($this->id),
                'post_id'       => $this->post_id,
                'Post'          => new PostResource($this->post),
                'individual_id' => $this->individual_id,
            ];
        }elseif ($this->listing_id){
            return [
                'id'                => intval($this->id),
                'listing_id'        => $this->listing_id,
                'Listing'           => new ListingResource($this->listing),
                'individual_id'     => $this->individual_id,


            ];
        }

    }
}
