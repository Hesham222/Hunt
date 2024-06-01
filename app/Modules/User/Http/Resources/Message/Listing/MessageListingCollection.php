<?php

namespace User\Http\Resources\Message\Listing;
use Illuminate\Http\Resources\Json\ResourceCollection;
class MessageListingCollection extends ResourceCollection
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
    		array_push($data, new MessageListingResource($record));
    	}
    	return $data;
    }
}
