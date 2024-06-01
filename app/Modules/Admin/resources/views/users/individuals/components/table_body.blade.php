@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>
        <span style="font-weight:bold;color:{{$record->getStatusColor()}}">
            {{$record->status}}
        </span>
    </td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->first_name}}</td>
    <td>{{$record->last_name}}</td>
    <td>{{$record->email}}</td>
    <td>{{$record->phone}}</td>
    <td>{{$record->date_of_birth}}</td>
    <td>
        @if(filter_var($record->image, FILTER_VALIDATE_URL))
           <img src="{{ $record->image }}" alt="image-not-uploaded" width="100"></td>
        @else
            <img src="{{asset('storage'.DS().$record->image)}}" alt="image-not-uploaded" width="100"></td>
        @endif 
    </td>
    <td>{{$record->createdBy ? $record->createdBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        <a
            href="{{route('admins.post.index').'?individual='.$record->id}}"
            title="Posts"
            style="margin:5px"
            class="btn btn-sm btn-info">
            <span class="m-menu__link-badge">
                <span class="m-badge m-badge--danger" id="module-posts">
                    {{$record->posts()->count()}}
                </span>
            </span>
            <i class="far fa-file-alt" style="color: #fff"></i>
        </a>
    @if(request()->query('view')=='trash')
         {{-- restore--}}
        <a
        class="btn btn-sm btn-primary"
        title="Restore"
        style="margin:5px"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.individual.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        {{-- Destroy--}}
        <a
            class="btn btn-sm btn-danger"
            title="Destroy"
            style="margin:5px"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.individual.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
        @if($record->status != 'blocked')
        {{-- block--}}
        <a 
            class="btn btn-sm btn-danger" 
            style="margin:5px"
            title="Block" 
            data-toggle="modal" 
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.individual.block')}}', 'confirm-password-form', 'POST')" >
            <i class="fa fa-ban" style="color: #fff"></i>
        </a> 
        @else
        {{-- unblock--}}
        <a 
            class="btn btn-sm btn-success" 
            style="margin:5px"
            title="Unblock" 
            data-toggle="modal" 
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.individual.block')}}', 'confirm-password-form', 'POST')" >
            <i class="fa fa-check" style="color: #fff"></i>
        </a> 
        @endif
        {{-- Reset Password--}}
        <a 
            class="btn btn-sm btn-dark"
            style="margin:5px"
            title="Reset Password"
            data-toggle="modal" 
            data-target="#reset-users-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('admins.individual.reset.password')}}', 'reset-users-password-form', 'POST')"
            >
            <i class="fa fa-key" style="color: #fff"></i>
        </a>
        {{-- Edit--}}
        <a
            href="{{route('admins.individual.edit',$record->id)}}"
            title="Edit"
            style="margin:5px"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
        {{-- Remove--}}
        <a
        class="btn btn-sm btn-danger"
        title="Remove"
        style="margin:5px"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('admins.individual.trash')}}', 'confirm-password-form', 'POST')" >
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
