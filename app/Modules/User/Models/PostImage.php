<?php

namespace User\Models;
use Admin\Models\Listings\Listing;
use Admin\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostImage extends Model
{
    use HasFactory;

    public function Post(){
        return $this->belongsTo(Post::class,'model_id');
    }
    public function Listing(){
        return $this->belongsTo(Listing::class,'model_id');
    }
}
