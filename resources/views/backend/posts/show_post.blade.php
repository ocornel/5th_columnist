@extends('layouts.base')

@section('title') Post Details @endsection
@section('description') {{ $post->title }}@endsection
@section('additional_styles') @endsection
@section('page_actions')
    <a href="{{ route('load_post', [$post, $post->name]) }}" class="btn btn-primary" target="_blank" title="Preview"><i class="fa fa-eye"></i> PREVIEW</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>Showing details about the post.</h5></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5"><b>Post Title:</b> {{ $post->title }}</div>
                <div class="col-md-3"><b>Created by:</b> <a href="{{ route('show_user', $post->created_by) }}">{{ $post->author->full_name }}</a></div>
                <div class="col-md-2"><b>Views:</b> {{ number_format($post->view_count) }}</div>
                <div class="col-md-2"><b>Status:</b> {{ $post->status }}</div>
                <div class="col-md-2"><a href="{{ route('edit_post', [$post, $post->name]) }}" class="pull-right" title="Edit"><i class="fa fa-edit"></i> EDIT POST</a></div>
                <div class="col-md-5"><b>SEO Description:</b> {{ $post->description }}</div>
                <div class="col-md-3"><b>Created:</b> {{ \Carbon\Carbon::parse($post->created_at)->format('D d/M/Y H:i') }}</div>
                <div class="col-md-3"><b>Publish:</b> {{ \Carbon\Carbon::parse($post->publish_date)->format('D d/M/Y H:i') }}</div>
                <div class="col-md-3"><b>Updated/Viewed:</b> {{ \Carbon\Carbon::parse($post->updated_at)->format('D d/M/Y H:i') }}</div>
                <div class="col-md-12">
{{--                    <br>--}}
{{--                    <p style="border-bottom: solid 1px #cccccc"> <b>Menus with the post</b></p>--}}
{{--                    <ul class="columns-var" style="--columns:3">--}}
{{--                        @foreach($post->menus as $menu)--}}
{{--                            <li>{{ $menu->name }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
