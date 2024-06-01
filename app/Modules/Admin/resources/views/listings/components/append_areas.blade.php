<label>ِArea:</label>
<select name="area_id" required=""
        class="form-control m-input m-input--square"
        id="exampleSelect1">
    @if(isset($record['area_id']))
        @if (!empty($areas))
            @foreach ($areas as $area )
                <option value="{{ $area['id'] }}"
                        @if (!empty($record['area_id']) && $record['area_id']== $area->id )
                        selected =""
                    @endif
                >{{ $area['name'] }}</option>
            @endforeach
        @endif
    @else
        <option value="0">Select Area </option>
    @endif
    @if (!empty($areas))
        @foreach ($areas as $area )
            <option value="{{ $area['id'] }}"
                    @if (isset($record['area_id']) && $record['area_id']== $area->id )
                    selected =""
                @endif
            >{{ $area['name'] }}</option>
        @endforeach
    @endif
</select>
@error('area_id')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
