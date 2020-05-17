@isset($comments)
    <table class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>POST TITLE</th>
            <th>COMMENT AUTHOR</th>
            <th>DATE</th>
            <th class="text-right">RATING</th>
            @isset($actions)
                <th>ACTIONS</th>
            @endisset
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <span hidden>{{ $post = $comment->post }}</span>
            <tr>
                <td><a href="{{ route('show_post', [$post, $post->name]) }}">{{ $post->title }}</a></td>
                <td>
                    <a href="{{ route('show_user', [$comment->created_by, $comment->author->full_name]) }}">{{ $comment->author->full_name }}</a>
                </td>
                {{--                <td>{{ \Illuminate\Support\Str::limit($comment->description, isset($character_limit)?$character_limit:50, $end='...') }}</td>--}}
                <td>{{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y') }}</td>
                {{--                <td class="text-right">{{ number_format($comment->view_count) }}</td>--}}
                <td class="text-right"><span title="Current Rating" class="action-cursor text-warning"><i
                            class="fa fa-star"></i> <span
                            id="comment_rating">{{$comment->rating}}</span>/{{ intval(\App\Option::ValueByKey('Maximum Rating', 100))}}</span>
                </td>
                @isset($actions)
                    <td>
                        <span onclick="showComment('{!! $comment->content !!}')" class="btn-sm btn-primary"><i
                                class="fa fa-eye"></i></span>
                        @if($comment->status == \App\Comment::STATUS_DRAFT)
                            <a href="{{ route('approve_comment', [$comment, $comment->name]) }}" title="Approve"
                                class="btn-sm btn-success"><i class="fa fa-check"></i></a>
                            <a href="{{ route('decline_comment', [$comment]) }}" title="Decline"
                               class="btn-sm btn-warning"><i
                                    class="fa fa-times"></i></a>
                        @else
                            <a href="{{ route('delete_comment', [$comment]) }}" title="Delete Permanently"
                               class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        @endif
                    </td>@endisset
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>Please define $comments</p>
@endif
