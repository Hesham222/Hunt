<?php

namespace User\Http\Resources\Message\Individual;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Null_;
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Image\ImageCollection;
use User\Http\Resources\Individual\IndividualResource;

class ReplayMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->developer_id){
            return [
                'id'                => intval($this->id),
                //'developer'         => $this->developer_id ? $this->developer_id : null,
                'sender'            => $this->developer_id ? new DeveloperResource($this->developer): null,
                'receiver_d'        => $this->model_id,
                'model_type'        => $this->model_type,
                'message'           => $this->message,
                'images'            => $this->images ? new ImageCollection($this->images) : Null,
                'createdDate'       => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }elseif ($this->broker_id){
            return [
                'id'                => intval($this->id),
               // 'broker_id'         => $this->broker_id ? $this->broker_id : null,
                'sender'            => $this->broker_id ? new BrokerResource($this->broker): null,
                'receiver_d'        => $this->model_id,
                'model_type'        => $this->model_type,
                'message'           => $this->message,
                'images'            => $this->images ? new ImageCollection($this->images) : Null,
                'createdDate'       => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }elseif ($this->individual_id){
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
}
