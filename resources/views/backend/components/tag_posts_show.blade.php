@section('content')
    <span hidden>
        {{ $tag = \App\Tag::find($tag_id) }}
    </span>
    <h4>{{$tag->name}} (posts)</h4>
    <div class="max-height-var" style="--max-height:70vh">

    <ul class="columns-var" style="--columns:2">
        @foreach($tag->posts as $post)
            <li><a href="{{route('load_post', $post->id)}}" target="_blank">{{ $post->title }}</a></li>
        @endforeach
    </ul>
    </div>
@endsection
