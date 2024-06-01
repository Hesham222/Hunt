<?php

namespace User\Models;

use Admin\Models\Broker;
use Admin\Models\Developer;
use Admin\Models\Individual;

class UserLogin extends Model
{
    public function developer()
    {
        return $this->belongsTo(Developer::class)->where('model_type', '=', static::class);
    }
    public function individual()
    {
        return $this->belongsTo(Individual::class)->where('model_type', '=', static::class);
    }

    public function broker()
    {
        return $this->belongsTo(Broker::class)->where('model_type', '=', static::class);
    }
}
