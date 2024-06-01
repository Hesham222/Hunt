<?php

namespace User\Http\Resources\Post\Completion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompletionCollection extends ResourceCollection
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
    		array_push($data, new CompletionResource($record));
    	}
    	return $data;
    }
}
