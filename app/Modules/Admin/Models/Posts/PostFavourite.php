<?php

namespace App\Modules\Admin\Models\Posts;

use Admin\Models\Individual;
use Admin\Models\Posts\Model;
use Admin\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostFavourite extends Model
{
    use HasFactory;

    public function post(){

        return $this->belongsTo(Post::class,'post_id');
    }

    public function individual(){

        return $this->belongsTo(Individual::class,'individual_id');
    }
}
