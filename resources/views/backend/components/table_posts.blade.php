@isset($posts)
    <table class="table table-bordered table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>TITLE</th>
            <th>AUTHOR</th>
            <th>DESCRIPTION</th>
            <th>DATE</th>
            <th>STATUS</th>
            <th class="text-right">VIEWS</th>
            <th class="text-right">RATING</th>
            @isset($actions)
                <th>ACTIONS</th>
            @endisset
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('show_post', [$post, $post->name]) }}">{{ $post->title }}</a></td>
                <td>
                    <a href="{{ route('show_user', [$post->created_by, $post->author->full_name]) }}">{{ $post->author->full_name }}</a>
                </td>
                <td>{{ \Illuminate\Support\Str::limit($post->description, isset($character_limit)?$character_limit:50, $end='...') }}</td>
                <td>{{ \Carbon\Carbon::parse($post->publish_date)->format('d/m/Y') }}</td>
                <td>{{ $post->status }}</td>
                <td class="text-right">{{ number_format($post->view_count) }}</td>
                <td class="text-right"><span title="Current Rating" class="action-cursor text-warning"><i class="fa fa-star"></i> <span
                            id="post_rating">{{$post->rating}}</span>/{{ intval(\App\Option::ValueByKey('Maximum Rating', 100))}}</span>
                </td>
                @isset($actions)
                    <td>
                        <a href="{{ route('load_post', [$post, $post->name]) }}" title="Preview" target="_blank"
                           class="btn-sm btn-primary"><i
                                class="fa fa-eye"></i></a>
                        <a href="{{ route('edit_post', [$post, $post->name]) }}" title="Edit"
                           class="btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('delete_post', [$post]) }}" title="Delete" class="btn-sm btn-danger"><i
                                class="fa fa-trash"></i></a>
                    </td>@endisset
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>Please define $posts</p>
@endif
