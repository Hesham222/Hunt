<?php

namespace User\Http\Requests\Listing;
use User\Http\Requests\BaseRequest;

class RemoveRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'listingId'=>'required|exists:listings,id',
        ];
    }

}
