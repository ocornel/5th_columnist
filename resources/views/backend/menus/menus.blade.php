@extends('layouts.base')

@section('title') Menus @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('page_actions')
    <span class="btn btn-primary" onclick="menuForm()">New Menu</span>

@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>Menus Created</h5></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <table class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th>MENU NAME</th>
                            <th class="text-right">ITEMS COUNT</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr onclick="showMenu({{$menu}}, {{$menu->items}})">
                                <td>{{ $menu->name }}</td>
                                <td class="text-right">{{ number_format($menu->items->count()) }}</td>
                                <td>
                                    <a href="{{ route('edit_menu', [$menu, $menu->name]) }}" title="Edit"
                                       class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('delete_menu', [$menu]) }}" title="Delete" class="btn btn-danger"><i
                                            class="fa fa-trash"></i></a>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-7">
                    <p>TOOL AREA</p>
                    <div id="tool_area" style="border: solid var(--5c-faint-grey) 1px; min-height: 300px; padding: 15px">
                        <p>Click on Menu to show Items here </p>
                        <p>Click New Menu Button to Show Menu Form.</p>
                    </div>
                </div>
            </div>
            {{--            @component('backend.components.table_pages', ['pages'=>$pages, 'actions'=>true])@endcomponent--}}
        </div>
    </div>



    <div id="create_menu_form" hidden>
{{--        <div style="padding: 15px">--}}
            <form data-toggle="validator" novalidate="novalidate" action="{{ route('store_menu') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="control-label">Menu Name</label>
                    <input id="name" class="form-control" style="width: 50%" type="text" name="name" required="" aria-required="true">
                    <small class="help-block">Displayed before listing menu items.</small>
                </div>
                <label class="control-label">Pages to include as menu items</label><br>

                <div class="max-height-var" style="--max-height:50vh; margin-bottom: 10px">
                    <div class="form-group columns-var" style="--columns:3">
                        @foreach($pages as $page)
                            <label class="custom-control custom-control-primary custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="page[]" value="{{$page->id}}">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-label"><a href="{{ route('load_page',[$page, $page->name]) }}" target="_blank">{{ $page->title }}</a></span>
                            </label><br>
                        @endforeach
                    </div>
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
        function menuForm() {
            tool_area.innerHTML = document.getElementById('create_menu_form').innerHTML;
        }

        function showMenu(menu, items) {
            console.log(menu);
            $.get("{{route('template_code')}}",
                {
                    template: 'backend.components.menu_items_show',
                    context:{'menu':menu, 'items':items},
                },

                function (data, status) {
                console.log(data);
                    tool_area.innerHTML = data.content;
                },
                'json'
            )
        }

    </script>
@endsection
