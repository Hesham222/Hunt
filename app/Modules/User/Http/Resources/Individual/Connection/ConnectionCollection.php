<?php

namespace User\Http\Resources\Individual\Connection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConnectionCollection extends ResourceCollection
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
    		array_push($data, new ConnectionResource($record));
    	}
    	return $data;
    }
}
