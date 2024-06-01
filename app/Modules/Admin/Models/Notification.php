<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Notification extends Model
{
    use HasFactory;

    public function createdBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'created_by')->withTrashed();
    }

    public function getRecipientsType()
    {
        if($this->type == 'all')
            return 'All Users';
        if($this->type == 'individuals')
            return 'All Individuals';
        if($this->type == 'developers')
            return 'All Developers';
        if($this->type == 'brokers')
            return  'All Brokers ';
        if($this->type == 'specific')
            return 'A Specific User';
    }

    public function getDate()
    {
        return \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
    }
}
