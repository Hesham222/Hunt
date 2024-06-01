<?php

namespace User\Models;

use Admin\Models\Broker;
use Admin\Models\Developer;
use Admin\Models\Individual;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeveloperReplayMessage extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(ReplayImage::class, 'model_id');
    }
    public function developer()
    {
        return $this->belongsTo('Admin\Models\Developer', 'developer_id');
    }
    public function checkImage(){

        foreach ($this->images as $image){
            if ($image->model_type == 'individualReplay'){
                return 'individual';
            }elseif ($image->model_type == 'brokerReplay'){
                return 'broker';
            }elseif ($image->model_type == 'DeveloperReplay'){
                return 'developer';

            }
        }
    }

}
