<?php

namespace Admin\Models;

use Admin\Models\Posts\Post;
use Admin\Models\Posts\PostMessage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use User\Models\UnlockRequests;

class Individual extends Authenticatable
{
    protected $guarded = [];

    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    public function deletedBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'deleted_by')->withTrashed();
    }

    public function createdBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'created_by')->withTrashed();
    }

    public function getStatusColor()
    {
        if($this->status =='blocked')
            return '#ba1417';
        elseif($this->status == 'verified')
            return '#0b5e18';
        else
            return '#0b145e';
    }

    public function postsOnlyTrashed()
    {
        return $this->hasMany(Post::class, 'creator_id')->onlyTrashed();
    }

    public function postsWithTrashed()
    {
        return $this->hasMany(Post::class, 'creator_id')->withTrashed();
    }

    public function posts()
    {
        return $this->hasMany('Admin\Models\Posts\Post','individual_id');
    }

    public function messages(){

        return $this->hasManyThrough(PostMessage::class,Post::class,'individual_id','post_id');
    }

    public function unlockRequests(){

        return $this->hasMany(UnlockRequests::class,'individual_id');
    }
    public function getPublic()
    {
        return $this->public == 0 ? 'Locked' : 'Unlocked' ;
    }
}
