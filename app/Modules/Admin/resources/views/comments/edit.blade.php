<x-admin::layout>
    <x-slot name="pageTitle">Comment | Edit</x-slot name="pageTitle">
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
                    Comments
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
                        <form enctype="multipart/form-data" method="POST" action="{{route('admins.comment.update', $record->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    @if(!empty($record->broker->first_name))
                                        <div class="col-lg-6">
                                            <label>Broker:</label>
                                            <select name="broker_id" required=""
                                                    class="form-control m-input m-input--square"
                                                    id="exampleSelect1">
                                                @foreach($brokers as $broker)
                                                    <option @if(old('broker_id')== $broker->id || $broker->id==$record->broker_id) selected @endif
                                                    value="{{ $broker->id }}">{{ $broker->first_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('broker_id')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                            @enderror
                                        </div>
                                    @elseif(!empty($record->developer->first_name))
                                        <div class="col-lg-6">
                                            <label>Developer:</label>
                                            <select name="developer_id" required=""
                                                    class="form-control m-input m-input--square"
                                                    id="exampleSelect1">
                                                @foreach($developers as $developer)
                                                    <option @if(old('developer_id')== $developer->id || $developer->id==$record->developer_id) selected @endif
                                                    value="{{ $developer->id }}">{{ $developer->first_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('developer_id')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                            @enderror
                                        </div>
                                    @else
                                        <div class="col-lg-6">
                                            <label>Individual:</label>
                                            <select name="individual_id" required=""
                                                    class="form-control m-input m-input--square"
                                                    id="exampleSelect1">
                                                @foreach($individuals as $individual)
                                                    <option @if(old('individual_id')== $individual->id || $individual->id==$record->individual_id) selected @endif
                                                    value="{{ $individual->id }}">{{ $individual->first_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('individual_id')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                            @enderror
                                        </div>
                                    @endif

                                        <div class="col-lg-6">
                                            <label>Post:</label>
                                            <input
                                                type="text"
                                                value="{{old('post_id')?old('post_id'):$record->post_id}}"
                                                name="post_id"
                                                required=""
                                                class="form-control m-input">
                                            @error('post_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>Description:</label>
                                        <input
                                            type="text"
                                            value="{{old('description')?old('description'):$record->description}}"
                                            name="description"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="Enter Description..." />
                                        @error('description')
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
