<?php

namespace User\Http\Resources\Individual\LockedProfile;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Post\PostCollection;

class LockedProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                    => intval($this->id),
            'name'                  => $this->first_name." ".$this->last_name,
            'rate'                  => $this->current_rate,
            'image'                 => null,
            'type'                  => 'Individual',
            'posts'                 =>  new PostCollection($this->posts),
        ];
    }
}
