<label>The specific user(s) :</label>
<select required=""
        name="selected_specific_users"
        class="form-control m-input m-input--square selectpicker"
        data-live-search="true"
        id="aspecificUserSelect">
    <option value="">--Select the user--</option>
    @foreach($users as $user)
        <option value="{{ $user->id }}">{{ $user->first_name .' '. $user->last_name .' - '. $user->phone }} </option>
    @endforeach
</select>