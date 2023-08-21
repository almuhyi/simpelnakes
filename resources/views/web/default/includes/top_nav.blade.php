
<div class="top-navbar d-flex border-bottom">
    <div class="container d-flex justify-content-between flex-column flex-lg-row">
        <div class="top-contact-box border-bottom d-flex flex-column flex-md-row align-items-center justify-content-center">

            <div class="d-flex align-items-center justify-content-center">
                @if(!empty($generalSettings['site_phone']))
                    <span class="d-flex align-items-center py-10 py-lg-0 text-dark-blue font-14">
                        <i data-feather="phone" width="20" height="20" class="mr-10"></i>
                        {{ $generalSettings['site_phone'] }}
                    </span>
                @endif

                @if(!empty($generalSettings['site_email']))
                    <div class="border-left mx-5 mx-lg-15 h-100"></div>

                    <span class="d-flex align-items-center py-10 py-lg-0 text-dark-blue font-14">
                        <i data-feather="mail" width="20" height="20" class="mr-10"></i>
                        {{ $generalSettings['site_email'] }}
                    </span>
                @endif
            </div>


        </div>

        <div class="xs-w-100 d-flex align-items-center justify-content-between ">
            <div class="d-flex">

                {{-- @include(getTemplate().'.includes.shopping-cart-dropdwon') --}}

                <div class="border-left mx-5 mx-lg-15"></div>

                @include(getTemplate().'.includes.notification-dropdown')
            </div>

            @if(!empty($authUser))


                <div class="dropdown">
                    <a href="#!" class="navbar-user d-flex align-items-center ml-50 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset($authUser->getAvatar()) }}" class="rounded-circle" alt="{{ $authUser->full_name }}">
                        <span class="font-16 user-name ml-10 text-dark-blue font-14">{{ $authUser->full_name }}</span>
                    </a>

                    <div class="dropdown-menu user-profile-dropdown" aria-labelledby="dropdownMenuButton">
                        <div class="d-md-none border-bottom mb-20 pb-10 text-right">
                            <i class="close-dropdown" data-feather="x" width="32" height="32" class="mr-10"></i>
                        </div>

                        <a class="dropdown-item" href="{{ url($authUser->isAdmin() ? '/admin' : '/panel') }}">
                            <img src="{{ asset('') }}assets/default/img/icons/sidebar/dashboard.svg" width="25" alt="nav-icon">
                            <span class="font-14 text-dark-blue">Panel</span>
                        </a>
                        @if($authUser->isTeacher() or $authUser->isOrganization())
                            <a class="dropdown-item" href="{{ url($authUser->getProfileUrl()) }}">
                                <img src="{{ asset('') }}assets/default/img/icons/profile.svg" width="25" alt="nav-icon">
                                <span class="font-14 text-dark-blue">Profil</span>
                            </a>
                        @endif
                        <a class="dropdown-item" href="{{ url('/logout') }}">
                            <img src="{{ asset('') }}assets/default/img/icons/sidebar/logout.svg" width="25" alt="nav-icon">
                            <span class="font-14 text-dark-blue">Keluar</span>
                        </a>
                    </div>
                </div>
            @else
                <div class="d-flex align-items-center ml-md-50">
                    <a href="{{ url('/login') }}" class="py-5 px-10 mr-10 text-dark-blue font-14">Masuk</a>
                    <a href="{{ url('/register') }}" class="py-5 px-10 text-dark-blue font-14">Registrasi</a>
                </div>
            @endif
        </div>
    </div>
</div>


@push('scripts_bottom')
    <link href="{{ asset('') }}assets/default/vendors/flagstrap/css/flags.css" rel="stylesheet">
    <script src="{{ asset('') }}assets/default/vendors/flagstrap/js/jquery.flagstrap.min.js"></script>
    <script src="{{ asset('') }}assets/default/js/parts/top_nav_flags.min.js"></script>
@endpush
