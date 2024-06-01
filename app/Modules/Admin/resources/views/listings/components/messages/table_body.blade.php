@if(count($record->messages))
@foreach($record->messages as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->senders()}}</td>
    <td>
        <ul>
            <li><span style="font-weight:bold">ID : </span>{{ $record->sender() ? $record->sender()->id : ""  }}</li>
            <li><span style="font-weight:bold">Name : </span>{{ $record->sender() ? $record->sender()->first_name .' '. $record->sender()->last_name  : ""  }}</li>
            <li><span style="font-weight:bold">Phone : </span>{{ $record->sender() ? $record->sender()->phone : ""  }}</li>
            <li><span style="font-weight:bold">Email : </span>{{ $record->sender() ? $record->sender()->email : ""  }}</li>
        </ul>
    </td>
    <td>
        {{$record->title }}
    </td>
    <td>
        {{$record->message }}
    </td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
</tr>
@endforeach
@else
<tr>
    <td colspan="20" style="text-align:center;">
        There are no comments.
    </td>
</tr>
@endif
