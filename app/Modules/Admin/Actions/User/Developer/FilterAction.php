<?php
namespace Admin\Actions\User\Developer;
use Illuminate\Http\Request;
use Admin\Models\Developer;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return Developer::with('listings')->when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->when($request->input('view') && $request->input('view') != 'trash' && $request->input('view') != 'view', function ($query) use ($request) {
            return $query->where('status', $request->input('view'));
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['createdBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->select(['id','first_name','last_name','email','status','developer_name','date_of_birth','image', 'phone','deleted_by','deleted_at','created_by', 'created_at'])
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
                })
                ->when($request->input('column') == 'first_name', function ($query) use ($request){
                    return $query->where('first_name', 'like', '%' . $request->input('value') . '%');
                })
                ->when($request->input('column') == 'last_name', function ($query) use ($request){
                    return $query->where('last_name', 'like', '%' . $request->input('value') . '%');
                })
                ->when($request->input('column') == 'email', function ($query) use ($request){
                    return $query->where('email', 'like', '%' . $request->input('value') . '%');
                })
                ->when($request->input('column') == 'phone', function ($query) use ($request){
                    return $query->where('phone', 'like', '%' . $request->input('value') . '%');
                });
        })->when($request->input('status'), function ($query) use ($request){
            return $query->where('status', $request->input('status'));

        })->when($request->input('developer'), function ($query) use ($request){
                return $query->where('id', $request->input('developer'));

        })->when($request->input('developerName'), function ($query) use ($request) {
                return $query->where('first_name', $request->input('developerName'));
        });

    }
}
