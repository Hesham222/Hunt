<x-admin::layout>
 <x-slot name="pageTitle">Individuals | Create</x-slot name="pageTitle">
 @section('individuals-active', 'm-menu__item--active m-menu__item--open')
 @section('individuals-create-active', 'm-menu__item--active')
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
              Individuals
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
                  <form enctype="multipart/form-data" method="POST" action="{{route('admins.individual.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>First Name:</label>
                                  <input
                                    type="text"
                                    value="{{old('first_name')}}"
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
                                      value="{{old('last_name')}}"
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
                                    value="{{old('email')}}"
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
                                      value="{{old('phone')}}"
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
                                      value="{{old('date_of_birth')}}"
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
                                  @error('image')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>Password:</label>
                                  <div class="m-input-icon m-input-icon--right">
                                      <input
                                          type="password"
                                          name="password"
                                          required=""
                                          class="form-control m-input"
                                          placeholder="Enter your password..."
                                          maxlength="191"
                                      />

                                  </div>
                                  @error('password')
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
  </x-slot>

  </x-admin::layout>
