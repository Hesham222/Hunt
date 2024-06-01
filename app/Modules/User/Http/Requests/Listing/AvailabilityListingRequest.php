<?php

namespace User\Http\Requests\Listing;
use User\Http\Requests\BaseRequest;

class AvailabilityListingRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'listingId'                 =>'required|exists:listings,id',
        ];
    }

}
