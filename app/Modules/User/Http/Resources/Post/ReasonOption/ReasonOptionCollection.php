<?php

namespace User\Http\Resources\Post\ReasonOption;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReasonOptionCollection extends ResourceCollection
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
    		array_push($data, new ReasonOptionResource($record));
    	}
    	return $data;
    }
}