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

                    <li class=" {{ ($prefix == '/puk')?'nav-active':'' }}">
                        <a href="{{ route('puk') }}">
                            <i class="fa-solid fa-mobile-retro fa-fw" aria-hidden="true"></i>
                            <span>MTN PUK Retrieval</span>
                        </a>                        
                    </li>

                    @if (auth()->user()->role === 'Agent' || auth()->user()->role === 'Staff')
                        <li class="nav-parent {{ request()->is('nin/*') ? 'nav-active' : '' }}">
                            <a href="#">
                                <i class='bx bx-id-card' aria-hidden="true"></i>
                                <span>NIN Services</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class=" {{ ($prefix == 'nin/verification')?'nav-active':'' }}">
                                    <a href="{{ route('verification') }}">
                                        Verification
                                    </a>                        
                                </li>

                                <li class=" {{ ($prefix == 'nin/verification-2')?'nav-active':'' }}">
                                    <a href="{{ route('verificationV2') }}">
                                        Verification V2
                                    </a>                        
                                </li>
        
                                <li class=" {{ ($prefix == 'nin/validation')?'nav-active':'' }}">
                                    <a href="{{ route('validation') }}">
                                        Validation
                                    </a>                        
                                </li>
        
                                <li class=" {{ ($prefix == 'nin/ipe-clearance')?'nav-active':'' }}">
                                    <a href="{{ route('ipe-clearance') }}">
                                        IPE Clearance
                                    </a>                        
                                </li>
        
                                <li class=" {{ ($prefix == 'nin/new-enrollment')?'nav-active':'' }}">
                                    <a href="{{ route('new-enrollment') }}">
                                        New Enrollment
                                    </a>                        
                                </li>
        
                                <li class=" {{ ($prefix == 'nin/modification')?'nav-active':'' }}">
                                    <a href="{{ route('modification') }}">
                                        Modification
                                    </a>                        
                                </li>
        
                                <li class=" {{ ($prefix == 'nin/personalization')?'nav-active':'' }}">
                                    <a href="{{ route('personalization') }}">
                                        Personalization
                                    </a>                        
                                </li>
                            </ul>
                        </li>
                    @endif

                    <li class="nav-parent {{ ($prefix == '/bills')?'nav-active':'' }}">
                        <a href="#">
                            <i class='icons icon-globe' aria-hidden="true"></i>
                            <span>Airtime & Bills Payment</span>
                        </a>
                        
                        <ul class="nav nav-children">
                            <li class="">
                                <a href="{{ route('airtime') }}">
                                    <b>Coming soon!!</b>
                                </a>                        
                            </li>

                            <li class=" {{ ($route == 'airtime')?'nav-active':'' }}">
                                <a href="{{ route('airtime') }}">
                                    Airtime Recharge
                                </a>                        
                            </li>

                            <li class=" {{ ($route == 'data')?'nav-active':'' }}">
                                <a href="{{ route('data') }}">
                                    Data Purchase
                                </a>                        
                            </li>

                            <li class=" {{ ($route == 'cable-tv')?'nav-active':'' }}">
                                <a href="{{ route('cable-tv') }}">
                                    Cable TV Subscription
                                </a>                        
                            </li>

                            <li class=" {{ ($route == 'electricity-payment')?'nav-active':'' }}">
                                <a href="{{ route('electricity-payment') }}">
                                    Electricity Payment
                                </a>                        
                            </li>

                            <li class=" {{ ($route == 'result-pin')?'nav-active':'' }}">
                                <a href="{{ route('result-pin') }}">
                                    Exam Result PIN Purchase
                                </a>                        
                            </li>

                            {{-- <li class=" {{ ($route == 'airtime-cash')?'nav-active':'' }}">
                                <a href="{{ route('airtime-cash') }}">
                                    Airtime to Cash
                                </a>                        
                            </li> --}}
                        </ul>
                    </li>

                    <li class=" {{ ($route == 'tracks')?'nav-active':'' }}">
                        <a href="{{ route('tracks') }}">
                            <i class="icons icon-list" aria-hidden="true"></i>
                            <span>Tracks</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'wallet')?'nav-active':'' }}">
                        <a href="{{ route('wallet') }}">
                            <i class="fa-solid fa-naira-sign" aria-hidden="true"></i>
                            <span>Wallet & Transactions</span>
                        </a>                        
                    </li>

                    <li class=" {{ ($route == 'profile')?'nav-active':'' }}">
                        <a href="{{ route('profile') }}">
                            <i class="icons icon-user" aria-hidden="true"></i>
                            <span>Profile</span>
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
                    <br>
                    <li class="">
                        <a href="https://wa.me/2348164418223" style="color: green; font-weight: bold;">
                            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                            <span>Contact Support</span>
                        </a>                        
                    </li>

                </ul>
            </nav>
        </div>

         
    {{-- <li class=" {{ ($prefix == 'nin/verification')?'nav-active':'' }}">
        <a href="{{ route('verification') }}">
            <i class="fa-solid fa-certificate" aria-hidden="true"></i>
            <span>Verification</span>
        </a>                        
        </li>

        <li class=" {{ ($prefix == 'nin/validation')?'nav-active':'' }}">
            <a href="{{ route('validation') }}">
                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                <span>Validation</span>
            </a>                        
        </li>

        <li class=" {{ ($prefix == 'nin/ipe-clearance')?'nav-active':'' }}">
            <a href="{{ route('ipe-clearance') }}">
                <i class="fa-solid fa-check-double" aria-hidden="true"></i>
                <span>IPE Clearance</span>
            </a>                        
        </li>

        <li class=" {{ ($prefix == 'nin/new-enrollment')?'nav-active':'' }}">
            <a href="{{ route('new-enrollment') }}">
                <i class="fa-regular fa-folder-open" aria-hidden="true"></i>
                <span>New Enrollment</span>
            </a>                        
        </li>

        <li class=" {{ ($prefix == 'nin/modification')?'nav-active':'' }}">
            <a href="{{ route('modification') }}">
                <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                <span>Modification</span>
            </a>                        
        </li>

        <li class=" {{ ($prefix == 'nin/personalization')?'nav-active':'' }}">
            <a href="{{ route('personalization') }}">
                <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
                <span>Personalization</span>
            </a>                        
        </li> 

        <li class=" {{ ($route == 'airtime')?'nav-active':'' }}">
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
        </li> 
    --}}
                      


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