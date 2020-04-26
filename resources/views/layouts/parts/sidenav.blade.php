<div class="layout-sidebar">
    <div class="layout-sidebar-backdrop"></div>
    <div class="layout-sidebar-body">
        <div class="custom-scrollbar">
            <nav id="sidenav" class="sidenav-collapse collapse">
                <ul class="sidenav level-1">
                    {{--                    <li class="sidenav-search">--}}
                    {{--                        <form class="sidenav-form" action="http://demo.madebytilde.com/">--}}
                    {{--                            <div class="form-group form-group-sm">--}}
                    {{--                                <div class="input-with-icon">--}}
                    {{--                                    <input class="form-control" type="text" placeholder="Search…">--}}
                    {{--                                    <span class="icon icon-search input-icon"></span>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </form>--}}
                    {{--                    </li>--}}
                    <li class="sidenav-heading">Navigation</li>
                    <li class="sidenav-item has-subnav">
                        <a href="" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-works">&#103;</span>
                            <span class="sidenav-label">Dashboards</span>
                        </a>
                        <ul class="sidenav level-2 collapse">
{{--                            <li class="sidenav-heading">Dashboards</li>--}}
                            <li><a href="{{ route('home') }}">
                                    <span
                                        class="sidenav-badge badge badge-primary">{{ Auth::user()->message_count }}</span>
                                    Default</a></li>
                            @if(Auth::user()->canAction('View Reports'))
                                <li><a href="{{ route('charts') }}">Charts</a></li>
                                <li><a href="{{ route('reports') }}">Reports</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="sidenav-item">
                        <a href="{{ route('pages') }}">
                            <span class="sidenav-icon icon icon-works">&#71;</span>
                            <span class="sidenav-label">Pages</span>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="{{ route('menus') }}">
                            <span class="sidenav-icon icon icon-works">&#71;</span>
                            <span class="sidenav-label">Menus</span>
                        </a>
                    </li>


                    <li class="sidenav-heading">Stories</li>
                    <li class="sidenav-item">
                        <a href="{{ route('categories') }}">
                            <span class="sidenav-icon icon icon-works">&#71;</span>
                            <span class="sidenav-label">Categories</span>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="{{ route('tags') }}">
                            <span class="sidenav-icon icon icon-works">&#71;</span>
                            <span class="sidenav-label">Tags</span>
                        </a>
                    </li>
                    <li class="sidenav-item has-subnav">
                        <a href="" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-works">&#103;</span>
                            <span class="sidenav-label">Posts</span>
                        </a>
                        <ul class="sidenav level-2 collapse">
{{--                            <li class="sidenav-heading">Stories</li>--}}
                            @if(Auth::user()->canAction('Publish Post'))
                                <li><a href="{{ route('posts', \App\Post::STATUS_DRAFT) }}">
                                        <span
                                            class="sidenav-badge badge badge-primary">{{ \App\Post::whereStatus(\App\Post::STATUS_DRAFT)->count() }}</span>
                                        {{ \App\Post::STATUS_DRAFT }}</a></li>
                            @endif
                            <li><a href="{{ route('posts',\App\Post::STATUS_PUBLISHED) }}">{{ \App\Post::STATUS_PUBLISHED }}</a></li>
                            <li><a href="{{ route('posts',\App\Post::STATUS_DELETED) }}">{{ \App\Post::STATUS_DELETED }}</a></li>
                        </ul>
                    </li>

                    <li class="sidenav-item has-subnav">
                        <a href="" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-works">&#103;</span>
                            <span class="sidenav-label">Comments</span>
                        </a>
                        <ul class="sidenav level-2 collapse">
{{--                            <li class="sidenav-heading">Stories</li>--}}
                            @if(Auth::user()->canAction('Publish Comment'))
                                <li><a href="{{ route('comments', \App\Comment::STATUS_DRAFT) }}">
                                        <span
                                            class="sidenav-badge badge badge-primary">{{ \App\Comment::whereStatus(\App\Comment::STATUS_DRAFT)->count() }}</span>
                                        {{ \App\Post::STATUS_DRAFT }}</a></li>
                            @endif
                            <li><a href="{{ route('comments',\App\Comment::STATUS_APPROVED) }}">{{ \App\Comment::STATUS_APPROVED }}</a></li>
                            <li><a href="{{ route('comments',\App\Comment::STATUS_DELETED) }}">{{ \App\Comment::STATUS_DELETED }}</a></li>
                        </ul>
                    </li>

                    <li class="sidenav-heading">Admin Stuff</li>
                    @if(Auth::user()->canAction('Manage Users'))
                        <li class="sidenav-item has-subnav">
                        <a href="" aria-haspopup="true">
                            <span class="sidenav-icon icon icon-works">&#103;</span>
                            <span class="sidenav-label">User Management</span>
                        </a>
                        <ul class="sidenav level-2 collapse">
                            {{--                            <li class="sidenav-heading">Dashboards</li>--}}
                                <li><a href="{{ route('roles') }}">Roles</a></li>
                                <li><a href="{{ route('users') }}">Users</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="sidenav-item">
                        <a href="{{ route('options') }}">
                            <span class="sidenav-icon icon icon-works">&#71;</span>
                            <span class="sidenav-label">Setting Options</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
