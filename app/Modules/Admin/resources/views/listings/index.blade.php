<x-admin::layout>
@if(request()->input('view')=='trash')
  <x-slot name="pageTitle">Listings | Trash</x-slot name="pageTitle">
  @section('listings-trash-active', 'm-menu__item--active')
@elseif(request()->input('view')=='request')
  <x-slot name="pageTitle">Listings | Requests</x-slot name="pageTitle">
  @section('listings-request-active', 'm-menu__item--active')
@else
  <x-slot name="pageTitle">Listings | View</x-slot name="pageTitle">
  @section('listings-view-active', 'm-menu__item--active')
@endif
@section('posts-active', 'm-menu__item--active m-menu__item--open')
@include('Admin::_modals.confirm_password')
@include('Admin::_modals.reset_admin_password')
  <x-slot name="style">
    <!-- Some styles -->
  </x-slot>
    <!-- Start page content -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
            Listings
            </h3>
          </div>
        </div>
      </div>
      <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
          <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                {{request()->input('view')=='trash' ? 'Trash' :(request()->input('view')=='request'  ?'Requests':'View' )}}
                </h3>
              </div>
            </div>
            <div class="m-portlet__head-tools">
              <ul class="m-portlet__nav">
              </ul>
            </div>
          </div>
          <div class="m-portlet__body">
             <section class="content">
                @include('Admin::listings.components.filterForm')
                <div class="table-responsive">
                    <section class="content table-responsive">
                      <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                          <thead>
                          <tr>
                              <th>ID</th>
                              <th>Title</th>
                              @if(request()->query('view')=='trash')
                              <th>Deleted By</th>
                              <th>Deleted At</th>
                              @endif
                              <th>Status</th>
                              <th>Created Users</th>
                              <th>Broker/Developer</th>
                              <th>Reason</th>
                              <th>Type</th>
                              <th>City</th>
                              <th>In a compound ?</th>
                              <th>Created at</th>
                              <th>Actions</th>
                          </tr>
                          </thead>
                          <tbody id="spinner">
                            <tr>
                                <td style="height: 100px;text-align: center;line-height: 100px;" colspan="20">
                                    <i class="fa fa-spinner fa-spin text-primary" style="font-size: 30px"aria-hidden="true"></i>
                                </td>
                            </tr>
                          </tbody>
                          <tbody id="data-table-body"></tbody>
                      </table>
                      <div id="paginationLinksContainer" style="display: flex;justify-content: center;align-items: center;margin-top: 10px"></div>
                    </section>
                </div>
              </section>
          </div>
        </div>
      </div>
    <!-- End page content -->
<x-slot name="scripts">
  <script>
    $(function () {
        render("{!! route('admins.listing.data',['view' => request()->input('view',0),'developer' => request()->input('developer',0),'broker' => request()->input('broker',0)]) !!}");
        /**
         * When Click on the pagination buttons, calling this script.
         *
         * */
        $('#paginationLinksContainer').on('click', 'a.page-link', function (event) {
            event.stopPropagation();
            render($(this).attr('href'));
            return false;
        });
        /**
         * When Click on the search button, calling this script.
         *
         * */
        $('#searchButton').on('click', function (event) {
            event.stopPropagation();
            render("{!! route('admins.listing.data',['view' => request()->input('view',0),'broker' => request()->input('broker',0),'developer' => request()->input('developer',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val()+ '&city=' + $('#cityColumn').val()+ '&status=' + $('#statusColumn').val()+ '&reason=' + $('#reasonColumn').val()+ '&type=' + $('#typeColumn').val());
        });
    });
  </script>
  <!-- external JS -->

</x-slot>
</x-admin::layout>
