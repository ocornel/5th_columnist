@extends('layouts.public_base')

@section('title')
    {{ $post->title }}
@endsection

@section('description')
    {{ $post->description }}
@endsection

@section('content')
    <div class="section height-100">
        <div class="container text-left post-container">
            <div class="row">
                <div class="col-md-9">
                    <h2 class="block-title thick-underline">{{ $post->title }}
                        @auth()
                            <span class="pull-right">
                                @if(Auth::user()->actionCan('Publish Post'))
                                    @if($post->status == \App\Post::STATUS_DRAFT)
                                        <a href="{{ route('post_toggle', [$post, $post->name]) }}" class="text-success" title="Publish Post"><i class="fa fa-check"></i></a> &nbsp;
                                    @else
                                        <a href="{{ route('post_toggle', [$post, $post->name]) }}" class="text-warning" title="Unpublish Post"><i class="fa fa-window-close"></i></a> &nbsp;
                                    @endif
                                @endif
                                @if(Auth::user()->actionCan('Create Post'))
                                    <a href="" class="text-warning" title="Edit Post"><i class="fa fa-edit"></i></a>
                                    &nbsp;
                                    <a href="" class="text-danger" title="Trash Post"><i class="fa fa-trash"></i></a>
                                @endif

                            </span>
                        @endauth
                    </h2>
                    <div class="meta-card">
                        {{ \Carbon\Carbon::parse($post->publish_date)->format('D d/M/Y')  }}
                        | <b class="text-capitalize">Views:</b> {{$post->view_count}}
                        | <b class="text-capitalize">Author:</b><a href="{{ route('load_author', [$post->created_by, $post->author->full_name]) }}">{{ $post->author->full_name }}</a>
                        | <b class="text-capitalize">Category:</b> <a href="{{ route('load_category', [$post->category_id, $post->category->name, $post]) }}">{{$post->category->name}}</a>
                        @foreach($post->metas as $meta)
                            | <b class="text-capitalize">{{$meta->meta_name}}:</b> {{$meta->meta_value}}
                        @endforeach
                        <span class="pull-right">
                            <b class="text-capitalize">Tags:</b>
                            @foreach($post->tag_list as $tag)
                                <a href="{{ route('load_tag', $tag, $tag->name) }}" class="badge badge-primary">{{ $tag->name }} {{$tag->post_count}}</a>
                                @endforeach
                        </span>
                    </div>
                    {!! $post->content !!}
                    <p class="post-actions">
                        <span title="Like this" class="action-cursor text-success" onclick="likePost({{$post->id}})"><i
                                class="fa fa-thumbs-up"></i> <span id="post_likes">{{$post->likes}}</span></span> &bull;
                        <span></span>
                        <span title="Hate this" class="action-cursor text-danger" onclick="hatePost({{$post->id}})"><i
                                class="fa fa-thumbs-down"></i> <span
                                id="post_dislikes">{{ $post->dislikes }}</span></span>&bull; <span></span>
                        <span title="Current Rating" class="action-cursor text-warning"><i class="fa fa-star"></i> <span
                                id="post_rating">{{$post->rating}}</span>/{{ intval(\App\Option::ValueByKey('Maximum Rating', 100))}}</span>
                    </p>
                    <h3 class="thick-underline text-capitalize">Approved Comments ({{$post->approved_comments->count()}}
                        )</h3>
                    @component('layouts.parts.public_post_comments', ['post'=>$post])@endcomponent
                </div>
                <div class="col-md-3  text-left">
                    <h2 class="block-title thick-underline">Related Stories</h2>
                    @foreach($related_posts as $post)
                        <a href="{{ route('load_post', [$post, $post->name]) }}" class="card-link">
                            @component('layouts.parts.public_post_card_horizontal', ['post'=>$post, 'character_limit'=>60])@endcomponent
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="post-container container meta">
        <small>Views: {{$post->view_count}}, Author: {{ $post->author->full_name }} Admin: <a href="">Edit
                Post</a></small>
    </div>
@endsection
