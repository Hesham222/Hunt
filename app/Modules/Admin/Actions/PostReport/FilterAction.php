<?php
namespace Admin\Actions\PostReport;
use Admin\Models\Reports\PostReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return PostReport::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->when($request->input('view') && $request->input('view') != 'trash' && $request->input('view') != 'view', function ($query) use ($request) {
            return $query->where('status',$request->input('view'));
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['individual' => function ($query) use ($request) {
            $query->select(['id','first_name','last_name','email','phone']);
        }])
        ->with(['broker' => function ($query) use ($request) {
                $query->select(['id','first_name','last_name','phone']);
        }])
        ->with(['developer' => function ($query) use ($request) {
                $query->select(['id','first_name','last_name','phone']);
        }])
        ->with(['reason' => function ($query) use ($request) {
            $query->select(['id']);
        }])->with(['post' => function ($query) use ($request) {
                $query->select(['id']);
        }])
        ->select(['id','broker_id','developer_id','individual_id','post_id','status','post_report_reason_id','other_reason','comments','deleted_by','deleted_at','created_at'])
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == 'deletedBy' , function ($query) use ($request){
                    return $query->whereHas('deletedBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                });

        })->when($request->input('reason'), function ($query) use ($request){
            return $query->where('post_report_reason_id',  $request->input('reason') );
        })->when($request->input('individual'), function ($query) use ($request){
            return $query->where('individual_id',  $request->input('individual') );
        });

    }
}
