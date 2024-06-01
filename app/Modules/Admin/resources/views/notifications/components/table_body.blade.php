@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->title}}</td>
    <td>{{$record->message}}</td>
    <td>{{$record->getRecipientsType()}}</td>
    <td>{{$record->createdBy ? $record->createdBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        <a
            class="btn btn-sm btn-danger"
            title="unsend"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.notification.unsend')}}', 'confirm-password-form', 'POST')"
        >
            <i class="fa fa-times" style="color: #fff"></i>
        </a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7" style="text-align:center;">
        There are no records match your inputs.
    </td>
</tr>
@endif
