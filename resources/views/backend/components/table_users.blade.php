@isset($users)
    <table class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>ABOUT</th>
            @isset($actions)
                <th>ACTIONS</th>
            @endisset
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="{{ route('show_user', [$user, $user->full_name]) }}">
                        <img src="{{ $user->ppic }}" alt="" style="height: 15px; width: 15px; border-radius: 50%"> &nbsp;
                        {{ $user->full_name }}</a></td>
                <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
                <td>{{ \Illuminate\Support\Str::limit($user->about, isset($character_limit)?$character_limit:50, $end='...') }}</td>
                @isset($actions)
                    <td>
                        <a href="{{ route('edit_user', [$user, $user->name]) }}" title="Edit" class="btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('delete_user', [$user]) }}" title="Delete" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </td>@endisset
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>Please define $users</p>
@endif
