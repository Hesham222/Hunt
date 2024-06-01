@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->title}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>
        <span style="color:{{$record->status->color()}}; font-weight:bold;">
            {{ $record->status->status }}
        </span>
    </td>
    <td>{{$record->createdUsers()}}</td>
    <td>
        <ul>
            <li><span style="font-weight:bold">ID : </span>{{ $record->user() ? $record->user()->id : ""  }}</li>
            <li><span style="font-weight:bold">Name : </span>{{ $record->user() ? $record->user()->first_name .' '. $record->user()->last_name  : ""  }}</li>
            <li><span style="font-weight:bold">Phone : </span>{{ $record->user() ? $record->user()->phone : ""  }}</li>
            <li><span style="font-weight:bold">Email : </span>{{ $record->user() ? $record->user()->email : ""  }}</li>
        </ul>
    </td>
    <td>
        <span style="font-weight:bold">
            {{$record->reason ? $record->reason->reason : "" }}
        </span>
    </td>
    <td>
        <span style="font-weight:bold">
            {{$record->type->translate('en')->type}}
        </span>
    </td>
    <td>{{$record->city ? $record->city->name : ""}}</td>
    <td>{{$record->getCompound()}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if($record->listing_status_id == 1)
        <a
        class="btn btn-sm btn-success"
        title="Approve"
        data-toggle="modal"
        style="margin:5px"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.listing.toggle.approve', 1)}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-check" style="color: #fff"></i>
        </a>
        <a
        class="btn btn-sm btn-danger"
        title="Decline"
        data-toggle="modal"
        style="margin:5px"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.listing.toggle.approve', 0)}}', 'confirm-password-form', 'POST')"
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
        onclick="injectModalData('{{$record->id}}', '{{route('admins.listing.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="Destroy"
            data-toggle="modal"
            style="margin:5px"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.listing.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
        <a
            href="{{route('admins.listing.edit',$record->id)}}"
            title="Edit"
            style="margin:5px"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
        <a
            href="{{route('admins.listing.show',$record->id)}}"
            title="Show"
            style="margin:5px"
            class="btn btn-sm btn-primary">
        <i class="fa fa-eye" style="color: #fff"></i>
            </a>
            <a
            class="btn btn-sm btn-danger"
            title="Remove"
            style="margin:5px"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.listing.trash')}}', 'confirm-password-form', 'POST')" >
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
