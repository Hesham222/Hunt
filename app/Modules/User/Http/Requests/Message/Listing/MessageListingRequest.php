<?php

namespace User\Http\Requests\Message\Listing;
use User\Http\Requests\BaseRequest;

class MessageListingRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'listing_id'  =>'required|integer|exists:listings,id',
            'title'    => 'required|string|min:3|max:191',
            'message'  => 'required|string|min:3|max:99999',
        ];
    }
}
