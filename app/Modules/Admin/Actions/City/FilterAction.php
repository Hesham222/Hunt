<?php
namespace Admin\Actions\City;
use Illuminate\Http\Request;
use Admin\Models\City;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {

        return City::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['createdBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['translations' => function ($query) {
            return $query->select(['name', 'city_id', 'locale']);
        }])
         ->select(['id','deleted_by','deleted_at','created_by', 'created_at'])

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
                ->when($request->input('column') == 'name', function ($query) use ($request){
                    return $query->where(function ($query) use ($request) {
                        $query->whereHas('translations', function ($query) use ($request) {
                            $query->where(function ($subQuery) use ($request) {
                                $subQuery->where('name', 'like', '%' . $request->input('value') . '%');
                            });
                        });
                    });
                    
                });

        });

    }
}
