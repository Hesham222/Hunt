<?php

namespace User\Http\Requests\Listing;
use User\Http\Requests\BaseRequest;

class SaveListingRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'listing_Id'            =>'required|integer|exists:listings,id',
        ];
    }

}
