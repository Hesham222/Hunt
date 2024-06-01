<?php

namespace Admin\Http\Controllers\User;
use Admin\Http\Controllers\JsonResponse;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\User\Individual\{
    StoreAction,
    UpdateAction,
    TrashAction,
    ResetPasswordAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    BlockAction,

};
use Admin\Http\Requests\User\Individual\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    ResetPasswordRequest,
    FilterDateRequest,
    BlockRequest
};
use Admin\Exports\User\Individual\{
    ExportData,
};
use Admin\Models\{
    Individual
};

class IndividualController extends JsonResponse
{
    public function index()
    {
        return view('Admin::users.individuals.index');
    }

    public function create()
    {
        return view('Admin::users.individuals.create');
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('admins.individual.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {
        $record = Individual::findOrFail($id);
        return view('Admin::users.individuals.edit', compact('record'));
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('admins.individual.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
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
                'individual'       => $request->input('individual'),


            ]);

        $result = view('Admin::users.individuals.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'individuals_data.csv');
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
            return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'individuals', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'individuals', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'individuals', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }
    public function block(BlockRequest $request, BlockAction $blockAction)
    {
        DB::beginTransaction();
        try {
            $record =  $blockAction->execute($request);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'The account has been blocked successfully.', 200, [], $record, ['module' => 'individuals-blocked', 'trashesCount' => $this->countBlocked()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function resetPassword(ResetPasswordRequest $request, ResetPasswordAction $restPassAction)
    {
        DB::beginTransaction();
        try {
            $restPassAction->execute($request);
            DB::commit();
            return $this->response(200, 'Password has been reset successfully.', 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Individual::onlyTrashed()->count();
    }

    private function countBlocked()
    {
        return Individual::where('status','blocked')->count();
    }

}
