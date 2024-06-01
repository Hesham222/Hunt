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
    @if(request()->query('view')=='trash')
    <td>
        <a 
            href="{{route('admins.area.index').'?view=trash&city='.$record->id}}" 
            title="View the trashed areas of this city." 
            >
            <span class="m-menu__link-badge">
                <span class="m-badge m-badge--danger" style="background-color: black;color: #fff;font-weight: bold;padding: 2px 10px;">
                    {{ $record->areasOnlyTrashed->count() }}
                </span>
            </span>
        </a>
    </td>
    @else
    <td>
        <a 
            href="{{route('admins.area.index').'?view=view&city='.$record->id}}" 
            title="View the areas of this city." 
        >
            <span class="m-menu__link-badge">
                <span class="m-badge m-badge--danger" style="background-color: black;color: #fff;font-weight: bold;padding: 2px 10px;">
                    {{ $record->areas->count() }}
                </span>
            </span>
        </a>
    </td>
    @endif
    <td>{{$record->createdBy ? $record->createdBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="Restore"
        data-toggle="modal"
        stlye="margin:5px"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.city.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="Destroy"
            stlye="margin:5px"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.city.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
        <a
            href="{{route('admins.city.edit',$record->id)}}"
            title="Edit"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
            <a
            class="btn btn-sm btn-danger"
            title="Remove"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.city.trash')}}', 'confirm-password-form', 'POST')" >
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
