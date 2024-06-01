@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->accountType}}</td>
    <td>
        <div style="background:{{$record->colour}};width:50px;height:50px;color:#fff"></div>
    </td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        <a
            href="{{route('admins.profile_colour.edit',$record->id)}}"
            title="Edit"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="20" style="text-align:center;">
        There are no records match your inputs.
    </td>
</tr>
@endif
