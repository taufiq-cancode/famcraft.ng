@php
    $route = Route::current()->getName();
    $prefix = Route::current()->getPrefix();
@endphp

<aside id="sidebar-left" class="sidebar-left">
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class=" {{ ($route == 'dashboard')?'nav-active':'' }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>                        
                    </li>

                    {{-- <li class=" {{ ($route == 'airtime')?'nav-active':'' }}">
                        <a href="{{ route('airtime') }}">
                            <i class="icons icon-call-out" aria-hidden="true"></i>
                            <span>Airtime Recharge</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'data')?'nav-active':'' }}">
                        <a href="{{ route('data') }}">
                            <i class="icons icon-globe" aria-hidden="true"></i>
                            <span>Data Purchase</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'cable-tv')?'nav-active':'' }}">
                        <a href="{{ route('cable-tv') }}">
                            <i class="icons icon-screen-desktop" aria-hidden="true"></i>
                            <span>Cable TV Subscription</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'airtime-cash')?'nav-active':'' }}">
                        <a href="{{ route('airtime-cash') }}">
                            <i class="fa-solid fa-naira-sign fa-fw" aria-hidden="true"></i>
                            <span>Airtime to Cash</span>
                        </a>                        
                    </li> --}}

                    <li class=" {{ ($route == 'puk')?'nav-active':'' }}">
                        <a href="{{ route('puk') }}">
                            <i class="fa-solid fa-mobile-retro fa-fw" aria-hidden="true"></i>
                            <span>MTN PUK Retrieval</span>
                        </a>                        
                    </li>

                    @if (auth()->user()->role === 'Agent')

                        <li class=" {{ ($route == 'verification')?'nav-active':'' }}">
                            <a href="{{ route('verification') }}">
                                <i class="fa-solid fa-certificate" aria-hidden="true"></i>
                                <span>Verification</span>
                            </a>                        
                        </li>

                        <li class=" {{ ($route == 'validation')?'nav-active':'' }}">
                            <a href="{{ route('validation') }}">
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>Validation</span>
                            </a>                        
                        </li>

                        <li class=" {{ ($route == 'ipe-clearance')?'nav-active':'' }}">
                            <a href="{{ route('ipe-clearance') }}">
                                <i class="fa-solid fa-check-double" aria-hidden="true"></i>
                                <span>IPE Clearance</span>
                            </a>                        
                        </li>

                        <li class=" {{ ($route == 'new-enrollment')?'nav-active':'' }}">
                            <a href="{{ route('new-enrollment') }}">
                                <i class="fa-regular fa-folder-open" aria-hidden="true"></i>
                                <span>New Enrollment</span>
                            </a>                        
                        </li>

                        <li class=" {{ ($route == 'modification')?'nav-active':'' }}">
                            <a href="{{ route('modification') }}">
                                <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                                <span>Modification</span>
                            </a>                        
                        </li>

                        <li class=" {{ ($route == 'personalization')?'nav-active':'' }}">
                            <a href="{{ route('personalization') }}">
                                <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
                                <span>Personalization</span>
                            </a>                        
                        </li>

                    @endif
   
                    {{-- <li class="nav-parent {{ ($prefix == '/nin')?'nav-active':'' }}">
                        <a href="#">
                            <i class='bx bx-id-card' aria-hidden="true"></i>
                            <span>NIN Services</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="{{ route('verification') }}">
                                    Verification
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('validation') }}">
                                    Validation    
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ipe-clearance') }}">
                                    IPE Clearance 
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('new-enrollment') }}">
                                    New Enrollment
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('modification') }}">
                                    Modification
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('personalization') }}">
                                    Personalization
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li class=" {{ ($route == 'tracks')?'nav-active':'' }}">
                        <a href="{{ route('tracks') }}">
                            <i class="icons icon-list" aria-hidden="true"></i>
                            <span>Tracks</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'profile')?'nav-active':'' }}">
                        <a href="{{ route('profile') }}">
                            <i class="icons icon-user" aria-hidden="true"></i>
                            <span>Profile & Wallet</span>
                        </a>                        
                    </li>

                    {{-- <li class=" {{ ($route == 'settings')?'nav-active':'' }}">
                        <a href="layouts-default.html">
                            <i class="icons icon-settings" aria-hidden="true"></i>
                            <span>Settings</span>
                        </a>                        
                    </li> --}}

                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="icons icon-logout" aria-hidden="true"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>                        
                    </li>

                </ul>
            </nav>
        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>

    </div>

</aside>