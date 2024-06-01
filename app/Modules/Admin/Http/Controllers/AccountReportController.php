<?php

namespace Admin\Http\Controllers;
use Admin\Models\Reports\AccountReportReason;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\AccountReport\{
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    DismissAction
};
use Admin\Http\Requests\AccountReport\{
    RemoveRequest,
    FilterDateRequest,
    DismissRequest,
};
use Admin\Exports\AccountReport\{
    ExportData,
};

use Admin\Models\Reports\{
    AccountReport,
};

class AccountReportController extends JsonResponse
{
    public function index()
    {

        $reasons = AccountReportReason::with(['translations' => function ($query) {
            return $query->select(['reason', 'account_report_reason_id', 'locale']);
        }])->select(['id'])->get();

        return view('Admin::account_reports.index', compact('reasons'));
    }

    public function show($id)
    {
        $record = AccountReport::findOrFail($id);
        return view('Admin::account_reports.show', compact('record'));
    }

    public function data(FilterDateRequest $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),
                'reason'     => $request->input('reason'),
                'status'     => $request->input('status'),
                'individual'     => $request->input('individual'),

            ]);
        $result = view('Admin::account_reports.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'account_reports_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occured, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        DB::beginTransaction();
        try {
            $record =  $trashAction->execute($request);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'account_reports', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        DB::beginTransaction();
        try {
            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'account_reports', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }
    public function Dismiss(DismissRequest $request, DismissAction $dismissAction)
    {
        DB::beginTransaction();
        try {
            $record =  $dismissAction->execute($request);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            if($record)
                return $this->response(200, 'The account has been Dismissed successfully.', 200, [], $record, ['module' => 'account_reports-dismissed', 'trashesCount' => $this->countDismissed(),'request'=>'account_reports-request','requestCount'=>$this->countRequests()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }


    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        DB::beginTransaction();
        try {
            $record =  $restoreAction->execute($request);
            DB::commit();
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'account_reports', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return AccountReport::onlyTrashed()->count();
    }

    private function countRequests()
    {
        return AccountReport::where('status', "Pending")->count();
    }

    private function countDismissed()
    {
        return AccountReport::where('status','Dismissed')->count();
    }
}
