<div class="header">
    <div class="header-left">
        <a href="/" class="logo">
            <img src="{{ asset('img/logo_.png') }}" width="70" height="70" alt="">
        </a>
    </div>
    <div class="page-title-box pull-left">
        <h3>theGround</h3>
    </div>
    @auth
        <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars"
                                                                           aria-hidden="true"></i></a>
    @endauth
    <ul class="nav navbar-nav navbar-right user-menu pull-right">
        <li class="dropdown hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img style="padding-bottom: 3px;"
                     src="{{ asset((\Illuminate\Support\Facades\App::isLocale('ar')) ? 'img/flags/ar.png':'img/flags/fr.png') }}"
                     width="20"
                     alt="">
                <span
                    style="padding-left: 8px;">{{(\Illuminate\Support\Facades\App::isLocale('ar')) ? 'AR':'FR'}}</span>
                <i class="caret"></i>
            </a>
            <ul class="dropdown-menu" id="lang-switcher">
                @if((\Illuminate\Support\Facades\App::isLocale('ar')))
                    <li><a href="#" data-lang="fr">FR</a></li>
                @else
                    <li><a href="#" data-lang="ar">AR</a></li>
                @endif
            </ul>
        </li>
        <form id="language" method="POST"
              style="display: none;">
            {{ csrf_field() }}
        </form>
        @auth
            <li class="dropdown">
                <a href="#" id="notifications_panel" data-t="{{ route('notification.read') }}" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i>
                    @if(isset($count_notifications))
                        <span class="badge bg-primary pull-right" id="badge_notif">{{ $count_notifications }}</span>
                    @endif
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span>{{ __('notification.unread') }}</span>
                    </div>
                    <div class="drop-scroll">
                        <ul class="media-list">
                            @foreach(auth()->user()->unreadNotifications  as $notification)
                                <li class="media notification-message">
                                    <a href="{{ $notification->data['route'] }}">
                                        <div class="media-left">
                                            <span class="avatar">
                                                @if(isset($notification->data['img']))
                                                    <img alt="{{ $notification->data['name'] }}"
                                                         src="{{ asset('storage/' . $notification->data['img']) }}"
                                                         class="img-responsive img-circle">
                                                @else
                                                    <span>{{ substr($notification->data['name'],0,1) }}</span>
                                                @endif

											</span>
                                        </div>
                                        <div class="media-body">
                                            <p class="noti-details text-warning">
                                                <span class="noti-title">{{ $notification->data['name'] }}</span>
                                                <span class="">{{ __($notification->data['request']) }}</span>
                                                <span class="noti-title">{{ __($notification->data['action']) }}</span>
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time">
                                                     {{ __('diver.le') . ' : ' . \Carbon\Carbon::parse($notification->created_at)->format('d/m/y' . __("diver.a") .' H:i:s') }}
                                                </span>
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="{{ route('notification.index') }}">{{ __('notification.view_all') }}</a>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle user-link" data-toggle="dropdown"
                   title="{{ auth()->user()->login }}">
                    <span class="user-img">
                        <img class="img-circle" src="{{ asset('img/user.jpg') }}" width="40"
                             alt="{{ auth()->user()->login }}">
                        <span class="status online"></span>
                    </span>
                    <span>{{ auth()->user()->login }}</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu">
                    <li class="text-left">
                        <a href="{{ route('admin.show',['admin' => auth()->user()->admin]) }}"
                           class="user-link">
                            <span class="user-img m-r-15">
                                <img class="img-circle" src="{{ asset('img/user.jpg') }}" width="40"
                                     alt="{{ auth()->user()->login }}">
                                <span class="status online"></span>
                            </span>
                            <span>{{ auth()->user()->login }}</span>
                        </a>
                    </li>
                    <li class="text-center"><a href="{{ route('admin.params') }}">{{ __('admin/admin.params') }}</a></li>
                    <li class="text-center">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('auth/login.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            @else
                <li><a href="{{ route('login') }}">{{ __('pages.auth.login.login') }}</a></li>
                @endauth
    </ul>
    <div class="dropdown mobile-user-menu pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <ul class="dropdown-menu pull-right">
            @auth
                <li class="text-left">
                    <a href="{{ route('admin.show',['admin' => auth()->user()->admin]) }}" class="user-link">
                            <span class="user-img m-r-15">
                                <img class="img-circle"
                                     src="{{ asset('img/user.jpg') }}"
                                     width="40"
                                     alt="{{ auth()->user()->login }}">
                                <span class="status online"></span>
                            </span>
                        <span>{{ auth()->user()->login }}</span>
                    </a>
                </li>
                <li class="text-left"><a href="{{ route('admin.params') }}">{{ __('admin/admin.params') }}</a></li>
                <li class="text-left">
                    <a href="{{ route('notification.index') }}">
                            <span class="">{{ __('Notifications') }}</span>

                            @if(isset($count_notifications))
                                <span class="badge bg-primary pull-right">{{ $count_notifications }}</span>
                            @endif</a>
                </li>
                <li class="text-left">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('auth/login.logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @else
                    <li><a href="{{ route('login') }}">{{ __('auth/login.login') }}</a></li>
                    @endauth
        </ul>
    </div>
</div>
