@extends('layouts.base')

@section('title') Page Details @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('page_actions')
    <a href="{{ route('load_page', [$page, $page->name]) }}" class="btn btn-primary" target="_blank" title="Preview"><i class="fa fa-eye"></i> PREVIEW</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>Showing details about the page.</h5></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5"><b>Page Title:</b> {{ $page->title }}</div>
                <div class="col-md-3"><b>Created by:</b> <a href="{{ route('show_user', $page->created_by) }}">{{ $page->author->full_name }}</a></div>
                <div class="col-md-2"><b>Views:</b> {{ number_format($page->view_count) }}</div>
                <div class="col-md-2"><a href="{{ route('edit_page', [$page, $page->name]) }}" class="pull-right" title="Edit"><i class="fa fa-edit"></i> EDIT PAGE</a></div>
                <div class="col-md-5"><b>SEO Description:</b> {{ $page->description }}</div>
                <div class="col-md-3"><b>Created:</b> {{ \Carbon\Carbon::parse($page->created_at)->format('D d/M/Y H:i') }}</div>
                <div class="col-md-3"><b>Updated/Viewed:</b> {{ \Carbon\Carbon::parse($page->updated_at)->format('D d/M/Y H:i') }}</div>
                <div class="col-md-12">
                    <br>
                    <p style="border-bottom: solid 1px #cccccc"> <b>Menus with the page</b></p>
                    <ul class="columns-var" style="--columns:3">
                        @foreach($page->menus as $menu)
                            <li>{{ $menu->name }}</li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
