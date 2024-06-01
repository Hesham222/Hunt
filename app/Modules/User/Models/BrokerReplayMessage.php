<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrokerReplayMessage extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(ReplayImage::class, 'model_id');
    }

    public function broker()
    {
        return $this->belongsTo('Admin\Models\Broker', 'broker_id');
    }

    public function checkImage(){

        foreach ($this->images as $image){
            if ($image->model_type == 'individualReplay'){
                return 'individual';
            }elseif ($image->model_type == 'brokerReplay'){
                return 'broker';
            }else{
                return 'developer';

            }
        }
    }
}
