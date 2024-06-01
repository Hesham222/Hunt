<form  method="GET"  action="{{route('admins.notification.export')}}" id="filterDataForm">
  <input type="hidden" name="view" value="{{ request()->input('view',0)}}">
  <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
    <div  style="width: 100%">
      <div class="">
        <select
                name="type"
                id="typeColumn"
                class="form-control"
                data-live-search="true"
                title="Please select a user type ...">
                <option value="all">All Users
                </option>
                <option  value="sales">All individual
                </option>
                <option value="recruiters">All brokers
                </option>
                <option value="developers">All developers
                </option>
                <option  value="specific">a specific user
                </option>
        </select>
      </div>
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
      <input type="text" name="value" id="searchField" class="form-control" aria-label="Text input with dropdown button">
      <div class="input-group-append">
        <select
                name="column"
                id="searchColumn"
                class="form-control"
                data-live-search="true"
                title="Please select a lunch ...">
          <option value="_id">ID</option>
          <option value="title">Title</option>
          <option value="createdBy">Created By</option>
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
