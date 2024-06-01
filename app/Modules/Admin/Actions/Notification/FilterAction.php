<?php
namespace Admin\Actions\Notification;
use Illuminate\Http\Request;
use Admin\Models\Notification;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return Notification::with(['createdBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->select(['id','type','title','message','users','created_by', 'created_at'])
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == 'createdBy', function ($query) use ($request) {
                return $query->whereHas('createdBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'title', function ($query) use ($request){
                    return $query->where('title', 'like', '%' . $request->input('value') . '%');
                })->when($request->input('column') == 'message', function ($query) use ($request){
                    return $query->where('message', 'like', '%' . $request->input('value') . '%');
                });
        })->when($request->input('type'), function ($query) use ($request) {
            return $query->where('type', $request->input('type'));
        });

    }
}
