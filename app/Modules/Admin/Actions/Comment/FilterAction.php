<?php
namespace Admin\Actions\Comment;
use Illuminate\Http\Request;
use Admin\Models\Comment;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return Comment::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['createdBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['individual' => function ($query) use ($request) {
            $query->select(['id','first_name']);
        }])
        ->with(['broker' => function ($query) use ($request) {
            $query->select(['id','first_name']);
        }])
        ->with(['developer' => function ($query) use ($request) {
            $query->select(['id','first_name']);
        }])
        ->with(['post' => function ($query) use ($request) {
            $query->get();
        }])
        ->select(['id','individual_id','broker_id','developer_id','post_id','deleted_by','deleted_at','created_by', 'created_at'])
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
                ->when($request->input('column') == 'deletedBy' , function ($query) use ($request){
                    return $query->whereHas('deletedBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                });



        });

    }
}
