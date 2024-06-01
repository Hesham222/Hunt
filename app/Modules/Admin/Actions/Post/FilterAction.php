<?php
namespace Admin\Actions\Post;
use Illuminate\Http\Request;
use Admin\Models\Posts\Post;
use Carbon\Carbon;
class FilterAction
{
    public function execute(Request $request)
    {
        return Post::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->when($request->input('view') == 'request', function ($query) use ($request) {
            return $query->where('post_status_id', 1);
        })->when($request->input('view') == 'view', function ($query) use ($request) {
            return $query->where('post_status_id','!=', 1);
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['individual' => function ($query) use ($request) {
            $query->select(['id','first_name','last_name','email','phone']);
        }])
        ->with(['city' => function ($query) use ($request) {
            $query->select(['id']);
        }])
        ->with(['area' => function ($query) use ($request) {
            $query->select(['id']);
        }])
        ->with(['reason' => function ($query) use ($request) {
            $query->select(['id']);
        }])
        ->with(['reasonOption' => function ($query) use ($request) {
            $query->select(['id']);
        }])
        ->with(['sale' => function ($query) use ($request) {
            $query->select(['id']);
        }])
        ->with(['completion' => function ($query) use ($request) {
            $query->select(['id']);
        }])
        ->with(['status' => function ($query) use ($request) {
            $query->select(['id']);
        }])->where(['post_status_id'=>2])
        ->select(['id','individual_id','city_id','in_a_compound','size_of_property','post_sale_id','developer','start_price','end_price','end_payment_duration','start_payment_duration','end_monthly_installment','start_monthly_installment','end_down_payment','rooms','payment','start_down_payment','post_sale_id','area_id','post_reason_id','post_reason_option_id','post_type_id','post_sale_id','post_completion_id','post_status_id','delivery_date','deleted_by','deleted_at','created_at'])
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
                        return $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
            })

            ->when($request->input('in_compound'), function ($query) use ($request){
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

            }) ->when($request->input('status') && $request->input('status') !='undefined', function ($query) use ($request){
            return $query->where('post_status_id',  $request->input('status') );

            })->when($request->input('individual'), function ($query) use ($request){
                return $query->where('individual_id',  $request->input('individual') );


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

            })->when($request->input('post'), function ($query) use ($request){
                return $query->where('id',  $request->input('post') );

            })->when($request->input('type'), function ($query) use ($request){
                    return $query->where('post_type_id',  $request->input('type') );

                })->when($request->input('city'), function ($query) use ($request){
                    return $query->where('city_id',  $request->input('city') );

                })->when($request->input('reason'), function ($query) use ($request){
                    return $query->where('post_reason_id',  $request->input('reason') );
            });

    }
}
