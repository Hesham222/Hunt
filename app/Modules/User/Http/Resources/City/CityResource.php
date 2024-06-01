<?php

namespace User\Http\Resources\City;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Area\AreaCollection;
class CityResource extends JsonResource
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
            'id'    => intval($this->id),
            'name'  => $this->name,
            'areas' => new AreaCollection($this->areas),
        ];
    }
}
