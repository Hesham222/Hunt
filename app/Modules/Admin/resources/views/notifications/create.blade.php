<x-admin::layout>
 <x-slot name="pageTitle">Notifications | Create</x-slot name="pageTitle">
 @section('notifications-active', 'm-menu__item--active m-menu__item--open')
 @section('notifications-create-active', 'm-menu__item--active')
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
            Notifications
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
                  Create
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form method="POST" action="{{route('admins.notification.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>Title:</label>
                                  <input
                                    type="text"
                                    value="{{old('title')}}"
                                    name="title"
                                    required=""
                                    class="form-control m-input"
                                    placeholder="Enter title..." />
                                  @error('title')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>Message:</label>
                                  <textarea
                                      name="message"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Enter  message..." >{{old('message')}}</textarea>
                                  @error('message')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>Recipient user(s):</label>
                                  <select name="type" required=""
                                          class="form-control m-input m-input--square"
                                          id="RecipientUserSelect">
                                      <option @if(old('type')=='all' ) selected
                                              @endif value="all">All Users
                                      </option>
                                      <option @if(old('type')=='individuals' ) selected
                                              @endif value="individuals">All individual
                                      </option>
                                      <option @if(old('type')=='brokers' ) selected
                                              @endif value="brokers">All Brokers
                                      </option>
                                      <option @if(old('type')=='developers' ) selected
                                              @endif value="developers">All developers
                                      </option>
                                      <option @if(old('type')=='specific' ) selected
                                              @endif value="specific">a specific user
                                      </option>
                                  </select>
                                  @error('type')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6" id="aspecfic-user-type">

                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-12" id="aspecfic-user-list">

                              </div>
                          </div>
                      </div>
                      <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                          <div class="m-form__actions m-form__actions--solid">
                              <div class="row">
                                  <div class="col-lg-6"></div>
                                  <div class="col-lg-6 m--align-right">
                                      <button type="submit" class="btn btn-primary">Save</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
                </section>
            </div>
          </div>
        </div>
      </div>
    <!-- end page content -->
  <x-slot name="scripts">
    <!-- Some JS -->
    <script>
      $(document).on('change', '#RecipientUserSelect', function(event) {
        if(this.value != 'specific'){
          $('#aspecfic-user-type').empty();
          $('#aspecfic-user-list').empty();
          return 0;
        }
        $.ajax({
            url: "{!! route('admins.notification.specific.users.type')!!}",
            method: 'GET',
            data: {type: this.value},
            dataType: 'JSON',
            beforeSend: function () {
            },
            success: function (data) {
              $('#aspecfic-user-type').html(data['data']['responseHTML']).hide().fadeIn('slow');
            }
            , error: function (data) {
              toastr.error('Failed, Please try again later.');
            }
        });
      });
      $(document).on('change', '#aspecificUserSelectType', function(event)
      {
        if(this.value == null)
        {
          return 0;
        }
        $.ajax({
          url: "{!! route('admins.notification.specific.users.list')!!}",
            method: 'GET',
            data: {type: this.value},
            dataType: 'JSON',
            beforeSend: function () {
            },
            success: function (data) {
              $('#aspecfic-user-list').html(data['data']['responseHTML']).hide().fadeIn('slow');
              $('.selectpicker').selectpicker();
            }
            , error: function (data) {
              toastr.error('Failed, Please try again later.');
            }
        });
      });
  </script>
  </x-slot>

  </x-admin::layout>
