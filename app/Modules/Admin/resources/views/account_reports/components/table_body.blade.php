@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>
        <span style="color:{{$record->color()}}; font-weight:bold;">
            {{ $record->status }}
        </span>
    </td>
    <td>{{$record->senders()}}</td>
    <td>
        <ul>
            <li><span style="font-weight:bold">ID : </span>{{ $record->sender() ? $record->sender()->id : ""  }}</li>
            <li><span style="font-weight:bold">Name : </span>{{ $record->sender() ? $record->sender()->first_name .' '. $record->sender()->last_name  : ""  }}</li>
            <li><span style="font-weight:bold">Phone : </span>{{ $record->sender() ? $record->sender()->phone : ""  }}</li>
            <li><span style="font-weight:bold">Email : </span>{{ $record->sender() ? $record->sender()->email : ""  }}</li>
        </ul>
    </td>
    <td>{{$record->ReportedUser ? $record->ReportedUser->first_name : ""}}</td>
    <td>
        <span style="font-weight:bold">
            {{$record->reason ? $record->reason->reason : "" }}
        </span>
    </td>
    <td>{{$record->comments ? $record->comments : ""}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        @if($record->status == "Pending")
            <a
                class="btn btn-sm btn-danger"
                title="Dismiss"
                data-toggle="modal"
                style="margin:5px"
                data-target="#confirm-password-modal"
                onclick="injectModalData('{{$record->id}}', '{{route('admins.accountReport.dismiss')}}', 'confirm-password-form', 'POST')"
            >
                <i class="fa fa-times" style="color: #fff"></i>
            </a>
        @endif

    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="Restore"
        data-toggle="modal"
        style="margin:5px"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.accountReport.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="Destroy"
            data-toggle="modal"
            style="margin:5px"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.accountReport.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
        <a
            href="{{route('admins.individual.index').'?view=view&individual='.$record->ReportedUser->id}}"
            title="Show Reported User"
            style="margin:5px"
            class="btn btn-sm btn-primary">
        <i class="fas fa-user-minus" style="color: #fff"></i>
            </a>
            <a
            class="btn btn-sm btn-danger"
            title="Remove"
            style="margin:5px"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.accountReport.trash')}}', 'confirm-password-form', 'POST')" >
            <i class="fa fa-trash" style="color: #fff"></i>
            </a>
    @endif
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
