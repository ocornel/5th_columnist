@extends('layouts.public_base')

@section('title')
    {{ \App\Option::ValueByKey('Landing Title') }}
@endsection

@section('description')
    {{ \App\Option::ValueByKey('Landing Description') }}
@endsection

@section('content')
    <div class="masthead">
        <div class="masthead-inner">
            <div class="container">
                <div class="row text-left">
                    {{--                    todo format cards to have image background for latest category post and caption of category name--}}
                    @if($last_post = $most_popular_category->last_post)
                        <a href="{{ route('load_category', [$most_popular_category, $most_popular_category->name, $last_post]) }}"
                           class="card-link">
                            <div class="col-md-6 popular_category-card caption-bottom"
                                 style="background-image: url({{$last_post->feature_image_url}})">
                                <div class="caption">
                                    <h4 class="text-uppercase bg-watermark-black">{{ $most_popular_category->name }}</h4>
                                    <p class=" bg-watermark-black">{{ $last_post->title }}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                    <div class="col-md-6">
                        <div class="row">
                            @foreach($categories as $category)
                                @if($loop->iteration < 5)
                                    @if($last_post = $category->last_post)
                                        <a href="{{ route('load_category', [$category, $category->name, $last_post]) }}"
                                           class="card-link">
                                            <div class="col-md-6 category-card caption-bottom"
                                                 style="background-image: url({{$category->last_post->feature_image_url}})">
                                                <div class="caption">
                                                    <h4 class="text-uppercase bg-watermark-black">{{ $category->name }}</h4>
                                                    <p class=" bg-watermark-black">{{ $last_post->title }}</p>

                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endif

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <h2 class="block-title thick-underline">Latest Stories</h2>
                    {{--                    todo format post card--}}
                    @foreach($latest_posts as $post)
                        <div class="row">
                            <a href="{{ route('load_post', [$post, $post->name]) }}" class="card-link">
                                @component('layouts.parts.public_post_card_horizontal', ['post'=>$post, 'character_limit'=>350])@endcomponent
                            </a>
                        </div>
                    @endforeach

                </div>
                <div class="col-md-4  text-left">
                    <h2 class="block-title thick-underline">Trending Stories</h2>
                    @if($most_popular_post != null)
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('load_post', [$most_popular_post, $most_popular_post->name]) }}"
                                   class="card-link">
                                    @component('layouts.parts.public_post_card_vertical', ['post'=>$most_popular_post])@endcomponent
                                </a>
                            </div>

                        </div>
                    @endif

                    {{--                    todo foreach post in trending posts--}}
                    @foreach($trending_posts as $post)
                        <a href="{{ route('load_post', [$post, $post->name]) }}" class="card-link">
                            @component('layouts.parts.public_post_card_horizontal', ['post'=>$post])@endcomponent
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container text-left">
            {{--                    todo foreach category in lagtest 3 posts grouped by category --}}
            @foreach($categories as $category)
                <h2 class="block-title thick-underline">{{ $category->name }}</h2>
                <div class="row category-list-item">
                    @foreach($category->LatestPosts(3) as $post)
                        <div class="col-md-4">
                            <a href="{{ route('load_post', [$post, $post->name]) }}" class="card-link">
                                @component('layouts.parts.public_post_card_vertical', ['post'=>$post])@endcomponent
                            </a>
                        </div>

                        {{--                    <div class=" post-card">{{ $post->title }}</div>--}}
                    @endforeach
                    <div class="col-md-12"><a href="{{ route('load_category', [$category, $category->name]) }}" class="btn btn-info">View more</a></div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
