<?php

namespace User\Http\Resources\PostListing;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Area\AreaResource;
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\City\CityResource;
use User\Http\Resources\Comment\CommentCollection;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Image\ImageCollection;
use User\Http\Resources\Individual\IndividualResource;
use User\Http\Resources\Post\Completion\CompletionResource;
use User\Http\Resources\Post\Reason\ReasonResource;
use User\Http\Resources\Post\ReasonOption\ReasonOptionResource;
use User\Http\Resources\Post\Sale\SaleResource;
use User\Http\Resources\Post\Status\StatusResource;
use User\Http\Resources\Post\Type\TypeResource;

class PostListingGuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->broker_id){
            return [
                'Type'                      => "Listing",
                'id'                        => intval($this->id),
                'user'                      => new BrokerResource($this->broker),
                'status'                    => $this->status ? new StatusResource($this->status):null,
                'reason'                    => $this->reason ? new ReasonResource($this->reason):null,
                'reasonOption'              => $this->reasonOption ? new ReasonOptionResource($this->reasonOption):null,
                'city'                      => $this->city ? new CityResource($this->city):null,
                'area'                      => $this->area ? new AreaResource($this->area):null,
                'type'                      => $this->type ? new TypeResource($this->type):null,
                'completion'                => $this->completion ? new CompletionResource($this->completion):null,
                'sale'                      => $this->sale ? new SaleResource($this->sale):null,
                'inCompound'                => $this->in_a_compound,
                'start_price'               => $this->start_price ? $this->start_price : "0",
                'end_price'                 => $this->end_price ? $this->end_price : "0",
                'developer'                 => $this->developer,
                'rooms'                     => $this->rooms,
                'Payment'                   => $this->payment,
                'size_of_property'                => $this->size_of_property,
                'start_down_payment'              => $this->start_down_payment ? $this->start_down_payment : "0",
                'end_down_payment'                => $this->end_down_payment ? $this->end_down_payment : "0",
                'start_monthly_installment'       => $this->start_monthly_installment ? $this->start_monthly_installment : "0",
                'end_monthly_installment'         => $this->end_monthly_installment ? $this->end_monthly_installment : "0",
                'start_payment_duration'          => $this->start_payment_duration ? $this->start_payment_duration : "0",
                'end_payment_duration'            => $this->end_payment_duration ? $this->end_payment_duration : "0" ,
                'delivery_date'                   => $this->delivery_date,
                'images'                          => $this->individual_id? new ImageCollection($this->images) :new ImageCollection($this->images) ,
                'createdDate'                     => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
                'comments'                        =>$this->comments? new CommentCollection($this->comments) : null,

            ];
        }elseif ($this->developer_id){
            return [
                'Type'                      =>  "Listing",
                'id'                        => intval($this->id),
                'user'                      => new DeveloperResource($this->getDeveloper),
                'status'                    => $this->status ? new StatusResource($this->status):null,
                'reason'                    => $this->reason ? new ReasonResource($this->reason):null,
                'reasonOption'              => $this->reasonOption ? new ReasonOptionResource($this->reasonOption):null,
                'city'                      => $this->city ? new CityResource($this->city):null,
                'area'                      => $this->area ? new AreaResource($this->area):null,
                'type'                      => $this->type ? new TypeResource($this->type):null,
                'completion'                => $this->completion ? new CompletionResource($this->completion):null,
                'sale'                      => $this->sale ? new SaleResource($this->sale):null,
                'inCompound'                => $this->in_a_compound,
                'start_price'               => $this->start_price ? $this->start_price : "0",
                'end_price'                 => $this->end_price ? $this->end_price : "0",
                'developer'                 => $this->developer,
                'rooms'                     => $this->rooms,
                'Payment'                   => $this->payment,
                'size_of_property'                => $this->size_of_property,
                'start_down_payment'              => $this->start_down_payment ? $this->start_down_payment : "0",
                'end_down_payment'                => $this->end_down_payment ? $this->end_down_payment : "0",
                'start_monthly_installment'       => $this->start_monthly_installment ? $this->start_monthly_installment : "0",
                'end_monthly_installment'         => $this->end_monthly_installment ? $this->end_monthly_installment : "0",
                'start_payment_duration'          => $this->start_payment_duration ? $this->start_payment_duration : "0",
                'end_payment_duration'            => $this->end_payment_duration ? $this->end_payment_duration : "0" ,
                'delivery_date'                   => $this->delivery_date,
                'images'                          => $this->individual_id? new ImageCollection($this->images) :new ImageCollection($this->images) ,
                'createdDate'                     => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
                'comments'                        =>$this->comments? new CommentCollection($this->comments) : null,

            ];
        }elseif ($this->individual_id) {
            return [
                'Type'                      =>  "Post",
                'id'                        => intval($this->id),
                'user'                      => new IndividualResource($this->individual),
                'status'                    => $this->status ? new StatusResource($this->status):null,
                'reason'                    => $this->reason ? new ReasonResource($this->reason):null,
                'reasonOption'              => $this->reasonOption ? new ReasonOptionResource($this->reasonOption):null,
                'city'                      => $this->city ? new CityResource($this->city):null,
                'area'                      => $this->area ? new AreaResource($this->area):null,
                'type'                      => $this->type ? new TypeResource($this->type):null,
                'completion'                => $this->completion ? new CompletionResource($this->completion):null,
                'sale'                      => $this->sale ? new SaleResource($this->sale):null,
                'inCompound'                => $this->in_a_compound,
                'start_price'               => $this->start_price ? $this->start_price : "0",
                'end_price'                 => $this->end_price ? $this->end_price : "0",
                'developer'                 => $this->developer,
                'rooms'                     => $this->rooms,
                'Payment'                   => $this->payment,
                'size_of_property'                => $this->size_of_property,
                'start_down_payment'              => $this->start_down_payment ? $this->start_down_payment : "0",
                'end_down_payment'                => $this->end_down_payment ? $this->end_down_payment : "0",
                'start_monthly_installment'       => $this->start_monthly_installment ? $this->start_monthly_installment : "0",
                'end_monthly_installment'         => $this->end_monthly_installment ? $this->end_monthly_installment : "0",
                'start_payment_duration'          => $this->start_payment_duration ? $this->start_payment_duration : "0",
                'end_payment_duration'            => $this->end_payment_duration ? $this->end_payment_duration : "0" ,
                'delivery_date'                   => $this->delivery_date,
                'images'                          => $this->individual_id? new ImageCollection($this->images) :new ImageCollection($this->images) ,
                'createdDate'                     => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
                'comments'                        =>$this->comments? new CommentCollection($this->comments) : null,

            ];
        }else
            $user = Null;


    }
}
