@isset($post)
    @guest
        To Comment: <a class="nav-link"
                       href="{{ route('login', ['next'=>route('load_post',[$post, $post->name])]) }}">{{ __('Login') }}</a>
        @if (Route::has('register'))
            <a class="nav-link"
               href="{{ route('register',['next'=>route('load_post',[$post, $post->name])]) }}">{{ __('Register') }}</a>
        @endif
    @else
        @if($post->status == \App\Post::STATUS_PUBLISHED)
            <p>Commenting as {{ Auth::user()->full_name }} <a href="{{ route('logout') }}"
                                                              onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a></p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>



            <div class="row">
                <div class="col-md-12">
                    <div class="demo-form-wrapper">
                        <form data-toggle="validator" novalidate="novalidate" method="post"
                              action="{{ route('post_comment', $post) }}">
                            @csrf
                            <input type="text" name="post_id" value="{{ $post->id }}" hidden>
                            <input type="text" name="parent_id" id="parent_comment_id" hidden>
                            <div class="form-group">
                                <div class="comment-box">
                                    <div id="target_comment"></div>
                                </div>
                                <label for="comment_content" class="control-label">Comment</label>
                                <textarea id="comment_content" class="form-control public-editor" name="content"
                                          rows="3" required aria-required="true"></textarea>
                                <small class="help-block">Type in your comment</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success pull-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endguest
@endisset
