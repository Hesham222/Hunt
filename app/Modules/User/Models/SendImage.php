<?php

namespace User\Models;

use Admin\Models\Listings\ListingMessage;
use Admin\Models\Posts\PostMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SendImage extends Model
{
    use HasFactory;

    public function postMessageImages(){
        return $this->belongsTo(PostMessage::class,'model_id');
    }
    public function listingMessageImages(){
        return $this->belongsTo(ListingMessage::class,'model_id');
    }
}
