@extends('layouts.base')

@section('title') Comments @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('page_actions')
{{--    <a href="{{ route('create_comment') }}" class="btn btn-primary text-uppercase"><i class="fa fa-plus"></i> New Comment</a>--}}
@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>{{ $tab }} Comments</h5></div>
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                @foreach($comments_by_status as $status => $comments)
                    <li role="presentation" @if(str_replace(' ','_',$tab) == str_replace(' ','_', $status))class="active" @elseif($tab == null && $loop->iteration == 1) class="active" @endif>
                        <a href="#{{ str_replace(' ','_', $status) }}" data-toggle="tab">
                            <i class="fa fa-check"></i> {{ $status }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($comments_by_status as $status => $comments)
                    <div role="tabpanel" class="tab-pane fade in  @if(str_replace(' ','_',$tab) == str_replace(' ','_', $status)) active  @elseif($tab == null && $loop->iteration == 1) active @endif" id="{{ str_replace(' ','_', $status) }}">
                        <div class="row">
                            <div class="col-md-9">
                                @component('backend.components.table_comments', ['comments' => $comments, 'actions'=>true, 'character_limit'=>30])
                                @endcomponent
                            </div>
                            <div class="col-md-3">
                                <p>TOOL AREA</p>
                                <div id="tool_area" style="border: solid var(--5c-faint-grey) 1px; min-height: 300px; padding: 15px">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script>
        var tool_area = document.getElementById('tool_area');
        tool_area.innerHTML = data.content;
        function showComment(content) {
            tool_area.innerHTML = content;
        }

    </script>
@endsection
