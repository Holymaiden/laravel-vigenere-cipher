@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->student->name }}</td>
    <td>{{ $v->student->class->name }}</td>
    <td>{{ $v->vision }}</td>
    <td>{{ $v->mission }}</td>
    <td><img class="mr-3 rounded" width="55" src="{{ url('public/uploads/candidates') }}/{{$v->image}}" alt="{{ $v->student->name }}"></td>
    <td>
        {!! Helper::btn_action($v->id, $title) !!}
    </td>
</tr>
@endforeach