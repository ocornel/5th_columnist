@extends('layouts.base')

@section('title') {{ Auth::user()->role_name }}'s Portal @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('page_actions')
    <a href="{{ route('prepare_dummy') }}" class="btn btn-primary">Prepare Dummy Data</a>
    <a href="{{ route('delete_dummy') }}" class="btn btn-danger">Clear Data</a>
@endsection
@section('content')

@endsection
