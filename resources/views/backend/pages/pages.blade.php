@extends('layouts.base')

@section('title') Pages @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('page_actions')
    <a href="{{ route('create_page') }}" class="btn btn-primary">New Page</a>
@endsection
@section('content')
<div class="card">
    <div class="card-header"><h5>Pages created</h5></div>
    <div class="card-body">
        @component('backend.components.table_pages', ['pages'=>$pages, 'actions'=>true])@endcomponent
    </div>
</div>
@endsection
