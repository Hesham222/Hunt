<?php

namespace User\Http\Controllers;

use Admin\Models\Reports\AccountReportReason;
use Admin\Models\Reports\PostReport;
use Admin\Models\Reports\PostReportReason;
use Admin\Models\Reports\IndividualReportReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Actions\Report\{
    Post\ReportPostAction,
    Individual\ReportIndividualAction,
};
use User\Http\Requests\Report\{
    Post\ReportPostRequest,
    Individual\ReportIndividualRequest,
};
use User\Http\Resources\Report\{
    Post\ReportPostResource,
    Post\Reason\ReasonResource,
    Post\Reason\ReasonCollection,
    Individual\ReportIndividualResource,
};

class ReportController extends BaseResponse
{
        public function postData()
    {
        $reasons = PostReportReason::with(['translations' => function ($query) {
            return $query->select(['reason', 'post_report_reason_id', 'locale']);
        }])->select(['id'])->get();

        return $this->response(200, 'Post Report Reasons', 200, [], 0, [

            'reasons' => new ReasonCollection($reasons),

        ]);
    }
    public function individualData()
    {
        $reasons = AccountReportReason::with(['translations' => function ($query) {
            return $query->select(['reason', 'account_report_reason_id', 'locale']);
        }])->select(['id'])->get();

        return $this->response(200, 'Post Report Reasons', 200, [], 0, [

            'reasons' => new \User\Http\Resources\Report\Individual\Reason\ReasonCollection($reasons),

        ]);
    }
        public function reportPost(ReportPostRequest $request , ReportPostAction $reportPostAction){

            DB::beginTransaction();
            try {
                $user = auth($request->input('activeGuard'))->user();
                $record = $reportPostAction->execute($request, $user);
                DB::commit();
                return $this->response(200, 'The Post has been Reported successfully.', 200, [], 0, [
                    'report a post' => new ReportPostResource($record),
                ]);
            }
            catch (\Exception $e) {
                DB::rollback();
                return $this->response(500, $e->getMessage(), 500);
            }
        }

    public function reportIndividual(ReportIndividualRequest $request , ReportIndividualAction $sendAction){

        DB::beginTransaction();
        try {
            $user = auth($request->input('activeGuard'))->user();
            $record = $sendAction->execute($request, $user);
            DB::commit();
            return $this->response(200, 'The Individual has been Reported successfully.', 200, [], 0, [
                'report a individual' => new ReportIndividualResource($record),
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }

    }
}
