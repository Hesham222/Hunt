<?php

namespace User\Http\Resources\Report\Post;
use Illuminate\Http\Resources\Json\ResourceCollection;
class ReportPostCollection extends ResourceCollection
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
    		array_push($data, new ReportPostResource($record));
    	}
    	return $data;
    }
}
