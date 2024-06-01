<x-admin::layout>
 <x-slot name="pageTitle">Brokers | Edit</x-slot name="pageTitle">
 @section('brokers-active', 'm-menu__item--active m-menu__item--open')
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
                Brokers
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
                  Edit
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form enctype="multipart/form-data" method="POST" action="{{route('admins.broker.update', $record->id)}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>First Name:</label>
                                  <input
                                      type="text"
                                      value="{{old('first_name')?old('first_name'):$record->first_name}}"
                                      name="first_name"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Enter first name..." />
                                  @error('first_name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>Last Name:</label>
                                  <input
                                      type="text"
                                      value="{{old('last_name')?old('last_name'):$record->last_name}}"
                                      name="last_name"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Enter last name..." />
                                  @error('last_name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label class="">Email:</label>
                                  <input
                                      type="email"
                                      value="{{old('email')?old('email'):$record->email}}"
                                      name="email"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Enter email..." />
                                  @error('email')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label class="">Phone:</label>
                                  <input
                                      type="phone" maxlength="15"
                                      value="{{old('phone')?old('phone'):$record->phone}}"
                                      name="phone"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Enter phone..."
                                      id="phone"
                                  />
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label class="">Date of birth:</label>
                                  <input
                                      type="date"
                                      value="{{old('date_of_birth')?old('date_of_birth'):$record->date_of_birth}}"
                                      name="date_of_birth"
                                      required=""
                                      class="form-control m-input"
                                  />
                                  @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label class="">Picture:</label>
                                  <input
                                      type="file"
                                      name="image"
                                      class="form-control m-input"
                                  />
                                  @if($record->image)
                                    @if(filter_var($record->image, FILTER_VALIDATE_URL))
                                      <img src="{{ $record->image }}" alt="image-not-uploaded" width="100"></td>
                                    @else
                                        <img src="{{asset('storage'.DS().$record->image)}}" alt="image-not-uploaded" width="100"></td>
                                    @endif 
                                  @endif
                                  @error('image')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>Brokerage Firm Name:</label>
                                  <input
                                      type="text"
                                      value="{{old('brokerage_firm_name')?old('brokerage_firm_name'):$record->brokerage_firm_name}}"
                                      name="brokerage_firm_name"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Enter Brokerage Firm Name..." />
                                  @error('brokerage_firm_name')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                      </div>
                      <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                          <div class="m-form__actions m-form__actions--solid">
                              <div class="row">
                                  <div class="col-lg-6">
                                  </div>
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
  </x-slot>
    <script type="text/javascript">
      var input = document.getElementById("phone");
      input.onkeypress = function (e)
      {
          e = e || window.event;
          var charCode = (typeof e.which == "number") ? e.which : e.keyCode;
          if (!charCode || charCode == 8 /* Backspace */)
              return;
          var typedChar = String.fromCharCode(charCode);
          if (/\d/.test(typedChar))
              return;
          if (typedChar == "+" && this.value == "")
              return;
          return false;
      };
    </script>
  </x-admin::layout>
