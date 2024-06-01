<?php

namespace User\Http\Resources\PostListing;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostListingGuestCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    	$data = [];
    	foreach ($this->collection as $record) {
    		array_push($data, new PostListingGuestResource($record));
    	}
    	return $data;
    }
}
