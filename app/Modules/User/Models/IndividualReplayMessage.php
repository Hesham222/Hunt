<?php

namespace User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndividualReplayMessage extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(ReplayImage::class, 'model_id');
    }
    public function individual()
    {
        return $this->belongsTo('Admin\Models\Individual', 'individual_id');
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
