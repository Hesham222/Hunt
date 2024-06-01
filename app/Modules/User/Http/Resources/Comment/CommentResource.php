<?php

namespace User\Http\Resources\Comment;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Individual\IndividualResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->individual_id) {
            return [
                'id'                        => intval($this->id),
                'post_id'                   => $this->post_id,
                'user'                      => new IndividualResource($this->indivdual),
                'developer'                 => $this->developer,
                'rooms'                     => $this->rooms,
                'size_of_property'          => $this->size_of_property,
                'start_down_payment'        => $this->start_down_payment ? $this->start_down_payment : "0",
                'end_down_payment'          => $this->end_down_payment ? $this->end_down_payment : "0",
                'start_monthly_installment' => $this->start_monthly_installment ? $this->start_monthly_installment : "0",
                'end_monthly_installment'   => $this->end_monthly_installment ? $this->end_monthly_installment : "0",
                'Payment'                   => $this->payment,
                'start_payment_duration'    => $this->start_payment_duration ? $this->start_payment_duration : "0",
                'end_payment_duration'      => $this->end_payment_duration ? $this->end_payment_duration : "0" ,
                'delivery_date'             => $this->delivery_date,
                'image'                     => $this->image,
                'description'               => $this->description,
                'completion'                => $this->completion ? $this->completion->completion : "--",
                'status'                    => $this->status ? $this->status->status : "--",
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }elseif ($this->broker_id){
            return [
                'id'                        => intval($this->id),
                'post_id'                   => $this->post_id,
                'user'                      => new BrokerResource($this->broker),
                'developer'                 => $this->developer,
                'rooms'                     => $this->rooms,
                'size_of_property'          => $this->size_of_property,
                'start_down_payment'        => $this->start_down_payment ? $this->start_down_payment : "0",
                'end_down_payment'          => $this->end_down_payment ? $this->end_down_payment : "0",
                'start_monthly_installment' => $this->start_monthly_installment ? $this->start_monthly_installment : "0",
                'end_monthly_installment'   => $this->end_monthly_installment ? $this->end_monthly_installment : "0",
                'Payment'                   => $this->payment,
                'start_payment_duration'    => $this->start_payment_duration ? $this->start_payment_duration : "0",
                'end_payment_duration'      => $this->end_payment_duration ? $this->end_payment_duration : "0" ,
                'delivery_date'             => $this->delivery_date,
                'image'                     => $this->image,
                'description'               => $this->description,
                'completion'                => $this->completion ? $this->completion->completion : "--",
                'status'                    => $this->status ? $this->status->status : "--",
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }elseif ($this->developer_id){
            return [
                'id'                        => intval($this->id),
                'post_id'                   => $this->post_id,
                'user'                      => new DeveloperResource($this->getDeveloper),
                'developer'                 => $this->developer,
                'rooms'                     => $this->rooms,
                'size_of_property'          => $this->size_of_property,
                'start_down_payment'        => $this->start_down_payment ? $this->start_down_payment : "0",
                'end_down_payment'          => $this->end_down_payment ? $this->end_down_payment : "0",
                'start_monthly_installment' => $this->start_monthly_installment ? $this->start_monthly_installment : "0",
                'end_monthly_installment'   => $this->end_monthly_installment ? $this->end_monthly_installment : "0",
                'Payment'                   => $this->payment,
                'start_payment_duration'    => $this->start_payment_duration ? $this->start_payment_duration : "0",
                'end_payment_duration'      => $this->end_payment_duration ? $this->end_payment_duration : "0" ,
                'delivery_date'             => $this->delivery_date,
                'image'                     => $this->image,
                'description'               => $this->description,
                'completion'                => $this->completion ? $this->completion->completion : "--",
                'status'                    => $this->status ? $this->status->status : "--",
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];
        }

    }
}
