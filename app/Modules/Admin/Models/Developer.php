<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use User\Models\UnlockRequests;

class Developer extends Authenticatable
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

    public function listings()
    {
        return $this->hasMany('Admin\Models\Listings\Listing','developer_id');
    }


}
