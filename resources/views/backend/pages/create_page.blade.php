@extends('layouts.base')

@section('title') @isset($page)Edit Page @else create a page @endisset @endsection
@section('description') {{ \App\Option::ValueByKey('Landing Description') }}@endsection
@section('additional_styles') @endsection
@section('page_actions')

@endsection
@section('content')
    <div class="card">
        <div class="card-header"><h5>You can expand the editor for full screen editing</h5></div>
        <div class="card-body">
            <form data-toggle="validator" novalidate="novalidate" method="post"
                  action="@isset($page){{ route('update_page', $page) }}@else{{ route('store_page') }}@endisset">
                @csrf
                <input type="text" name="created_by" value="{{ Auth::user()->id }}" hidden>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" class="form-control" id="title" oninput="setPageName(this.value)"
                                   name="title" placeholder="Title of page will appear at header and SEO results"
                                   @isset($page)
                                   value="{{ $page->title }}"
                                   @endisset
                                   required aria-required="true">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="control-label">Page Link</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="page-link"
                                   @isset($page)
                                   value="{{ $page->name }}"
                                   @endisset
                                   readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="control-label">Description</label>
                    <textarea id="description" class="form-control" name="description" rows="2">@isset($page) {{ $page->description }} @endisset</textarea>
                    <small class="help-block">Brief description of content for Search Engine Optimization</small>
                </div>
                <div class="form-group">
                    <label for="comment_content" class="control-label">Comment</label>
                    <textarea id="comment_content" class="form-control public-editor" name="content"
                              rows="3" required aria-required="true"> {{ $page->content }} </textarea>
                    <small class="help-block">Type in page content using the editor. Media, Formatting, HTML code
                        allowed.</small>
                </div>
                <div class="form-group">
                    <label for="comment_content" class="control-label">Menus</label>
                    <div class="columns-var" style="--columns:3">
                        @foreach($menus as $menu)
                            <label class="custom-control custom-control-primary custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="menus[]"
                                       value="{{$menu->id}}"
                                       @isset($page)
                                       @if(in_array($menu,$page->menus)) checked @endif
                                    @endisset
                                >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-label">{{ $menu->name }}</span>
                            </label><br>
                        @endforeach
                    </div>
                    <small class="help-block">Select Menu(s) to attach this page on. Optional</small>
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
        function setPageName(input) {
            document.getElementById('name').value = linkText(input);
        }
    </script>
@endsection
