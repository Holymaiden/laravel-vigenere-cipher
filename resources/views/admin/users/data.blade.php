@foreach ($data as $key => $v )
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->name }}</td>
    <td>{{ $v->username	}}</td>
    <td>{{ $v->email }}</td>
    <td>{{ $v->role->role_name }}</td>
    <td>
        <span class="badge {{ $v->active == 1 ? 'badge-success' : 'badge-danger'}}">
            {{ $v->active == 1 ? 'Yes' : 'No' }}
        </span>
    </td>
    <td>
        {!! Helper::btn_action($v->id) !!}
    </td>
</tr>
@endforeach