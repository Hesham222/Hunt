@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->translate('en')->name}}</td>
    <td>{{$record->translate('ar')->name}}</td>
    <td>{{$record->cityWithTrashed ? $record->cityWithTrashed->name : "NONE"}}</td>
    <td>{{$record->createdBy ? $record->createdBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="Restore"
        style="margin:5px"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.area.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="Destroy"
            style="margin:5px"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.area.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
        <a
            href="{{route('admins.area.edit',$record->id)}}"
            title="Edit"
            stlye="margin:5px"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
        <a
        class="btn btn-sm btn-danger"
        title="Remove"
        stlye="margin:5px"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.area.trash')}}', 'confirm-password-form', 'POST')" >
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
