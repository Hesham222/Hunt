<?php

namespace User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Image\ImageCollection;
use User\Http\Resources\Individual\IndividualResource;

class ReplayResource extends JsonResource
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
            'id'                => intval($this->id),
            //'individual_id'    => $this->individual_id ? $this->individual_id : null,
            'sender'            => $this->individual_id ? new IndividualResource($this->individual): null,
            'receiver_d'        => $this->model_id,
            'model_type'        => $this->model_type,
            'message'           => $this->message,
            'images'            => $this->images ? new ImageCollection($this->images) : Null,
            'createdDate'       => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
        ];
    }
}
