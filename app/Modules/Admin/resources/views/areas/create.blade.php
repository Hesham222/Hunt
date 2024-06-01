<x-admin::layout>
 <x-slot name="pageTitle">Areas | Create</x-slot name="pageTitle">
 @section('areas-active', 'm-menu__item--active m-menu__item--open')
 @section('areas-create-active', 'm-menu__item--active')
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
              Areas
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
                  <form method="POST" action="{{route('admins.area.store')}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label> Name in English:</label>
                                  <input
                                      type="text"
                                      value="{{old('name_en')}}"
                                      name="name_en"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Name in english..." />
                                  @error('name_en')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label> Name in Arabic:</label>
                                  <input
                                      type="text"
                                      value="{{old('name_ar')}}"
                                      name="name_ar"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Name in arabic..." />
                                  @error('name_ar')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>City:</label>
                                  <select name="city_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($cities as $city)
                                          <option @if(old('city_id')== $city->id) selected @endif
                                          value="{{ $city->id }}">{{ $city->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('city_id')
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
  </x-slot>

  </x-admin::layout>
