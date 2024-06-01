<?php
namespace User\Actions\Report\Individual;

use Admin\Models\Reports\AccountReport;
use Illuminate\Http\Request;

class ReportIndividualAction
{
    public function execute(Request $request,$user)
    {

        $record = AccountReport::create([
            'broker_id'                 => $request->input('activeGuard')=='brokerApi'?$user->id:null,
            'developer_id'              => $request->input('activeGuard')=='developerApi'?$user->id:null ,
            'individual_id'             => $request->input('activeGuard')=='individualApi'?$user->id:null ,
            'reported_id'               => $request->input('reported_id'),
            'account_report_reason_id'  => $request->input('account_report_reason_id'),
            'other_reason'              => $request->input('other_reason'),
            'comments'                  => $request->input('comments'),
        ]);

        return $record;
    }
}
