<?php

namespace User\Http\Resources\Image;
use Illuminate\Http\Resources\Json\JsonResource;


class ImageResource extends JsonResource
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
            'id'                        => intval($this->id),
            'image'                     => $this->attachment ? asset('storage'.DS() . $this->attachment) : null,
        ];
    }
}
