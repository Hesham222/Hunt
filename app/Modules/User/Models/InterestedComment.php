<?php

namespace User\Models;

use Admin\Models\Broker;
use Admin\Models\Developer;
use Admin\Models\Individual;
use Admin\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InterestedComment extends Model
{
    use HasFactory;

    public function Post(){
        return $this->belongsTo(Post::class,'post_id');
    }
    public function Individual(){
        return $this->belongsTo(Individual::class,'model_id');
    }
    public function Broker(){
        return $this->belongsTo(Broker::class,'model_id');
    }
    public function Developer(){
        return $this->belongsTo(Developer::class,'model_id');
    }
}
