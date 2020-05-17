@extends('layouts.base')

@section('title') Roles @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('page_actions')
    <span class="btn btn-primary" onclick="roleForm()">New Role</span>
@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>{{ $tab }} Roles</h5></div>
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                @foreach($roles_by_status as $status => $roles)
                    <li role="presentation" @if(str_replace(' ','_',$tab) == str_replace(' ','_', $status))class="active" @elseif($tab == null && $loop->iteration == 1) class="active" @endif>
                        <a href="#{{ str_replace(' ','_', $status) }}" data-toggle="tab">
                            <i class="fa fa-check"></i> {{ $status }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($roles_by_status as $status => $roles)
                    <div role="tabpanel" class="tab-pane fade in  @if(str_replace(' ','_',$tab) == str_replace(' ','_', $status)) active  @elseif($tab == null && $loop->iteration == 1) active @endif" id="{{ str_replace(' ','_', $status) }}">
                        <div class="row">
                            <div class="col-md-5">
                                @component('backend.components.table_roles', ['roles' => $roles, 'actions'=>true, 'character_limit'=>30])
                                @endcomponent
                            </div>
                            <div class="col-md-7">
{{--                                <p>TOOL AREA</p>--}}
                                <div id="tool_area" style="border: solid var(--5c-faint-grey) 1px; min-height: 300px; padding: 15px">
                                    <p>Click on Role to see users.</p>
                                    <p>Click on New Role button to reveal the form to create roles.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="create_role_form" hidden>
        {{--        <div style="padding: 15px">--}}
        <form data-toggle="validator" novalidate="novalidate" action="{{ route('store_role') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name" class="control-label">Role Name</label>
                <input id="name" class="form-control" style="width: 50%" type="text" name="name" required="" aria-required="true">
            </div>
            <div class="form-group">
                <label for="description" class="control-label">Role Description</label>
                <textarea id="description" class="form-control" name="description" ></textarea>
                <small class="help-block">Briefly describe the role.</small>
            </div>

            <div class="form-group" align="right">
                <button type="submit" class="btn btn-primary ">Save Changes</button>
            </div>
        </form>
        {{--        </div>--}}
    </div>

@endsection

@section('additional_scripts')
    <script>
        var tool_area = document.getElementById('tool_area');
        function roleForm() {
            tool_area.innerHTML = document.getElementById('create_role_form').innerHTML;
        }

        function showRole(role_id) {
            $.get("{{route('template_code')}}",
                {
                    template: 'backend.components.role_users_show',
                    context:{'role_id':role_id},
                },

                function (data, status) {
                    tool_area.innerHTML = data.content;
                },
                'json'
            )
        }

    </script>
@endsection
