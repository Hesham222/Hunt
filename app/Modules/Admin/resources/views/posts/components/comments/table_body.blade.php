@if(count($record->comments))
@foreach($record->comments as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->createdUsers()}}</td>
    <td>
        <ul>
            <li><span style="font-weight:bold">ID : </span>{{ $record->individual ? $record->individual->id : ""  }}</li>
            <li><span style="font-weight:bold">Name : </span>{{ $record->individual ? $record->individual->first_name .' '. $record->individual->last_name  : ""  }}</li>
            <li><span style="font-weight:bold">Phone : </span>{{ $record->individual ? $record->individual->phone : ""  }}</li>
            <li><span style="font-weight:bold">Email : </span>{{ $record->individual ? $record->individual->email : ""  }}</li>
        </ul>
    </td>
    <td>
        <span style="color:{{$record->status->color()}}; font-weight:bold;">
            {{ $record->status->status }}
        </span>
    </td>
    <td>
        {{$record->completion ? $record->completion->completion : "--" }}
    </td>
    <td>
        {{$record->developer }}
    </td>
    <td>
        {{$record->rooms }}
    </td>
    <td>
        {{$record->size_of_property }}
    </td>
    <td>
        {{$record->payment }}
    </td>
    <td>
        From : {{$record->start_down_payment }}<br>
        To : {{$record->end_down_payment }}
    </td>
    <td>
        From : {{$record->start_monthly_installment }}<br>
        To : {{$record->end_monthly_installment }}
    </td>
    <td>
        From : {{$record->start_payment_duration }}<br>
        To : {{$record->end_payment_duration }}
    </td>
    <td>
        {{$record->delivery_date }}
    </td>
    <td>
        {{$record->description }}
    </td>
    <td>
        @if(filter_var($record->image, FILTER_VALIDATE_URL))
           <img src="{{ $record->image }}" alt="image-not-uploaded" width="100"></td>
        @else
            <img src="{{asset('storage'.DS().$record->image)}}" alt="image-not-uploaded" width="100"></td>
        @endif 
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
