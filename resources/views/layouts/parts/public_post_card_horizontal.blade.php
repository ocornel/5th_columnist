@if(isset($post))
    <div class="row faint-border-bottom">
        <div class="col-md-4">
            <img class="img-responsive" data-src="{{$post->feature_image_url}}" alt="Post Image"
                 data-animation-name="fadeInRight" data-animation-delay="03s">
        </div>
        <div
            class="col-md-8">{!!  \Illuminate\Support\Str::limit(isset($focus)?$focus:$post->description, isset($character_limit)?$character_limit:50, $end='...')  !!}</div>
    </div>
@endif
