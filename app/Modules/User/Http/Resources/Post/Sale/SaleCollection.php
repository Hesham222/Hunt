<?php

namespace User\Http\Resources\Post\Sale;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SaleCollection extends ResourceCollection
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
    		array_push($data, new SaleResource($record));
    	}
    	return $data;
    }
}
