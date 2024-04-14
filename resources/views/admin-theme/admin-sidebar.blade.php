@php
    $route = Route::current()->getName();
    $prefix = Route::current()->getPrefix();
@endphp

<aside id="sidebar-left" class="sidebar-left">
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class=" {{ ($route == 'admin.dashboard')?'nav-active':'' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>                        
                    </li>

                    <li class="{{ ($route == 'admin.puk') ? 'nav-active' : '' }}">
                        @php
                            $pendingPUK = \App\Models\PUKTransaction::where('status', 'pending')->count();
                        @endphp
                        <a href="{{ route('admin.puk') }}">
                            <i class="fa-solid fa-mobile-retro fa-fw" aria-hidden="true"></i>
                            <span>MTN PUK Retrieval &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingPUK }}</span></span>
                        </a>
                    </li>
                    

                    <li class=" {{ ($route == 'admin.verification')?'nav-active':'' }}">
                        <a href="{{ route('admin.verification') }}">
                            <i class="fa-solid fa-certificate" aria-hidden="true"></i>
                            <span>Verification</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.validation')?'nav-active':'' }}">
                        <a href="{{ route('admin.validation') }}">
                            <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                            <span>Validation </span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.ipe-clearance')?'nav-active':'' }}">
                        <a href="{{ route('admin.ipe-clearance') }}">
                            <i class="fa-solid fa-check-double" aria-hidden="true"></i>
                            <span>IPE Clearance</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.new-enrollment')?'nav-active':'' }}">
                        <a href="{{ route('admin.new-enrollment') }}">
                            <i class="fa-regular fa-folder-open" aria-hidden="true"></i>
                            <span>New Enrollment</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.modification')?'nav-active':'' }}">
                        <a href="{{ route('admin.modification') }}">
                            <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                            <span>Modification</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.personalization')?'nav-active':'' }}">
                        <a href="{{ route('admin.personalization') }}">
                            <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
                            <span>Personalization</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.history')?'nav-active':'' }}">
                        <a href="{{ route('history') }}">
                            <i class="icons icon-list" aria-hidden="true"></i>
                            <span>Transaction History</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'users')?'nav-active':'' }}">
                        <a href="{{ route('profile') }}">
                            <i class="icons icon-user" aria-hidden="true"></i>
                            <span>Users/Agents</span>
                        </a>                        
                    </li>

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