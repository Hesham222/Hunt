<?php

namespace Admin\Http\Controllers\Notification;
use Admin\Http\Controllers\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\Notification\{
    StoreAction,
    PushAction,
    FilterAction,
    UnsendAction,
};
use Admin\Http\Requests\Notification\{
    StoreRequest,
    UnsendRequest,
    FilterDateRequest
};
use Admin\Exports\Notification\{
    ExportData,
};
use Admin\Models\{
    Notification,
    Broker,
    Developer,
    Individual,
};
class NotificationController extends JsonResponse
{
    public function index()
    {
        return view('Admin::notifications.index');
    }

    public function create()
    {
        return view('Admin::notifications.create');
    }

    public function store(StoreRequest $request, StoreAction $storeAction, PushAction $pushAction)
    {
        DB::beginTransaction();
        try {
            $storeAction->execute($request);
            $pushAction->execute($request);
            DB::commit();
            return redirect()->route('admins.notification.index')->with('success','Data has been saved successfully.');
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
                'type'   => $request->input('type'),
            ]);
        $result = view('Admin::notifications.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'notifications_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occured, Please try again later.');
        }
    }

    public function unsend(UnsendRequest $request, UnsendAction $unsendAction)
    {
        DB::beginTransaction();
        try {
            $record =  $unsendAction->execute($request);
            DB::commit();
            return $this->response(200, 'Notification has been unsend successfully.', 200, [], $record);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function getSpecificUserType()
    {
        $results = view('Admin::notifications.components.aspecific_user_type')->render();
        return $this->response(200, 'A specific user types', 200, [], 0, ['responseHTML' => $results]);
    }

    public function getSpecificUserList(Request $request)
    {
        if($request->input('type') == 'individuals')
            $users = Individual::where('status', 'verified')->select(['id','first_name','last_name','phone','email'])->get();
        elseif($request->input('type') == 'brokers')
            $users = Broker::where('status', 'verified')->select(['id','first_name','last_name','phone','email'])->get();
        elseif($request->input('type') == 'developers')
            $users = Developer::where('status', 'verified')->select(['id','first_name','last_name','phone','email'])->get();
        else
            $users = [];
        $results = view('Admin::notifications.components.aspecific_user_list',
        [
            'users' => $users ,
            'type' => $request->input('type') ,
        ])->render();

        return $this->response(200, 'A specific users list', 200, [], 0, ['responseHTML' => $results]);
    }
}
