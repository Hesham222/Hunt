<x-admin::layout>
 <x-slot name="pageTitle">Profile Colours | Edit</x-slot name="pageTitle">
 @section('profile_colours-active', 'm-menu__item--active m-menu__item--open')
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
              Profile Colour
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
                  <form method="POST" action="{{route('admins.profile_colour.update', $record->id)}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                          <div class="col-lg-6">
                                  <label>Account Type:</label>
                                    @if(old('account_type'))
                                      <select name="account_type" required=""
                                              class="form-control m-input m-input--square"
                                              id="exampleSelect1">
                                          <option @if(old('account_type')=='Developers' ) selected
                                                  @endif value="Developers">Developers
                                          </option>
                                          <option @if(old('account_type')=='Brokers' ) selected
                                                  @endif value="Brokers">Brokers
                                          </option>
                                          <option @if(old('account_type')=='Individuals' ) selected
                                                  @endif value="Individuals">Individuals
                                          </option>
                                          
                                      </select>
                                  @else
                                      <select name="account_type" required=""
                                              class="form-control m-input m-input--square"
                                              id="exampleSelect1">
                                          <option @if($record->accountType=='Developers') selected
                                                  @endif value="Developers">Developers
                                          </option>
                                          <option @if($record->accountType=='Brokers') selected
                                                  @endif value="Brokers">Brokers
                                          </option>
                                          <option @if($record->accountType=='Individuals') selected
                                                  @endif value="Individuals">Individuals
                                          </option>
                                      </select>
                                  @endif
                                  @error('account_type')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                              <div class="col-lg-6">
                                  <label>Colour :</label>
                                  <input
                                      type="color"
                                      value="{{old('colour')?old('colour'):$record->colour}}"
                                      name="colour"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Color..." />
                                  @error('colour')
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
 </x-admin::layout>
