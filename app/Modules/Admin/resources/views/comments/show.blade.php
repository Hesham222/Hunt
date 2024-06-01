<x-admin::layout>
    <x-slot name="pageTitle">Comment | Details</x-slot name="pageTitle">
    @section('comments-active', 'm-menu__item--active m-menu__item--open')
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
                    Comment
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div style="display: none;" class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="flaticon-exclamation m--font-brand">
                </i>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Comment
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <table class="table table-striped- table-bordered table-hover table-checkable" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Post ID</th>
                                    <th>Commenter</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$record->id}}</td>
                                <td>{{$record->post_id}}</td>
                                @if(!empty($record->individual->first_name))
                                    <td>{{$record->individual->first_name}}</td>

                                @elseif(!empty($record->broker->first_name))
                                    <td>{{$record->broker->first_name}}</td>
                                @else
                                    <td>{{$record->developer->first_name}}</td>
                                @endif

                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <th>In a Compound</th>
                                <th>Number of Rooms</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$record->post->getCompound()}}</td>
                                <td>{{$record->post->num_of_rooms}}</td>

                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <th>Price Range From</th>
                                <th>Price Range To</th>
                                <th>Sale Type</th>
                                <th>Developer</th>
                                <th>Size of Property</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$record->post->start_price}}</td>
                                <td>{{$record->post->end_price}}</td>
                                <td>{{$record->post->developer}}</td>
                                <td>{{$record->post->size_of_property}}</td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <th>Payment</th>
                                <th>Down payment Range From</th>
                                <th>Down payment Range To</th>
                                <th>Monthly installment range From</th>
                                <th>Monthly installment range To</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$record->post->payment}}</td>
                                <td>{{$record->post->start_down_payment}}</td>
                                <td>{{$record->post->end_down_payment}}</td>
                                <td>{{$record->post->start_monthly_installment}}</td>
                                <td>{{$record->post->end_monthly_installment}}</td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <th>Payment duration range From</th>
                                <th>Payment duration range To</th>
                                <th>Delivery date</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$record->post->start_payment_range}}</td>
                                <td>{{$record->post->end_payment_range}}</td>
                                <td>{{$record->post->delivery_date}}</td>
                         </tr>
                            </tbody>
                            <thead>
                                <th>Status</th>
                                <th>Image</th>
                            </thead>
                            <tbody>
                                <td>{{$record->post->PostStatus->translate('en')->name}}</td>
                                <td> <img src="{{asset('storage'.DS().$record->post->image)}}" alt="image-not-uploaded" width="100"></td>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->

    <x-slot name="scripts">
        <!-- Some JS -->
    </x-slot>

</x-admin::layout>
