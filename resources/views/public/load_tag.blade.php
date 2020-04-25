@extends('layouts.public_base')

@section('title')
    {{ $tag->name }}
@endsection

@section('description')
@endsection

@section('content')
    <div class="section height-100">
        <div class="container text-left post-container">
            <div class="row">

            </div>
        </div>
    </div>
    <div class="post-container container meta">
        <small>Other Tags:</small>
    </div>
@endsection
