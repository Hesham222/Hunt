<?php

namespace User\Http\Resources\Broker;

use Illuminate\Http\Resources\Json\JsonResource;

class BrokerResource extends JsonResource
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
            'email'                 => $this->email,
            'phone'                 => $this->phone,
            'dateOfBirth'           => $this->date_of_birth,
            'firmName'              => $this->brokerage_firm_name,
            'image'                 => $this->image ? asset('storage'.DS() . $this->image) : null,
            'rate'                  => $this->current_rate,
            'Type'                  => 'Broker',
        ];
    }
}
