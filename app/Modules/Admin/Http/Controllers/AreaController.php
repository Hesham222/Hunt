<?php

namespace Admin\Http\Controllers;
use Admin\Models\City;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\Area\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Admin\Http\Requests\Area\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Admin\Exports\Area\{
    ExportData,
};
use Admin\Models\{
    Area
};

class AreaController extends JsonResponse
{
    public function index()
    {
        return view('Admin::areas.index');
    }

    public function create()
    {
        $cities = City::with('translation')->select(['id'])->get();
        return view('Admin::areas.create',compact('cities'));
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            DB::commit();
            return redirect()->route('admins.area.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {
        $record = Area::findOrFail($id);
        $cities = City::with('translation')->select(['id'])->get();
        return view('Admin::areas.edit', compact('record','cities'));
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {

        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('admins.area.index')->with('success','Data has been saved successfully.');
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
                'city'       => $request->input('city'),

            ]);
        $result = view('Admin::areas.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'areas_data.csv');
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
            return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'areas', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'areas', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'areas', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Area::onlyTrashed()->count();
    }
}
