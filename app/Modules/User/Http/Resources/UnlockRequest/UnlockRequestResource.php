<?php

namespace User\Http\Resources\UnlockRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Individual\IndividualResource;


class UnlockRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->model_type == 'Admin/Models/Developer'){
            return [
                'id'                        => intval($this->id),
                'individual_id'             => $this->individual_id ? $this->individual_id : "--",
                'user'                      => new DeveloperResource($this->developer),
                'model_type'                => "Developer",
                'status'                    => $this->status ? $this->status : "--",
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }elseif ($this->model_type == 'Admin/Models/Broker'){
            return [
                'id'                        => intval($this->id),
                'individual_id'             => $this->individual_id ? $this->individual_id : "--",
                'user'                      => new BrokerResource($this->broker),
                'model_type'                => "Broker",
                'status'                    => $this->status ? $this->status : "--",
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }else{
            return [
                'id'                        => intval($this->id),
                'individual_id'             => $this->individual_id ? $this->individual_id : "--",
                'user'                      => new IndividualResource($this->individualSender),
                'model_type'                => "Individual",
                'status'                    => $this->status ? $this->status : "--",
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }

    }
}
