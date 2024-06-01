<?php

namespace User\Http\Resources\BrokerDeveloper;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Listing\ListingCollection;

class BrokerDeveloperProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->input('type') == 1){
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
                'listings'              =>  new ListingCollection($this->listings),

            ];
        }elseif ($request->input('type') == 0){
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
                'listings'              =>  new ListingCollection($this->listings),

            ];
        }

    }
}
