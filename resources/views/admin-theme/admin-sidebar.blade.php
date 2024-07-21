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

                    <li class="{{ ($route == 'admin.puk' || $route == 'view.puk') ? 'nav-active' : '' }}">
                        @php
                            $pendingPUK = \App\Models\PUKTransaction::where('status', 'pending')->count();
                        @endphp
                        <a href="{{ route('admin.puk') }}">
                            <i class="fa-solid fa-mobile-retro fa-fw" aria-hidden="true"></i>
                            <span>MTN PUK Retrieval &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingPUK }}</span></span>
                        </a>
                    </li>
                    

                    <li class="">
                        @php
                            $pendingVerification = \App\Models\VerificationTransaction::where('status', 'pending')->where('verification_type', 'v1')->count();
                        @endphp
                        <a href="{{ route('admin.verification') }}">
                            <i class="fa-solid fa-certificate" aria-hidden="true"></i>
                            <span>Verification &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingVerification }}</span></span>
                        </a>                        
                    </li>

                    <li class="">
                        @php
                            $pendingVerificationV2 = \App\Models\VerificationTransaction::where('status', 'pending')->where('verification_type', 'v2')->count();
                        @endphp
                        <a href="{{ route('admin.verificationV2') }}">
                            <i class="fa-solid fa-certificate" aria-hidden="true"></i>
                            <span>Verification V2 &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingVerificationV2 }}</span></span>
                        </a>                        
                    </li>

                    <li class=" {{ ($prefix == 'nin/validation' || $route == 'admin.validation' )?'nav-active':'' }}">
                        @php
                            $pendingValidation = \App\Models\ValidationTransaction::where('status', 'pending')->count();
                        @endphp
                        <a href="{{ route('admin.validation') }}">
                            <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                            <span>Validation &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingValidation }}</span></span>
                        </a>                        
                    </li>

                    <li class=" {{ ($prefix == 'nin/ipe-clearance' || $route == 'admin.ipe-clearance' )?'nav-active':'' }}">
                        @php
                            $pendingIPE = \App\Models\IPEClearanceTransaction::where('status', 'pending')->count();
                        @endphp
                        <a href="{{ route('admin.ipe-clearance') }}">
                            <i class="fa-solid fa-check-double" aria-hidden="true"></i>
                            <span>IPE Clearance &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingIPE }}</span></span>
                        </a>                        
                    </li>

                    <li class=" {{ ($prefix == 'nin/new-enrollment' || $route == 'admin.new-enrollment' )?'nav-active':'' }}">
                        @php
                            $pendingNewEnrollment = \App\Models\NewEnrollmentTransaction::where('status', 'pending')->count();
                        @endphp
                        <a href="{{ route('admin.new-enrollment') }}">
                            <i class="fa-regular fa-folder-open" aria-hidden="true"></i>
                            <span>New Enrollment &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingNewEnrollment }}</span></span>
                        </a>                        
                    </li>

                    <li class=" {{ ($prefix == 'nin/modification' || $route == 'admin.modification' )?'nav-active':'' }}">
                        @php
                            $pendingModification = \App\Models\ModificationTransaction::where('status', 'pending')->count();
                        @endphp
                        <a href="{{ route('admin.modification') }}">
                            <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                            <span>Modification &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingModification }}</span></span>
                        </a>                        
                    </li>

                    <li class=" {{ ($prefix == 'nin/personalization' || $route == 'admin.personalization' )?'nav-active':'' }}">
                        @php
                            $pendingPersonalization = \App\Models\PersonalizationTransaction::where('status', 'pending')->count();
                        @endphp
                        <a href="{{ route('admin.personalization') }}">
                            <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
                            <span>Personalization &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingPersonalization }}</span></span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.withdrawals')?'nav-active':'' }}">
                        @php
                            $pendingWithdrawal = \App\Models\Withdrawal::where('status', 'pending')->count();
                        @endphp
                        <a href="{{ route('admin.withdrawals') }}">
                            <i class="fa-solid fa-naira-sign" aria-hidden="true"></i>
                            <span>Withdrawal Requests &#x2022;  <span style="color: red; font-weight: bold"> {{ $pendingWithdrawal }}</span></span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.notification')?'nav-active':'' }}">
                        <a href="{{ route('admin.notification') }}">
                            <i class="bx bx-bell" aria-hidden="true"></i>
                            <span>Notifications</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.users')?'nav-active':'' }}">
                        <a href="{{ route('admin.users') }}">
                            <i class="icons icon-user" aria-hidden="true"></i>
                            <span>Agents/Users</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'admin.pricing')?'nav-active':'' }}">
                        <a href="{{ route('admin.pricing') }}">
                            <i class="fa-solid fa-naira-sign" aria-hidden="true"></i>
                            <span>Pricing</span>
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