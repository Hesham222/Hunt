<?php

namespace User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'id' => intval($this->id),
            'title'=>$this->title,
            'message'=>$this->message,
            'time' => $this->created_at->diffForHumans()
        ];
    }
}
