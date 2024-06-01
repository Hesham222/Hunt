<?php

namespace User\Http\Resources\Image;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ImageCollection extends ResourceCollection
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
    		array_push($data, new ImageResource($record));
    	}
    	return $data;
    }
}
