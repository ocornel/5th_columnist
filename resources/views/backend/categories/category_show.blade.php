@extends('layouts.base')

@section('title') Category Details @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('category_actions')
    <a href="{{ route('load_category', [$category, $category->name]) }}" class="btn btn-primary" target="_blank" title="Preview"><i class="fa fa-eye"></i> PREVIEW</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>Showing details about the category.</h5></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5"><b>Category Title:</b> {{ $category->name }}</div>
                <div class="col-md-3"><b>Status:</b> {{ $category->status }}</div>  <!-- TODO category status toggle function here -->
                <div class="col-md-2"><b>Views:</b> {{ number_format($category->view_count) }}</div>
                <div class="col-md-2"><a href="{{ route('edit_category', [$category, $category->name]) }}" class="pull-right" title="Edit"><i class="fa fa-edit"></i> EDIT CATEGORY</a></div>
                <div class="col-md-5"><b>SEO Description:</b> {{ $category->description }}</div>
                <div class="col-md-3"><b>Created:</b> {{ \Carbon\Carbon::parse($category->created_at)->format('D d/M/Y H:i') }}</div>
                <div class="col-md-3"><b>Updated/Viewed:</b> {{ \Carbon\Carbon::parse($category->updated_at)->format('D d/M/Y H:i') }}</div>
                <div class="col-md-12">
                    <br>
                    <p style="border-bottom: solid 1px #cccccc"> <b>Posts in the category ({{ number_format($category->post_count) }})</b></p>
                    @component('backend.components.table_posts', ['posts'=>$category->posts])@endcomponent
{{--                    <ul class="columns-var" style="--columns:3">--}}
{{--                        @foreach($category->posts as $post)--}}
{{--                            <li>{{ $post->title }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
@endsection
