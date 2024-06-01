<?php

namespace User\Http\Resources\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use User\Http\Resources\NotificationResource;

class NotificationCollection extends ResourceCollection
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
    	foreach ($this->collection as $notification) {
    		array_push($data, new NotificationResource($notification));
    	}
    	return $data;
    }
}
