<div class="header">
    <div class="header-left">
        <a href="/" class="logo">
            <img src="{{ asset('img/logo_.png') }}" style="margin-top: -8px" width="70" height="70"
                 alt="logo" title="LY The Ground">
        </a>
    </div>
    <div class="page-title-box pull-left">
        <h3>LY The Ground</h3>
    </div>
    @auth
        <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars"
                                                                           aria-hidden="true"></i></a>
    @endauth
    <ul class="nav navbar-nav navbar-right user-menu pull-right">
        <li class="dropdown hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img style="padding-bottom: 3px;"
                     src="{{ asset((app()->isLocale('ar')) ? 'img/flags/ar.png':'img/flags/fr.png') }}"
                     width="20"
                     alt="">
                <span
                    style="padding-left: 8px;">{{(app()->isLocale('ar'))  ? 'AR':'FR'}}</span>
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
                   title="{{ auth()->user()->member->name }}">
                    <span class="user-img">
                        <img class="img-circle" src="{{ asset((auth()->user()->member->info->face) ? 'storage/' . auth()->user()->member->info->face : 'img/user.jpg') }}" width="40"
                             alt="{{ auth()->user()->member->name }}">
                        <span class="status online"></span>
                    </span>
                    <span>{{ auth()->user()->member->name }}</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu">
                    <li class="text-left">
                        <a href="{{ route('member.show',['member' => auth()->user()->member]) }}"
                           class="user-link">
                            <i class="fa fa-user-plus"></i>  <span>{{ __('rh/member.profile') }}</span>
                        </a>
                    </li>
                    <li class="text-left">
                        <a href="{{ route('member.params') }}">
                           <i class="fa fa-database"></i> <span>{{ __('rh/member.params') }}</span>
                        </a>
                    </li>
                    <li class="text-left">
                        <a href="{{ route('member.psw') }}">
                           <i class="fa fa-database"></i> <span>{{ __('validation.attributes.password') }}</span>
                        </a>
                    </li>
                    <li class="text-left">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                           <i class="fa fa-power-off"></i> <span>{{ __('auth/login.logout') }}</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            @else
                <li><a href="{{ route('login') }}">{{ __('auth/login.login') }}</a></li>
                <li><a href="{{ route('register') }}">{{ __('auth/register.register') }}</a></li>
                @endauth
    </ul>
    <div class="dropdown mobile-user-menu pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <ul class="dropdown-menu pull-right">
            @auth
                <li class="text-left">
                    <a href="{{ route('member.show',['member' => auth()->user()->member]) }}" class="user-link">
                        <i class="fa fa-user-plus"></i> <span>{{ __('rh/member.profile') }}</span>
                    </a>
                </li>
                <li class="text-left"><a href="{{ route('member.params') }}"><i class="fa fa-database"></i> {{ __('rh/member.params') }}</a></li>
                <li class="text-left"><a href="{{ route('member.psw') }}"><i class="fa fa-database"></i> {{ __('validation.attributes.password') }}</a></li>
                <li class="text-left">
                    <a href="#">
                        <span class=""><i class="fa fa-bell"></i> {{ __('Notifications') }}</span>

                        @if(isset($count_notifications))
                            <span class="badge bg-primary pull-right">{{ $count_notifications }}</span>
                        @endif</a>
                </li>
                <li class="text-left">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i> <span>{{ __('auth/login.logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @else
                    <li><a href="{{ route('login') }}">{{ __('auth/login.login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ __('auth/register.register') }}</a></li>
                    @endauth
        </ul>
    </div>
</div>
