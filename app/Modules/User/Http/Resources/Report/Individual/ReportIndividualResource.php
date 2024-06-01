<?php

namespace User\Http\Resources\Report\Individual;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Individual\IndividualResource;

class ReportIndividualResource extends JsonResource
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
            'Reported User'         => $this->individual_id?new IndividualResource($this->ReportedUser):null,
            'account report reason' => $this->reason ? $this->reason->reason : null,
            'broker Id'             => $this->broker_id,
            'Broker Sender'         => $this->broker_id?new BrokerResource($this->broker):null,
            'developer Id'          => $this->developer_id,
            'developer Sender'      => $this->developer_id?new DeveloperResource($this->developer):null,
            'individual Id'         => $this->individual_id,
            'individual Sender'     => $this->individual_id?new IndividualResource($this->individual):null,
            'other_reason'          => $this->other_reason ? $this->other_reason : null,
            'comments'              => $this->comments,
            'status'                => $this->status,
            'createdDate'           => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
        ];
    }
}
