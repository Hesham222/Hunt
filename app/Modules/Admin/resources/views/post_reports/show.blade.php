<x-admin::layout>
    <x-slot name="pageTitle">Individual Reported | Show Details</x-slot name="pageTitle">
    @section('reports-posts-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
    @include('Admin::_modals.confirm_password')
    @include('Admin::_modals.reset_users_password')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    Individual Reported
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <section class="content">
                    <div class="table-responsive">
                        <section class="content table-responsive">
                            <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date of birth</th>
                                    <th>Picture</th>
                                    <th>Created By</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <td>{{$record->post->individual->id}}</td>
                                    <td>
                                        <span style="font-weight:bold;color:{{$record->post->individual->getStatusColor()}}">
                                            {{$record->post->individual->status}}
                                        </span>
                                    </td>
                                    <td>{{$record->post->individual->first_name}}</td>
                                    <td>{{$record->post->individual->last_name}}</td>
                                    <td>{{$record->post->individual->email}}</td>
                                    <td>{{$record->post->individual->phone}}</td>
                                    <td>{{$record->post->individual->date_of_birth}}</td>
                                    <td>
                                        @if(filter_var($record->post->individual->image, FILTER_VALIDATE_URL))
                                            <img src="{{ $record->post->individual->image }}" alt="image-not-uploaded" width="100"></td>
                                        @else
                                        <img src="{{asset('storage'.DS().$record->post->individual->image)}}" alt="image-not-uploaded" width="100"></td>
                                        @endif
                                    </td>
                                        <td>{{$record->post->individual->createdBy ? $record->post->individual->createdBy->name : "NONE"}}</td>
                                        <td>{{ date('M d, Y', strtotime($record->post->individual->created_at)) .'-'.date('h:i a', strtotime($record->post->individual->created_at)) }}</td>
                                        <td>
                                            @if($record->post->individual->status != 'blocked')
                                                {{-- block--}}
                                                <a
                                                    class="btn btn-sm btn-danger"
                                                    style="margin:5px"
                                                    title="Block"
                                                    data-toggle="modal"
                                                    data-target="#confirm-password-modal"
                                                    onclick="injectModalData('{{$record->post->individual->id}}', '{{route('admins.individual.block')}}', 'confirm-password-form', 'POST')" >
                                                    <i class="fa fa-ban" style="color: #fff"></i>
                                                </a>
                                            @else
                                                {{-- unblock--}}
                                                <a
                                                    class="btn btn-sm btn-success"
                                                    style="margin:5px"
                                                    title="Unblock"
                                                    data-toggle="modal"
                                                    data-target="#confirm-password-modal"
                                                    onclick="injectModalData('{{$record->post->individual->id}}', '{{route('admins.individual.block')}}', 'confirm-password-form', 'POST')" >
                                                    <i class="fa fa-check" style="color: #fff"></i>
                                                </a>
                                            @endif
                                        </td>
                                </tbody>
                            </table>
                            <div id="paginationLinksContainer" style="display: flex;justify-content: center;align-items: center;margin-top: 10px"></div>
                        </section>
                    </div>
                </section>
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
