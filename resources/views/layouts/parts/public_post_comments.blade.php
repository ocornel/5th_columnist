@isset($post)
    @foreach($post->approved_comments as $comment)
        <div class="comment-box" id="comment_{{$comment->id}}">
            @if($comment->parent_id)
                <p class="comment-box">Replying to: <a
                        href="#comment_{{$comment->parent_id}}">{{ $comment->parent->author->full_name }}
                        ({{ $comment->parent->created_at }})</a>
                    <br>
                    {!! \Illuminate\Support\Str::limit($comment->parent->content, 100, $end='...') !!}
                </p>
            @endif
            {!! $comment->content !!}
            <br><span class="pull-right"><i> &mdash; {{$comment->author->full_name}}</i></span>
            <p class="comment-actions">
                <span title="Like this" class="action-cursor text-success" onclick="likeComment({{$comment->id}})"><i
                        class="fa fa-thumbs-up"></i> <span
                        id="comment_{{$comment->id}}_likes">{{$comment->likes}}</span></span> &bull; <span></span>
                <span title="Hate this" class="action-cursor text-danger" onclick="hateComment({{$comment->id}})"><i
                        class="fa fa-thumbs-down"></i> <span
                        id="comment_{{$comment->id}}_dislikes">{{ $comment->dislikes }}</span></span>&bull;
                <span></span>
                <span title="Current Rating" class="action-cursor text-warning"><i class="fa fa-star"></i> <span
                        id="comment_{{$comment->id}}_rating">{{$comment->rating}}</span>/{{ intval(\App\Option::ValueByKey('Maximum Rating', 100))}}</span>
                &bull; <span></span>
                <span title="Reply to this" class="action-cursor"
                      onclick="replyComment({{$comment->id}}, '<i><b>{{ $comment->author->full_name }}</b></i>')"                ><i
                        class="fa fa-comment"></i></span>
            </p>
        </div>
    @endforeach
    @if($post->comment_status == \App\Post::COMMENTS_ENABLED)
        @component('layouts.parts.public_comment_form', ['post'=>$post])@endcomponent
    @else
        <p>Comments disabled for this story.</p>
    @endif
@endisset

