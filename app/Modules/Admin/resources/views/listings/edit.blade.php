<x-admin::layout>
 <x-slot name="pageTitle">Listings | Edit</x-slot name="pageTitle">
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
                Listings
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
                  <form enctype="multipart/form-data" method="POST" action="{{route('admins.listing.update', $record->id)}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>Creator/Developer/Broker:</label>
                                     <ul>
                                        <li><span style="font-weight:bold">User Type : </span>{{ $record->createdUsers()}}</li>
                                        <li><span style="font-weight:bold">ID : </span>{{ $record->user() ? $record->user()->id : ""  }}</li>
                                        <li><span style="font-weight:bold">Name : </span>{{ $record->user() ? $record->user()->first_name .' '. $record->user()->last_name  : ""  }}</li>
                                        <li><span style="font-weight:bold">Phone : </span>{{ $record->user() ? $record->user()->phone : ""  }}</li>
                                        <li><span style="font-weight:bold">Email : </span>{{ $record->user() ? $record->user()->email : ""  }}</li>
                                    </ul>
                              </div>
                              <div class="col-lg-6">
                                  <label>Reason:</label>
                                  <select name="listing_reason_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($reasons as $reason)
                                          <option @if(old('listing_reason_id')== $reason->id || $reason->id==$record->listing_reason_id) selected @endif
                                          value="{{ $reason->id }}">{{ $reason->reason }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('listing_reason_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>Status:</label>
                                  <select name="listing_status_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($statuses as $status)
                                          <option @if(old('list_status_id')== $status->id || $status->id==$record->listing_status_id ) selected @endif
                                          value="{{ $status->id }}">{{ $status->status }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('listing_status_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>Completion:</label>
                                  <select name="listing_completion_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($completions as $completion)
                                          <option @if(old('listing_completion_id')== $completion->id || $completion->id==$record->listing_completion_id) selected @endif
                                          value="{{ $completion->id }}">{{ $completion->translate('en')->completion }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('listing_completion_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>City:</label>
                                  <select name="city_id" id="city_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($cities as $city)
                                          <option @if(old('city_id')== $city->id || $city->id==$record->city_id) selected @endif
                                          value="{{ $city->id}}">{{ $city->name }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('city_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div id="appendAreas" class="col-lg-6">
                                  @include('Admin::posts.components.append_areas')
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label>Type:</label>
                                  <select name="listing_type_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($types as $type)
                                          <option @if(old('listing_type_id')== $type->id || $type->id==$record->listing_type_id) selected @endif
                                          value="{{ $type->id }}">{{ $type->type }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('listing_type_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>Sale:</label>
                                  <select name="listing_sale_id" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      @foreach($sales as $sale)
                                          <option @if(old('listing_sale_id')== $sale->id || $sale->id==$record->listing_sale_id) selected @endif
                                          value="{{ $sale->id }}">{{ $sale->sale }}
                                          </option>
                                      @endforeach
                                  </select>
                                  @error('listing_sale_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>In a Compound:</label>
                                  <select name="in_a_compound" required=""
                                          class="form-control m-input m-input--square"
                                          id="exampleSelect1">
                                      <option @if(old('in_a_compound')== $record->in_a_compound && $record->in_a_compound == 0 ) selected @endif
                                      value="0">No
                                      </option>
                                      <option @if(old('in_a_compound')== $record->in_a_compound && $record->in_a_compound == 1 ) selected @endif
                                      value="1">yes
                                      </option>
                                  </select>
                                  @error('in_a_compound')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>Start Price:</label>
                                  <input type="number"
                                         value="{{$record->start_price}}"
                                         class="form-control m-input"
                                         name="start_price"
                                         required=""
                                         min="1">
                                  @error('start_price')
                                  <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>End Price:</label>
                                  <input type="number"
                                         value="{{$record->end_price}}"
                                         class="form-control m-input"
                                         name="end_price"
                                         required=""
                                  >
                                  @error('end_price')
                                  <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                          </div>
                           <div class="form-group m-form__group row">
                               <div class="col-lg-4">
                                   <label>Developer:</label>
                                   <input
                                       type="text"
                                       value="{{old('developer')?old('developer'):$record->developer}}"
                                       name="developer"
                                       required=""
                                       class="form-control m-input"
                                       placeholder="Enter developer..." />
                                   @error('developer')
                                   <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                   @enderror
                               </div>
                               <div class="col-lg-4">
                                   <label>Numbers of Rooms:</label>
                                   <input
                                       type="number"
                                       value="{{old('rooms')?old('rooms'):$record->rooms}}"
                                       name="rooms"
                                       required=""
                                       min="1"
                                       class="form-control m-input"
                                       placeholder="Enter full name..." />
                                   @error('rooms')
                                   <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                   @enderror
                               </div>
                               <div class="col-lg-4">
                                   <label>Size of property:</label>
                                   <input
                                       type="number"
                                       value="{{old('size_of_property')?old('size_of_property'):$record->size_of_property}}"
                                       name="size_of_property"
                                       required=""
                                       class="form-control m-input"
                                       placeholder="Enter size of property..." />
                                   @error('size_of_property')
                                   <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                   @enderror
                               </div>
                           </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-4">
                                  <label>Payment:</label>
                                  <input
                                      type="number"
                                      value="{{old('payment')?old('payment'):$record->payment}}"
                                      name="payment"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Payment..." />
                                  @error('payment')
                                  <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>Start Down Payment:</label>
                                  <input
                                      type="number"
                                      value="{{old('start_down_payment')?old('start_down_payment'):$record->start_down_payment}}"
                                      name="start_down_payment"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="start down payment..." />
                                  @error('start_down_payment')
                                  <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                  <label>End Down Payment:</label>
                                  <input
                                      type="number"
                                      value="{{old('end_down_payment')?old('end_down_payment'):$record->end_down_payment}}"
                                      name="end_down_payment"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="end down payment..." />
                                  @error('end_down_payment')
                                  <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                  <label>Start Monthly Installment:</label>
                                  <input
                                      type="number"
                                      value="{{old('start_monthly_installment')?old('start_monthly_installment'):$record->start_monthly_installment}}"
                                      name="start_monthly_installment"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="start monthly installment..." />
                                  @error('start_monthly_installment')
                                  <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>End Monthly Installment:</label>
                                  <input
                                      type="number"
                                      value="{{old('end_monthly_installment')?old('end_monthly_installment'):$record->end_monthly_installment}}"
                                      name="end_monthly_installment"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="end monthly installment..." />
                                  @error('end_monthly_installment')
                                  <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                  <label>Start Payment Duration:</label>
                                  <input
                                      type="number"
                                      value="{{old('start_payment_duration')?old('start_payment_duration'):$record->start_payment_duration}}"
                                      name="start_payment_duration"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Start Payment Duration..." />
                                  @error('start_payment_duration')
                                  <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>End Payment Duration:</label>
                                  <input
                                      type="number"
                                      value="{{old('end_payment_duration')?old('end_payment_duration'):$record->end_payment_duration}}"
                                      name="end_payment_duration"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="end payment duration..." />
                                  @error('end_payment_duration')
                                  <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label class="">Delivery date:</label>
                                  <input
                                      type="date"
                                      value="{{old('delivery_date')?old('delivery_date'):$record->delivery_date}}"
                                      name="delivery_date"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Enter Date..."
                                  />
                                  @error('delivery_date')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-6">
                                  <label>Title:</label>
                                  <textarea
                                      name="title"
                                      required=""
                                      class="form-control m-input"
                                      placeholder="Enter title..." >{{old('title')?old('title'):$record->title}}</textarea>
                                  @error('title')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group m-form__group row">
                              @if($record->checkPost() == 'Listing')
                                  @foreach($record->images as $image)
                                      <div class="col-lg-4">
                                          <input name="attachment-{{$image->id}}" type="file">
                                          @if(pathinfo($image->attachment, PATHINFO_EXTENSION) == 'pdf')
                                              <a target="_blank" href="{{asset('storage'.DS().$image->attachment)}}">View pdf</a>
                                          @else
                                              @if(filter_var($image->attachment, FILTER_VALIDATE_URL))
                                                  <img src="{{ $image->attachment }}" alt="image-not-uploaded" width="100">
                                              @else
                                                  <img src="{{asset('storage'.DS().$image->attachment)}}" alt="image-uploaded" width="100">
                                              @endif
                                          @endif
                                      </div>
                                  @endforeach
                              @else
                                  <label>Images:</label>
                                  <br>
                                  <h5>No Images Uploaded</h5>
                              @endif
                              @error('attachment')
                              <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                              @enderror

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
    <script>
        $('#city_id').change(function(){
            var city_id = $(this).val();
            var area_id =$(this).data('area');
            $.ajax({
                type:'get',
                url:"{{route('admins.listing.append.areas')}}",
                data:{city_id:city_id,area_id:area_id},
                success:function(resp){
                    $("#appendAreas").html(resp);
                },error:function(){
                    alert('Error');
                }
            });
        });
    </script>

  </x-slot>

  </x-admin::layout>
