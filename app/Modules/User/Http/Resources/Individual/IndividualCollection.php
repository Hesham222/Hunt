<?php

namespace User\Http\Resources\Individual;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndividualCollection extends ResourceCollection
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
    		array_push($data, new IndividualResource($record));
    	}
    	return $data;
    }
}
