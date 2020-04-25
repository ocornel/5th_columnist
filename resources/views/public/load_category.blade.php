@extends('layouts.public_base')

@section('title')
    {{ $category->name }}
@endsection

@section('description')
    {{ $category->description }}
@endsection

@section('content')
    <div class="section height-100">
        <div class="container text-left post-container">
            <div class="row">
                <div class="col-md-9">
                    <h2 class="block-title thick-underline">Stories in {{$category->name}}</h2>
                    @isset($post)
                        <div class="row faint-border-bottom">
                            <a href="{{ route('load_post', [$post, $post->name]) }}" class="card-link">
                                @component('layouts.parts.public_post_card_horizontal', ['post'=>$post, 'character_limit'=>1200, 'focus'=>$post->content])@endcomponent
                            </a>
                        </div>
                    @endisset
                    <div class="row">
                        @foreach($category->posts as $post)
                            <div class="col-md-4 faint-border-bottom fix-height-var" style="--h:350px">
                                <a href="{{ route('load_post', [$post, $post->name]) }}"
                                   class="card-link">
                                    @component('layouts.parts.public_post_card_vertical', ['post'=>$post])@endcomponent
                                </a>
                            </div>

                        @endforeach
                    </div>

                </div>
                <div class="col-md-3">
                    <h2 class="block-title thick-underline">Trending</h2>
                    @foreach($trending_posts as $post)
                        <a href="{{ route('load_post', [$post, $post->name]) }}" class="card-link">
                            @component('layouts.parts.public_post_card_horizontal', ['post'=>$post])@endcomponent
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="post-container container meta">
        <span>
            <b class="text-capitalize">Other Categories: </b>
                            @foreach($other_categories as $category)
                <a href="{{ route('load_category', [$category->id, $category->name]) }}" class="badge badge-secondary">{{$category->name}}</a>
            @endforeach
        </span>
    </div>
@endsection
