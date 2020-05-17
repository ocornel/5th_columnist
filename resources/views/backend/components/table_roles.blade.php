@isset($roles)
    <table class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>ROLE NAME</th>
            <th>DESCRIPTION</th>
            <th>STATUS</th>
            @isset($actions)
                <th>ACTIONS</th>
            @endisset
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr onclick="showRole({{$role->id}})">
                <td><a href="{{ route('show_role', [$role, $role->name]) }}">{{ $role->name }}</a></td>
                <td>{{ \Illuminate\Support\Str::limit($role->description, isset($character_limit)?$character_limit:50, $end='...') }}</td>
                <td>{{ $role->status }}</td>
                @isset($actions)
                    <td>

                        @if($role->status == \App\Role::STATUS_ACTIVE)
                            <a href="{{ route('deactivate_role', [$role, $role->name]) }}" title="Deactivate"
                                class="btn-sm btn-warning"><i class="fa fa-times"></i></a>
                        @elseif($role->status == \App\Role::STATUS_DEACTIVATED)
                            <a href="{{ route('activate_role', [$role, $role->name]) }}" title="Activate"
                               class="btn-sm btn-success"><i class="fa fa-check"></i></a>
                        @endif
                            <a href="{{ route('edit_role', [$role, $role->name]) }}" title="Edit Role"
                                 class="btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="{{ route('delete_role', [$role]) }}" title="Delete Permanently"
                                 class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </td>@endisset
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>Please define $roles</p>
@endif
