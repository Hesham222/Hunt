<?php

namespace Admin\Http\Controllers;
use Admin\Models\Area;
use Admin\Models\Listings\ListingCompletion;
use Admin\Models\Listings\ListingSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\Listing\{
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    ToggleApproveAction,
};
use Admin\Http\Requests\Listing\{
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest,
    ToggleApproveRequest,
};
use Admin\Exports\Listing\{
    ExportData,
};
use Admin\Models\{
    City,
};
use Admin\Models\Listings\{
    Listing,
    ListingReason,
    ListingType,
    ListingStatus,
};

class ListingController extends JsonResponse
{
    public function index()
    {
        $cities = City::with(['translations' => function ($query) {
            return $query->select(['name', 'city_id', 'locale']);
        }])->select(['id'])->get();

        $reasons = ListingReason::with(['translations' => function ($query) {
            return $query->select(['reason', 'listing_reason_id', 'locale']);
        }])->select(['id'])->get();

        $types = ListingType::with(['translations' => function ($query) {
            return $query->select(['type', 'listing_type_id', 'locale']);
        }])->select(['id'])->get();

        $statuses = ListingStatus::where('id', '!=', 1)->with(['translations' => function ($query) {
            return $query->select(['status', 'listing_status_id', 'locale']);
        }])->select(['id'])->get();

        return view('Admin::listings.index', compact('cities','reasons','types','statuses'));
    }

    public function show($id)
    {
        $record = Listing::findOrFail($id);
        return view('Admin::listings.show', compact('record'));
    }

    public function edit($id)
    {
        $record = Listing::findOrFail($id);

        $statuses = ListingStatus::with(['translations' => function ($query) {
            return $query->select(['status', 'listing_status_id', 'locale']);
        }])->select(['id'])->get();

        $completions = ListingCompletion::with(['translations' => function ($query) {
            return $query->select(['completion','listing_completion_id','locale']);
        }])->select(['id'])->get();

        $cities = City::with(['translations' => function ($query) {
            return $query->select(['name', 'city_id', 'locale']);
        }])->select(['id'])->get();;
        $areas = Area::with(['translations' => function ($query) {
            return $query->select(['name', 'area_id', 'locale']);
        }])->select(['id'])->get();
        $types = ListingType::with(['translations' => function ($query) {
            return $query->select(['type', 'listing_type_id', 'locale']);
        }])->select(['id'])->get();

        $sales = ListingSale::with(['translations' => function ($query) {
            return $query->select(['sale','listing_sale_id','locale']);
        }])->select(['id'])->get();

        $reasons = ListingReason::with(['translations' => function ($query) {
            return $query->select(['reason', 'listing_reason_id', 'locale']);
        }])->select(['id'])->get();

        return view('Admin::listings.edit', compact('record','cities','areas','reasons','types','statuses','sales','completions'));
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
         try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('admins.listing.index')->with('success','Data has been saved successfully.');
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
                'reason'     => $request->input('reason'),
                'type'       => $request->input('type'),
                'status'     => $request->input('status'),
                'developer'  => $request->input('developer'),
                'broker'     => $request->input('broker'),
            ]);

        $result = view('Admin::listings.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'listings_data.csv');
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
            return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'listings', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'listings', 'trashesCount' => $this->countTrashes()]);
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
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'listings', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function appendAreas(Request $request){
        try {
            if($request->ajax()){
                $data = $request->all();
                $record = $request->input('area_id');
                $areas = Area::with(['translations' => function ($query) {
                    return $query->select(['name','area_id','locale']);
                }])->where(['city_id'=>$data['city_id']])->select(['id'])->get();
                return view('Admin::posts.components.append_areas',compact('areas','record'))->render();
            }
        } catch (\Exception $ex) {
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
        return $this->response(500, 'Failed, Please try again later.', 200);
    }
    public function toggleApprove(ToggleApproveRequest $request, ToggleApproveAction $toggleAction, $action)
    {
        DB::beginTransaction();
        try {
            $record =  $toggleAction->execute($request, $action);
            DB::commit();
            if($action)
                return $this->response(200, 'Listing has been approved successfully.', 200, [], $record, ['module' => 'requests-listings', 'trashesCount' => $this->countRequests()]);
            return $this->response(200, 'Listing has been declined successfully.', 200, [], $record, ['module' => 'requests-listings', 'trashesCount' => $this->countRequests()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Listing::onlyTrashed()->count();
    }

    private function countRequests()
    {
        return Listing::where('listing_status_id', 1)->count();
    }
}
