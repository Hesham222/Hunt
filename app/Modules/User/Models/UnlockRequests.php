<?php

namespace User\Models;

use Admin\Models\Broker;
use Admin\Models\Developer;
use Admin\Models\Individual;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnlockRequests extends Model
{
    use HasFactory;


    public function individual(){

        return $this->belongsTo(Individual::class,'individual_id');
    }

    public function developer(){
        return $this->belongsTo(Developer::class,'model_id');
    }
    public function broker(){
        return $this->belongsTo(Broker::class,'model_id');
    }
    public function individualSender(){
        return $this->belongsTo(Individual::class,'model_id');
    }

}
