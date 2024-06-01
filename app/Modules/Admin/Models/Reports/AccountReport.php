<?php

namespace Admin\Models\Reports;


use Admin\Models\Individual;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountReport extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function deletedBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'deleted_by')->withTrashed();
    }

    public function ReportedUser()
    {
        return $this->belongsTo(Individual::class, 'reported_id');
    }

    public function senders()
    {
        if($this->broker_id)
            return 'Brokers';
        if($this->individual_id)
            return 'Individuals';
        else
            return 'Developers';
    }

    public function color()
    {
        if($this->status == 'Pending')
            return 'blue';
        elseif($this->status == 'Dismissed')
            return 'black';

    }

    public function sender()
    {
        if($this->broker_id)
            return $this->broker;
        if($this->individual_id)
            return $this->individual;
        else
            return $this->developer;
    }

    public function individual()
    {
        return $this->belongsTo(Individual::class, 'individual_id');
    }

    public function broker()
    {
        return $this->belongsTo('Admin\Models\Broker', 'broker_id');
    }

    public function developer()
    {
        return $this->belongsTo('Admin\Models\Developer', 'developer_id');
    }

    public function reason()
    {
        return $this->belongsTo(AccountReportReason::class, 'account_report_reason_id');
    }


}
