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
                        <div class="col-md-6 popular_category-card caption-bottom"
                             style="background-image: url({{$last_post->feature_image_url}})">
                            <div class="caption">
                                <h4 class="text-uppercase bg-watermark-black">{{ $most_popular_category->name }}</h4>
                                <p class=" bg-watermark-black">{{ $last_post->title }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="row">
                            @foreach($categories as $category)
                                @if($loop->iteration < 5)
                                    @if($last_post = $category->last_post)
                                        <div class="col-md-6 category-card caption-bottom"
                                             style="background-image: url({{$category->last_post->feature_image_url}})">
                                            <div class="caption">
                                                <h4 class="text-uppercase bg-watermark-black">{{ $category->name }}</h4>
                                                <p class=" bg-watermark-black">{{ $last_post->title }}</p>

                                            </div>
                                        </div>
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
                            <div class="col-md-4">
                                <img class="img-responsive" data-src="{{asset($post->feature_image_url)}}" alt="Post Image"
                                     data-animation-name="fadeInRight" data-animation-delay="03s">
                            </div>
                            <div
                                class="col-md-8">{{ \Illuminate\Support\Str::limit($post->description, 50, $end='...') }}</div>
                        </div>
                    @endforeach

                </div>
                <div class="col-md-4  text-left">
                    <h2 class="block-title thick-underline">Trending Stories</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post-card">
                                <div class="image-bg caption-bottom"
                                     style="background-image: url({{$most_popular_post->feature_image_url}})">
                                    <span class="bg-watermark-black caption">{{ $most_popular_post->title }}</span>
                                </div>
                                <p><b>{{$most_popular_post->author->full_name}}</b> | {{$most_popular_post->category_name}} | <i>{{$most_popular_post->created_at}}</i> </p>
                                <p>{{ \Illuminate\Support\Str::limit($most_popular_post->description, 50, $end='...') }}</p>
                            </div>

                        </div>

                    </div>

                    {{--                    todo foreach post in trending posts--}}
                    @foreach($trending_posts as $post)
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-responsive" data-src="{{$post->feature_image_url}}" alt="Post Image"
                                     data-animation-name="fadeInRight" data-animation-delay="03s">
                            </div>
                            <div
                                class="col-md-8">{{ \Illuminate\Support\Str::limit($post->description, 50, $end='...') }}</div>
                        </div>
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
                                <div class="post-card">
                                    <div class="image-bg caption-bottom"
                                         style="background-image: url({{$post->feature_image_url}})">
                                        <span class="bg-watermark-black caption">{{ $post->title }}</span>
                                    </div>
                                    <p><b>{{$post->author->full_name}}</b> | {{$post->category_name}} | <i>{{$post->created_at}}</i> </p>
                                    <p>{{ \Illuminate\Support\Str::limit($post->description, 50, $end='...') }}</p>
                                </div>
                            </a>
                        </div>

{{--                    <div class=" post-card">{{ $post->title }}</div>--}}
                    @endforeach
                    <div class="col-md-12"><a class="btn btn-info">View more</a></div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
