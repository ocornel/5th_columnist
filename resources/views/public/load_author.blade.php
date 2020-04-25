@extends('layouts.public_base')

@section('title')
    {{ $author->full_name }}
@endsection

@section('description')
    {{ \App\Option::ValueByKey('Landing Description')  }}
@endsection

@section('content')
    <div class="section height-100">
        <div class="container text-left post-container">
            <div class="row">
                <div class="col-md-9">
                    <h2 class="block-title thick-underline">Stories by {{$author->full_name}}</h2>
                    <br>
                    <div class="row faint-border-bottom">
                        <div class="row faint-border-bottom">
                            <div class="col-md-4">
                                <img class="img-responsive" data-src="{{$author->ppic}}" alt="Profile Pic"
                                     data-animation-name="fadeInRight" data-animation-delay="03s">
                            </div>
                            <div class="col-md-8 ">
                                <div class="fix-height-var" style="--h: 245px;">
                                    <b>About:</b><br>
                                    {!!  \Illuminate\Support\Str::limit($author->about,1000, $end='...')  !!}
                                </div>
                                <div class="">
                                    <br><b class="text-capitalize">Web link:</b> <a href="{{$author->web_link}}" target="_blank">{{$author->web_link}}</a>
                                    @foreach($author->metas as $meta)
                                        | <b class="text-capitalize">{{$meta->meta_name}}:</b> {{$meta->meta_value}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach($author->posts as $post)
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
            <b class="text-capitalize">Other published authors: </b>
                            @foreach($other_authors as $author)
                <a href="{{ route('load_author', [$author->id, $author->name]) }}" class="badge badge-secondary">{{$author->name}}</a>
            @endforeach
        </span>
    </div>
@endsection
