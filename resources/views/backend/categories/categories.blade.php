@extends('layouts.base')

@section('title') Categories @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('page_actions')
    <a href="{{ route('create_category') }}" class="btn btn-primary text-uppercase"><i class="fa fa-plus"></i> New Category</a>
@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>Categories created</h5></div>
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" @if($tab == \App\Category::STATUS_ACTIVE)class="active" @endif>
                    <a href="#active_categories" data-toggle="tab">
                        <i class="fa fa-check"></i> ACTIVE
                    </a>
                </li>

                <li role="presentation" @if($tab == \App\Category::STATUS_DEACTIVATED)class="active" @endif>
                    <a href="#deactivated_categories" data-toggle="tab">
                        <i class="fa fa-times"></i> DEACTIVATED
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in  @if($tab == \App\Category::STATUS_ACTIVE)active @endif" id="active_categories">
                    @component('backend.components.table_categories', ['categories' => $categories[\App\Category::STATUS_ACTIVE], 'actions'=>true])
                    @endcomponent
                </div>
                <div role="tabpanel" class="tab-pane fade in  @if($tab == \App\Category::STATUS_DEACTIVATED)active @endif" id="deactivated_categories">
                    @component('backend.components.table_categories', ['categories' => $categories[\App\Category::STATUS_DEACTIVATED], 'actions'=>true])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection
