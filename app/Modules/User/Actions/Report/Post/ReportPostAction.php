<?php
namespace User\Actions\Report\Post;

use Admin\Models\Reports\PostReport;
use Illuminate\Http\Request;

class ReportPostAction
{
    public function execute(Request $request,$user)
    {

        $record = PostReport::create([
            'broker_id'                 => $request->input('activeGuard')=='brokerApi'?$user->id:null,
            'developer_id'              => $request->input('activeGuard')=='developerApi'?$user->id:null ,
            'individual_id'             => $request->input('activeGuard')=='individualApi'?$user->id:null ,
            'post_id'                   => $request->input('post_id'),
            'post_report_reason_id'     => $request->input('post_report_reason_id'),
            'other_reason'              => $request->input('other_reason'),
            'comments'                  => $request->input('comments'),
        ]);

        return $record;
    }
}
