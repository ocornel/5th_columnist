@extends('layouts.public_base')

@section('title')
    {{ $page->title }}
@endsection

@section('description')
    {{ $page->description }}
@endsection

@section('content')
    <div class="section height-100">
        <div class="container text-left">
            <h2 class="block-title thick-underline text-capitalize">{{ $page->title }}
                @auth()
                    <span class="pull-right">
                        @if(Auth::user()->actionCan('Create Page'))
                            <a href="{{ route('edit_page', [$page, $page->name]) }}" class="text-warning" title="Edit Page"><i class="fa fa-edit"></i></a>
                            &nbsp;
                            <a href="{{ route('delete_page', [$page]) }}" class="text-danger" title="Trash Page"><i class="fa fa-trash"></i></a>
                        @endif
                    </span>
                @endauth
            </h2>
            {!! $page->content !!}
        </div>
    </div>
    <div class="container meta">
        <small>Views: {{$page->view_count}}, Author: {{ $page->author->full_name }}</small>
    </div>
@endsection
