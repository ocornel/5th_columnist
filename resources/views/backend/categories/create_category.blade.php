@extends('layouts.base')

@section('title') @isset($category)Edit Category @else create a category @endisset @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('category_actions')

@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>Creating a category</h5></div>
        <div class="card-body">
            <form data-toggle="validator" novalidate="novalidate" method="post"
                  action="@isset($category){{ route('update_category', $category) }}@else{{ route('store_category') }}@endisset">
                @csrf
                {{--                <input type="text" name="created_by" value="{{ Auth::user()->id }}" hidden>--}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control" id="name"  oninput="labelPosts(this.value)"
                                   name="name" placeholder="The name of the category"
                                   @isset($category)
                                   value="{{ $category->name }}"
                                   @endisset
                                   required aria-required="true">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""> -- Select status --</option>
                                @foreach(\App\Category::STATUSES as $status => $label)
                                    <option value="{{ $status }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    <textarea id="description" class="form-control" name="description" rows="2">@isset($category) {{ $category->description }} @endisset</textarea>
                    <small class="help-block">Brief description of content for Search Engine Optimization</small>
                </div>
                <div class="form-group">
                    <label for="comment_content" class="control-label">Uncategorised Posts to map to this category</label>
                    <div class="columns-var" style="--columns:3">
                        @foreach($posts as $post)
                            <label class="custom-control custom-control-primary custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="posts[]"
                                       value="{{$post->id}}"
                                       @isset($category)
                                       @if(in_array($post,$category->posts_array)) checked @endif
                                    @endisset
                                >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-label">{{ $post->title }}</span>
                            </label><br>
                        @endforeach
                    </div>
                    <small class="help-block">Select Posts(s) to categorise as <span id="cat_name"></span>. Optional</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success pull-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <script>
        function labelPosts(input) {
            document.getElementById('cat_name').innerText = input;
        }
    </script>
@endsection
