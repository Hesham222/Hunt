<?php

namespace User\Http\Resources\Post\Reason;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReasonCollection extends ResourceCollection
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
    		array_push($data, new ReasonResource($record));
    	}
    	return $data;
    }
}
