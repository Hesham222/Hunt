<?php

namespace Admin\Http\Controllers;

use Admin\Models\Broker;
use Admin\Models\Comments\Comment;
use Admin\Models\Developer;
use Admin\Models\Individual;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\Comment\{
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
};
use Admin\Http\Requests\Comment\{
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest
};
use Admin\Exports\Comment\{
    ExportData,
};
use Admin\Models\{
    Comment
};

class CommentController extends JsonResponse
{
    public function index()
    {
        return view('Admin::comments.index');
    }

//    public function create()
//    {
//        return view('Admin::comments.create');
//    }
//
//    public function store(StoreRequest $request, StoreAction $storeAction)
//    {
//        DB::beginTransaction();
//        try {
//            $storeAction->execute($request);
//            DB::commit();
//            return redirect()->route('admins.comment.index')->with('success','Data has been saved successfully.');
//        } catch (\Exception $exception) {
//            DB::rollback();
//            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
//        }
//    }

    public function edit($id)
    {
        $record = Comment::findOrFail($id);
        $brokers = Broker::all();
        $developers = Developer::all();
        $individuals = Individual::all();

        return view('Admin::comments.edit', compact('record','individuals','developers','brokers'));
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('admins.comment.index')->with('success','Data has been saved successfully.');
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

            ]);

        $result = view('Admin::comments.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'comments_data.csv');
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
            return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'comments', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        DB::beginTransaction();
        try {
            if ($id === 1)
                return $this->response(500, 'Failed, You can not delete this record.', 200);
            $record =  $destroyAction->execute($request, $id);
            if(!$record)
                return $this->response(500, 'Failed, This record is not found .', 200);
            DB::commit();
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'comments', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'comments', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }
    public function show($id){

        $record = Comment::findOrFail($id);

        return view('Admin::comments.show', compact('record'));
    }

    private function countTrashes()
    {
        return Comment::onlyTrashed()->count();
    }
}
