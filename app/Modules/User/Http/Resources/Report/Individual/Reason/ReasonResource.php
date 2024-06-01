<?php

namespace User\Http\Resources\Report\Individual\Reason;

use Illuminate\Http\Resources\Json\JsonResource;
class ReasonResource extends JsonResource
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
            'name'  => $this->reason,
        ];
    }
}
