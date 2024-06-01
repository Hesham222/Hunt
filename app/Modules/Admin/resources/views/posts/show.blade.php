<x-admin::layout>
 <x-slot name="pageTitle">Posts | Show Details</x-slot name="pageTitle">
 @section('posts-active', 'm-menu__item--active m-menu__item--open')
  <x-slot name="style">
  <!-- Some styles -->
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
            Posts
            </h3>
          </div>
        </div>
      </div>
    <div class="m-content">
        <div class="row">
        <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height " >
                    <div class="m-portlet__head" style="background:#212529;">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text" style="color:#fff">
                                Post Informaton
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <section class="content">
                            <ul class="personal_info">
                                <li>
                                    <span style="font-weight:bold">Created Date : </span>
                                    {{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Status : </span>
                                    {{$record->status ? $record->status->status : "--" }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Reason : </span>
                                    {{$record->reason ? $record->reason->reason : "" }} -
                                    {{$record->reasonOption ? $record->reasonOption->option : ""  }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">City : </span>
                                    {{$record->city ? $record->city->name : "--" }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Area : </span>
                                    {{$record->area ? $record->area->name : ($record->other_area ? $record->other_area   : "" ) }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Type : </span>
                                    {{$record->type ? $record->type->type : "--" }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Completion : </span>
                                    {{$record->completion ? $record->completion->completion : "--" }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Sale : </span>
                                    {{$record->sale ? $record->sale->sale : "--" }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">In a compound ? : </span>
                                    {{ $record->getCompound()}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Price Range : </span>
                                    Start : {{$record->start_price ? $record->start_price : "0"  }} -
                                    To : {{$record->end_price ? $record->end_price : "0"  }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Developer : </span>
                                    {{ $record->developer}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Number of rooms : </span>
                                    {{ $record->rooms}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Size Of Property : </span>
                                    {{ $record->size_of_property}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Payment : </span>
                                    {{ $record->payment}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Down Payment Range : </span>
                                    Start : {{$record->start_down_payment ? $record->start_down_payment : "0"  }} -
                                    To : {{$record->end_down_payment ? $record->end_down_payment : "0"  }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Monthly Installment Range : </span>
                                    Start : {{$record->start_monthly_installment ? $record->start_monthly_installment : "0"  }} -
                                    To : {{$record->end_monthly_installment ? $record->end_monthly_installment : "0"  }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Payment Duration Range : </span>
                                    Start : {{$record->start_payment_duration ? $record->start_payment_duration : "0"  }} -
                                    To : {{$record->end_payment_duration ? $record->end_payment_duration : "0"  }}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Delivery Date : </span>
                                    {{ $record->delivery_date}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Description : </span>
                                    {{ $record->description}}
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height " >
                    <div class="m-portlet__head" style="background:#212529;">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text" style="color:#fff">
                                Individual Infromation
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <section class="content">
                            <ul class="personal_info">
                                <li>
                                    <span style="font-weight:bold">Id : </span>
                                    {{$record->individual ? $record->individual->id : ""}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Name : </span>
                                    {{$record->individual ? $record->individual->first_name . ' ' .$record->individual->last_name : ""}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Email : </span>
                                    {{$record->individual ? $record->individual->email : ""}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Phone : </span>
                                    {{$record->individual ? $record->individual->phone : ""}}
                                </li>
                                <li>
                                    <span style="font-weight:bold">Date of birth : </span>
                                    {{$record->individual ? $record->individual->date_of_birth : ""}}
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--full-height " >
                    <div class="m-portlet__head" style="background:#212529;">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text" style="color:#fff">
                                Comments
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        @include('Admin::posts.components.comments.table')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--full-height " >
                    <div class="m-portlet__head" style="background:#212529;">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text" style="color:#fff">
                                    Messages
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        @include('Admin::posts.components.messages.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
  <x-slot name="scripts">
    <!-- Some JS -->
    <script type="text/javascript">

    </script>
  </x-slot>
  </x-admin::layout>
