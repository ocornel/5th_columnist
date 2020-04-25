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
            <h2 class="block-title thick-underline text-capitalize">{{ $page->title }}</h2>
            {!! $page->content !!}
        </div>
    </div>
    <div class="container meta">
        <small>Views: {{$page->view_count}}, Author: {{ $page->author->full_name }} Admin: <a href="">Edit Page</a></small>
    </div>
@endsection
