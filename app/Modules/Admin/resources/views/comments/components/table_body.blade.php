@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif

    <td>{{$record->post_id}}</td>

    @if(!empty($record->individual->first_name))
        <td>{{$record->individual->first_name}}</td>

    @elseif(!empty($record->broker->first_name))
        <td>{{$record->broker->first_name}}</td>
    @else
        <td>{{$record->developer->first_name}}</td>
    @endif

    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="Restore"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.comment.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="Destroy"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.comment.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
        <a
            href="{{route('admins.comment.edit',$record->id)}}"
            title="Edit"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
        <a
            href="{{route('admins.comment.show',$record->id)}}"
            title="Show"
            class="btn btn-sm btn-primary">
        <i class="fa fa-eye" style="color: #fff"></i>
            </a>
{{--        @if($record->id !==1 && $record->id != auth('admin')->user()->id)--}}
            <a
            class="btn btn-sm btn-danger"
            title="Remove"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.comment.trash')}}', 'confirm-password-form', 'POST')" >
            <i class="fa fa-trash" style="color: #fff"></i>
            </a>
{{--        @endif--}}
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
