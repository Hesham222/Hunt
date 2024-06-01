<?php

namespace User\Http\Resources\Listing\ListingFavourite;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Individual\IndividualResource;
use User\Http\Resources\Listing\ListingResource;

class ListingFavouriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => intval($this->id),
            'listing_id'        => $this->listing_id,
            'Listing'           => new ListingResource($this->listing),
            'individual_id'     => $this->individual_id,
            'Individual'        => new IndividualResource($this->individual),


        ];
    }
}
