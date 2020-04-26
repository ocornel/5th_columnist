
@guest
    No User Logged In
@else
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand navbar-brand-center" href="{{route('home')}}">
                <img class="navbar-brand-logo" src="{{ asset('img/logo.jpeg')}}" alt="Logo">
            </a>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse"
                    data-target="#sidenav">
                <span class="sr-only">Toggle navigation</span>
                <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
                <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
            </button>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse"
                    data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="arrow-up"></span>
                <span class="ellipsis ellipsis-vertical">
              <img class="ellipsis-object" width="32" height="32" data-src="{{Auth::user()->ppic}}" alt="Pic"> <!-- todo get user ppic and name -->
            </span>
            </button>
        </div>
        <div class="navbar-toggleable">
            <nav id="navbar" class="navbar-collapse collapse">
                <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true"
                        type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
                </button>
                <ul class="nav navbar-nav navbar-right">
                    <li class="visible-xs-block">
                        <h4 class="navbar-text text-center">Hi, {{Auth::user()->full_name}}</h4>
                    </li>
                    <li class="hidden-xs hidden-sm">
                        <form class="navbar-search navbar-search-collapsed">
                            <div class="navbar-search-group">
                                <input class="navbar-search-input" name="search_text" id="search_text" type="text"
                                       onchange="systemSearch(this.value)"
                                       placeholder="Search for drivers, customers, vehicles and towns&hellip;">
                                <button class="navbar-search-toggler" title="Expand search form ( S )"
                                        aria-expanded="false">
                                    <span class="icon icon-search icon-lg"></span>
                                </button>
                                <button class="navbar-search-adv-btn" type="button"
                                        onclick="systemSearch(document.getElementById('search_text').value)">Find
                                </button>
                            </div>
                        </form>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="base.blade.php#" role="button" data-toggle="dropdown"
                           aria-haspopup="true">
                  <span class="icon-with-child hidden-xs">
                    <span class="icon icon-bell-o icon-lg"></span>
                    <span
                        class="badge badge-danger badge-above right">
{{--                        {{Auth::user()->unread_notifications->count()}}--}}
                    </span>
                  </span>
                            <span class="visible-xs-block">
                    <span class="icon icon-bell icon-lg icon-fw"></span>
                    <span class="badge badge-danger pull-right">
{{--                        {{Auth::user()->unread_notifications->count()}}--}}
                    </span>
                    Notifications
                  </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                            <div class="dropdown-header">
                                <a class="dropdown-link" href="base.blade.php#">Mark all as read</a>
                                <h5 class="dropdown-heading">Recent Notifications</h5>
                            </div>
                            <div hidden>
{{--                                {{ $notifications = \App\Notification::where('user_id', Auth::user()->id)->get()}}--}}
                            </div>
                            <div class="dropdown-body">
                                <div class="list-group list-group-divided custom-scrollbar">
{{--                                    @foreach($notifications as $notification)--}}
                                        <a class="list-group-item"
{{--                                           href="{{route('show_notification', $notification)}}"--}}
                                        >
                                            <div class="notification">
                                                <div class="notification-media">
                                                    <span class="icon icon-info bg-info rounded sq-40"></span>
                                                </div>
                                                <div class="notification-content">
                                                    <small
                                                        class="notification-timestamp">
{{--                                                        {{\Carbon\Carbon::parse($notification->created_at)->diffForHumans(\Carbon\Carbon::now())}}--}}
                                                    </small>
                                                    <h5 class="notification-heading">
{{--                                                        {{$notification->title}}--}}
                                                    </h5>
                                                    <p class="notification-text">
                                                        <small class="truncate">
{{--                                                            {{$notification->message}}--}}
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
{{--                                    @endforeach--}}
                                </div>
                            </div>
                            <div class="dropdown-footer">
                                <a class="dropdown-btn"
{{--                                   href="{{route('user_notifications')}}"--}}
                                >See All</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown hidden-xs">
                        <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                            <img class="rounded" width="36" height="36" data-src="{{Auth::user()->ppic}}" alt="Pic"> {{Auth::user()->full_name}}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="divider"></li>
                            <li><a
{{--                                    href="{{ route('profile') }}"--}}
                                >Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a></li>

                        </ul>
                    </li>

                    <li class="visible-xs-block">
                        <a href="">
                            <span class="icon icon-user icon-lg icon-fw"></span>
                            Profile
                        </a>
                    </li>
                    <li class="visible-xs-block">
                        <a href="">
                            <span class="icon icon-power-off icon-lg icon-fw"></span>
                            Sign out
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endguest
