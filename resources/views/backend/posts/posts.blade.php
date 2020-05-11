@extends('layouts.base')

@section('title') Posts @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('page_actions')
    <a href="{{ route('create_post') }}" class="btn btn-primary text-uppercase"><i class="fa fa-plus"></i> New Post</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>{{ $status }} Posts</h5></div>
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                @foreach($posts_by_category as $category => $posts)
                <li role="presentation" @if(str_replace(' ','_',$tab) == str_replace(' ','_', $category))class="active" @elseif($tab == null && $loop->iteration == 1) class="active" @endif>
                    <a href="#{{ str_replace(' ','_', $category) }}" data-toggle="tab">
                        <i class="fa fa-check"></i> {{ $category }}
                    </a>
                </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($posts_by_category as $category => $posts)
                <div role="tabpanel" class="tab-pane fade in  @if(str_replace(' ','_',$tab) == str_replace(' ','_', $category)) active  @elseif($tab == null && $loop->iteration == 1) active @endif" id="{{ str_replace(' ','_', $category) }}">
                    @component('backend.components.table_posts', ['posts' => $posts, 'actions'=>true, 'character_limit'=>30])
                    @endcomponent
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
