<?php

namespace User\Http\Resources\Individual\Developer;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Listing\ListingCollection;

class DeveloperProfileResource extends JsonResource
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
            'Name'                  => $this->first_name." ".$this->last_name,
            'Type'                  => 'Developer',
            'Developer Name'        =>$this->developer_name,
            'email'                 => $this->email,
            'phone'                 => $this->phone,
            'dateOfBirth'           => $this->date_of_birth,
            'image'                 => $this->image ? asset('storage'.DS() . $this->image) : null,
            'listings'              => $this->listings,
        ];
    }
}
