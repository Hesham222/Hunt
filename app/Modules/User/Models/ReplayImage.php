<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReplayImage extends Model
{
    use HasFactory;


    public function developerReplay(){
        return $this->belongsTo(DeveloperReplayMessage::class,'model_id');
    }
    public function brokerReplay(){
        return $this->belongsTo(BrokerReplayMessage::class,'model_id');
    }
    public function individualReplay(){
        return $this->belongsTo(IndividualReplayMessage::class,'model_id');
    }
}
