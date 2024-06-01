<form  method="GET"  action="{{route('admins.post.export')}}" id="filterDataForm">
<input type="hidden" name="view" value="{{ request()->input('view',0)}}">
<input type="hidden" name="post" value="{{ request()->input('post',0)}}">
<input type="hidden" name="individual" value="{{ request()->input('individual',0)}}">
<div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
    <div class="input-group" style="width: 40%">
        <select
                name="city"
                id="cityColumn"
                class="form-control"
                data-live-search="true"
                title="Please select city ...">
          <option value="">All Cities</option>
          @foreach($cities as $city)
              <option value="{{$city->id}}">{{$city->name}}</option>
          @endforeach
        </select>
      </div>
      @if(request()->input('view')!='request')
      <div class="input-group" style="width: 40%">
        <select
                name="status"
                id="statusColumn"
                class="form-control"
                data-live-search="true"
                title="Please select the status ...">
          <option value="">All Statuses</option>
          @foreach($statuses as $status)
              <option value="{{$status->id}}">{{$status->status}}</option>
          @endforeach
        </select>
      </div>
      @endif
      <div class="input-group" style="width: 40%">
        <select
                name="reason"
                id="reasonColumn"
                class="form-control"
                data-live-search="true"
                title="Please select the reason ...">
          <option value="">All Reasons</option>
          @foreach($reasons as $reason)
              <option value="{{$reason->id}}">{{$reason->reason}}</option>
          @endforeach
        </select>
      </div>
      <div class="input-group" style="width: 40%">
        <select
                name="type"
                id="typeColumn"
                class="form-control"
                data-live-search="true"
                title="Please select the type ...">
          <option value="">All Types</option>
          @foreach($types as $type)
              <option value="{{$type->id}}">{{$type->type}}</option>
          @endforeach
        </select>
      </div>
  </div>
  <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
    <div class="input-group" style="width: 50%">
      <div class="input-group-prepend">
        <span class="input-group-text" id="">From</span>
        <input type="date" name="start_date" id="startDateCol" class="form-control">
      </div>
      @if($errors->has('start_date'))
      <span class="invalid-feedback" style="display:block;" role="alert">
        <strong>{{ $errors->first('start_date') }}</strong>
      </span>
      @endif
      <div class="input-group-prepend">
        <span class="input-group-text" id="">To</span>
        <input type="date" name="end_date" id="endDateCol" class="form-control">
      </div>
      @if($errors->has('end_date'))
      <span class="invalid-feedback" style="display:block;" role="alert">
        <strong>{{ $errors->first('end_date') }}</strong>
      </span>
      @endif
    </div>
    <div class="input-group" style="width: 50%">
      <input type="text"   placeholder="Key...." name="value" id="searchField" class="form-control" aria-label="Text input with dropdown button">
      <div class="input-group-append">
        <select
                name="column"
                id="searchColumn"
                class="form-control"
                data-live-search="true"
                title="Please select a lunch ...">
          <option value="_id">ID</option>
          @if(request()->query('view')=='trash')
            <option value="deletedBy">Deleted By</option>
          @endif
        </select>
      </div>
      <div class="input-group-append">
        <button
                id="searchButton"
                class="btn btn-primary"
                type="button"
                title="search data"
                >
          <i class="fa fa-search"></i>
        </button>
        <button
                id="exportButton"
                class="btn btn-primary"
                type="submit"
                style="margin:0 5px"
                title="export data"
                >
          <i class="fa fa-file"></i>
        </button>
      </div>
    </div>
  </div>
</form>
