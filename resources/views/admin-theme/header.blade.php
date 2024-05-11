<header class="header">
    <div class="logo-container">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{ asset('img/logos/logo.png') }}" width="130" alt="FamCraft" />
        </a>

        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>

    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        @if (auth()->user()->role === "Administrator")
            <form action="{{ route('search') }}" class="search nav-form" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                    <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                </div>
            </form>

            <span class="separator"></span>
        @endif
        
        <ul class="notifications">
            @php
                $unreadNotificationsCount = auth()->user()->unreadNotifications()->count();
                $userNotifies = auth()->user()->notifies;
            @endphp

            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-bs-toggle="dropdown">
                    <i class="bx bx-bell"></i>
                    <span class="badge">{{ $unreadNotificationsCount }}</span>
                </a>

                <div class="dropdown-menu notification-menu">
                    <div class="notification-title">
                        <span class="float-end badge badge-default">{{ $unreadNotificationsCount }}</span>
                        Notifications
                    </div>

                    <div class="content">
                        <ul>
                            @foreach($userNotifies as $notify)
                            <li>
                                <a href="{{ route('view.notification',['notificationId' => $notify->id]) }}" class="clearfix">    
                                    <div class="image">
                                        <i class="fas fa-bell bg-success text-light"></i>
                                    </div>
                                    <span class="title">{{ $notify->title }}</span>
                                    <span class="message">{{ $notify->pivot->read_at ? \Carbon\Carbon::parse($notify->created_at)->diffForHumans() : 'Unread' }}</span>
                                </a>
                                <hr>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
        </ul>

        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title(auth()->user()->first_name) }}+{{ Illuminate\Support\Str::title(auth()->user()->last_name) }}&background=1f2937&color=fff" alt="Famcraft" class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                    <span class="name">{{ Illuminate\Support\Str::title(auth()->user()->first_name) }} {{ Illuminate\Support\Str::title(auth()->user()->last_name) }}</span>
                    <span class="role">{{ Illuminate\Support\Str::title(auth()->user()->role) }}</span>
                    
                    @if(auth()->user()->wallet)
                        <span class="balance">&#8358;{{ number_format(auth()->user()->wallet->balance, 2)}}</span>
                    @else
                        <span class="balance">&#8358;0.00</span>
                    @endif                
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="bx bx-user-circle"></i> My Profile</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bx bx-power-off"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>