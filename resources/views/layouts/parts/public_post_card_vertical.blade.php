@if(isset($post))
    <div class="post-card">
        <div class="image-bg caption-bottom"
             style="background-image: url({{$post->feature_image_url}})">
            <span class="bg-watermark-black caption">{{ $post->title }}</span>
        </div>
        <p><b>{{$post->author->full_name}}</b> | {{$post->category_name}} | <i>{{\Carbon\Carbon::parse($post->publish_date)->format('D d/M/Y') }}</i> </p>
        <p>{{ \Illuminate\Support\Str::limit($post->description,  isset($character_limit)?$character_limit:50, $end='...') }}</p>
    </div>
@endif
