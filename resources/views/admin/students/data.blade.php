@foreach ($data as $key => $v )
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->nis }}</td>
    <td>{{ $v->nisn	}}</td>
    <td>{{ $v->name }}</td>
    <td>{{ $v->class->name }}</td>
    <td>{{ $v->jkl }}</td>
    <td>{{ $v->hobby }}</td>
    <td>
        {!! Helper::btn_action($v->id) !!}
    </td>
</tr>
@endforeach
