@foreach ($data as $key => $v )
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->student->name }}</td>
    <td>{{ $v->candidate }}</td>
    <td>{{ $v->hope }}</td>
</tr>
@endforeach