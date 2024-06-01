<?php

namespace User\Http\Resources\Developer;

use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperResource extends JsonResource
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
            'firstName'             => $this->first_name,
            'lastName'              => $this->last_name,
            'developerName'         => $this->developer_name,
            'email'                 => $this->email,
            'phone'                 => $this->phone,
            'dateOfBirth'           => $this->date_of_birth,
            'image'                 => $this->image ? asset('storage'.DS() . $this->image) : null,
            'rate'                  => $this->current_rate,
            'Type'                  => 'Developer',
        ];
    }
}
