<?php
namespace Admin\Actions\Listing;
use Illuminate\Http\Request;
use Admin\Models\Listings\Listing;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return Listing::when($request->input('view') == 'request', function ($query) use ($request) {
            return $query->where('listing_status_id', 1);
        })->when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->when($request->input('view') == 'view', function ($query) use ($request) {
            return $query->where('listing_status_id','!=', 1);
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with('broker')
        ->with('getDeveloper')
        ->with('city')
        ->with('area')
        ->with('reason')
        ->with('sale')
        ->with('completion')
        ->with('status')
        ->select(['id','title','broker_id','developer_id','developer','delivery_date','start_price','end_price','end_payment_duration','start_payment_duration','end_monthly_installment','start_monthly_installment','end_down_payment','rooms','payment','start_down_payment','size_of_property','listing_sale_id','listing_reason_id','listing_type_id','listing_completion_id','listing_status_id','area_id','city_id','deleted_by','deleted_at','created_at'])
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

            })->when($request->input('in_compound'), function ($query) use ($request){
                return $query->where('in_a_compound', 'like', '%' . $request->input('in_compound') . '%');

            })->when($request->input('start_price') && $request->input('end_price'), function ($query) use ($request) {
                return $query->where('start_price','<','end_price')->Orwhere('end_price','>','start_price');

            })->when($request->input('start_down_payment') && $request->input('end_down_payment'), function ($query) use ($request) {
                return $query->where('start_down_payment','<','end_down_payment')->Orwhere('end_down_payment','>','start_down_payment');

            })->when($request->input('start_monthly_installment') && $request->input('end_monthly_installment'), function ($query) use ($request) {
                return $query->where('start_monthly_installment','<','end_monthly_installment')->Orwhere('end_monthly_installment','>','start_monthly_installment');

            })->when($request->input('start_payment_duration') && $request->input('end_payment_duration'), function ($query) use ($request) {
                return $query->where('start_payment_duration','<','end_payment_duration')->Orwhere('end_payment_duration','>','start_payment_duration');

            })->when($request->input('type_name'), function ($query) use ($request){
                $query->whereHas('type',function ($q) use ($request){
                    return $q->whereHas('translations', function ($qqq) use ($request) {
                        $qqq->where(function ($subQuery) use ($request) {
                            $subQuery->where('type', 'like', '%' . $request->input('type_name') . '%');
                        });
                    });
                });
            })->when($request->input('reason_name'), function ($query) use ($request){
                $query->whereHas('reason',function ($q) use ($request){
                    return $q->whereHas('translations', function ($qqq) use ($request) {
                        $qqq->where(function ($subQuery) use ($request) {
                            $subQuery->where('reason', 'like', '%' . $request->input('reason_name') . '%');
                        });
                    });
                });
            })->when($request->input('city_name'), function ($query) use ($request){
                $query->whereHas('city',function ($q) use ($request){
                    return $q->whereHas('translations', function ($qqq) use ($request) {
                        $qqq->where(function ($subQuery) use ($request) {
                            $subQuery->where('name', 'like', '%' . $request->input('city_name') . '%');
                        });
                    });
                });
            })->when($request->input('area_name'), function ($query) use ($request){
                $query->whereHas('area',function ($q) use ($request){
                    return $q->whereHas('translations', function ($qqq) use ($request) {
                        $qqq->where(function ($subQuery) use ($request) {
                            $subQuery->where('name', 'like', '%' . $request->input('area_name') . '%');
                        });
                    });
                });
            })->when($request->input('completion_type_name'), function ($query) use ($request){
                $query->whereHas('completion',function ($q) use ($request){
                    return $q->whereHas('translations', function ($qqq) use ($request) {
                        $qqq->where(function ($subQuery) use ($request) {
                            $subQuery->where('completion', 'like', '%' . $request->input('completion_type_name') . '%');
                        });
                    });
                });
            })->when($request->input('sale_type_name'), function ($query) use ($request){
                $query->whereHas('sale',function ($q) use ($request){
                    return $q->whereHas('translations', function ($qqq) use ($request) {
                        $qqq->where(function ($subQuery) use ($request) {
                            $subQuery->where('sale', 'like', '%' . $request->input('sale_type_name') . '%');
                        });
                    });
                });


            })->when($request->input('developer'), function ($query) use ($request){
                return $query->where('developer', 'like', '%' . $request->input('developer') . '%');

            })->when($request->input('delivery_date'), function ($query) use ($request){
                return $query->where('delivery_date', 'like', '%' . $request->input('delivery_date') . '%');

            })->when($request->input('size_of_property'), function ($query) use ($request){
                return $query->where('size_of_property', 'like', '%' . $request->input('size_of_property') . '%');

            })->when($request->input('rooms'), function ($query) use ($request){
                return $query->where('rooms', 'like', '%' . $request->input('rooms') . '%');

            })->when($request->input('payment'), function ($query) use ($request){
                return $query->where('payment', 'like', '%' . $request->input('payment') . '%');


        })->when($request->input('status') && $request->input('status') !='undefined', function ($query) use ($request){
            return $query->where('listing_status_id',  $request->input('status') );

        })->when($request->input('type'), function ($query) use ($request){
            return $query->where('listing_type_id',  $request->input('type') );

        })->when($request->input('city'), function ($query) use ($request){
            return $query->where('city_id',  $request->input('city') );

        })->when($request->input('reason'), function ($query) use ($request){
            return $query->where('listing_reason_id',  $request->input('reason') );

        })->when($request->input('broker'), function ($query) use ($request){
            return $query->where('broker_id',  $request->input('broker') );

        })->when($request->input('listing'), function ($query) use ($request){
                return $query->where('id',  $request->input('listing') );
        });

    }
}
