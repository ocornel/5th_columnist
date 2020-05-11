@extends('layouts.base')

@section('title') @isset($post)Edit Post @else create a post @endisset @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('post_actions')

@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>You can expand the editor for full screen editing</h5></div>
        <div class="card-body">
            <form data-toggle="validator" novalidate="novalidate" method="post"
                  enctype="multipart/form-data"

            action="@isset($post){{ route('update_post', $post) }}@else{{ route('store_post') }}@endisset">
                @csrf

                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="created_by" value="{{ Auth::user()->id }}" hidden>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="category_id" class="control-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @isset($post) @if($post->category_id == $category->id) selected @endif @endisset>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="title" class="control-label">Title</label>
                                    <input type="text" class="form-control" id="title" oninput="setPostName(this.value)"
                                           name="title" placeholder="Title of post will appear at header and SEO results"
                                           @isset($post)
                                           value="{{ $post->title }}"
                                           @endisset
                                           required aria-required="true">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="control-label">Post Link</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="post-link"
                                           @isset($post)
                                           value="{{ $post->name }}"
                                           @endisset
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" class="form-control" name="description" rows="2">@isset($post) {{ $post->description }} @endisset</textarea>
                            <small class="help-block">Brief description of content for Search Engine Optimization</small>
                        </div>
                        <div class="form-group">
                            <label for="comment_content" class="control-label">Content</label>
                            <textarea id="comment_content" class="form-control public-editor" name="content"
                                      rows="3" required aria-required="true">@isset($post) {{ $post->content }} @endisset</textarea>
                            <small class="help-block">Type in post content using the editor. Media, Formatting, HTML code
                                allowed.</small>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success pull-right">Submit</button>
                        </div>
                    </div>
                    <div class="col-md-3" >
                        <h5 class="thick-underline">Optional</h5>
{{--                        <div class="form-group">--}}
{{--                            <label for="comment_content" class="control-label">Publish On</label>--}}
{{--                            <input type="datetime-local" name="publish_date">--}}
{{--                            <small class="help-block">Date of publication</small>--}}
{{--                        </div>--}}
                        <div class="form-group" data-toggle="match-height">
                            <label for="publish_date" class="control-label">Publish On</label>
                            <div class="input-with-icon">
                                <input class="form-control" type="text" name="publish_date" id="publish_date" data-provide="datepicker" data-date-today-highlight="true" value=" @isset($post){{ \Carbon\Carbon::parse($post->publish_date)->format('m/d/Y') }} @else
{{ \Carbon\Carbon::parse(now())->format('m/d/Y') }} @endisset
                                    ">
                                <span class="icon icon-calendar input-icon"></span>
                            </div>
                        </div>
                        <div class="form-group">
                                    <label class="custom-control custom-control-primary custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="comment_status"
                                               value="{{ \App\Post::COMMENTS_ENABLED }}"
                                               @isset($post)
                                               @if($post->comment_status ==  \App\Post::COMMENTS_ENABLED ) checked @endif
                                            @endisset
                                        >
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-label">Allow comments</span>
                                    </label><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Featured Image (*.png, *.jpg, *.jpeg)</label>
                            <input type="file" accept="image/png, image/jpeg" id="feauture_image_input"
                                   class="form-control" name="image_upload"
                                   value="{{isset($post) ? $post->feature_image_url  : old('image_upload')}}">

                            <img style="max-width: 400px; max-height: 200px" id="feature_image"
                                 src="@if(isset($post)) {{$post->feature_image_url}} @endif"
                            />
                        </div>
                        <div class="form-group">
                            <ul class="file-list"></ul>
                        </div>

                        <div class="form-group">
                            <label for="tags" class="control-label">Tags</label>
                            <input type="text" class="form-control" id="tags"
                                   name="tags"
                                   @isset($post)
                                   value="{{ $post->tags }}"
                                   @endisset>
                            <small class="help-block">Separate multiple with commas</small>
                        </div>
{{--                        TODO password protection for posts--}}
{{--                        TODO post_meta fields--}}
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script>
        function setPostName(input) {
            document.getElementById('name').value = linkText(input);
        }

        $('#feauture_image_input').change(function () {
            var input = this;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#feature_image').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection
