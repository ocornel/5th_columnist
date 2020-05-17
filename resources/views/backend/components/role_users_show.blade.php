@section('content')

    <span hidden>
        {{ $role = \App\Role::find($role_id) }}
    </span>
    <h4>{{$role->name}}s</h4>
    <div class="max-height-var" style="--max-height:70vh">

        @component('backend.components.table_users', ['users'=>$role->users, 'character_limit'=>20])@endcomponent
    </div>
@endsection
