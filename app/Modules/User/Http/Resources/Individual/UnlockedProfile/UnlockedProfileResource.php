<?php

namespace User\Http\Resources\Individual\UnlockedProfile;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Post\PostCollection;

class UnlockedProfileResource extends JsonResource
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
            'email'                 => $this->email,
            'phone'                 => $this->phone,
            'public'                => $this->getPublic(),
            'dateOfBirth'           => $this->date_of_birth,
            'image'                 => $this->image ? asset('storage'.DS() . $this->image) : null,
            'rate'                  => $this->current_rate,
            'type'                  => 'Individual',
            'posts'                 => new PostCollection($this->posts),
        ];
    }
}
