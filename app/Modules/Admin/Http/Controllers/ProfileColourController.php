<?php

namespace Admin\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Admin\Actions\ProfileColour\{
    UpdateAction,
    FilterAction,
};
use Admin\Http\Requests\ProfileColour\{
    UpdateRequest,
    FilterDateRequest
};
use Admin\Exports\ProfileColour\{
    ExportData,
};
use Admin\Models\{
    ProfileColour
};

class ProfileColourController extends JsonResponse
{
    public function index()
    {
        return view('Admin::profile_colours.index');
    }

    public function edit($id)
    {
        $record = ProfileColour::findOrFail($id);
        return view('Admin::profile_colours.edit', compact('record'));
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {

        DB::beginTransaction();
        try {
               $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('admins.profile_colour.index')->with('success','Data has been saved successfully.');
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
        $result = view('Admin::profile_colours.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
                return Excel::download(new ExportData($records), 'profile_colours_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occured, Please try again later.');
        }
    }


}
