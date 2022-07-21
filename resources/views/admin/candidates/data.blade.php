@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->student->name }}</td>
    <td>{{ $v->student->class->name }}</td>
    <td>{{ $v->vision }}</td>
    <td>{{ $v->mission }}</td>
    <td>{{ $v->image }}</td>
    <td>
        {!! Helper::btn_action($v->id, $title) !!}
    </td>
</tr>
@endforeach