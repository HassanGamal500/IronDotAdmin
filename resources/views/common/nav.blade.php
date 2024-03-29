<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-dark">
    <audio id="mysound" src="{{asset('assets/sound/not-bad.mp3')}}"></audio>
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{url('/')}}"><img src="{{asset('assets/images/page-logo.png')}}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{url('/')}}"><img src="{{asset('assets/images/icons.png')}}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{asset(getImage()->image)}}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{getImage()->name}}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{url(route('edit_profile'))}}">
                    <i class="mdi mdi-account-box mr-2 text-info"></i> {{trans('admin.profile')}} </a>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{route('admin.logout')}}">
                    @csrf
                        <button type="submit" class="dropdown-item">
                        <i class="mdi mdi-logout mr-2 text-info"></i> {{trans('admin.logout')}} </button>
                    </form>
                </div>
            </li>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black"><i class="mdi mdi-earth mr-2 text-success"></i>{{trans('admin.language')}}</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="{{asset('lang/en')}}">
                        <i class="mdi mdi-cached mr-2 text-success"></i> {{trans('admin.english')}} </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{asset('lang/ar')}}">
                        <i class="mdi mdi-cached mr-2 text-success"></i> {{trans('admin.arabic')}} </a>
                    </div>
                </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-email-outline"></i>
                    <span class="count-symbol bg-warning"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0">{{trans('admin.messages')}}</h6>
                    @foreach(messageContact() as $contact)
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">{{$contact->contact_us_name}}</h6>
                            <p class="text-gray mb-0"> {{$contact->contact_us_subject}} </p>
                        </div>
                    </a>
                    @endforeach
                    <a href="{{url(route('contacts'))}}"><h6 class="p-3 mb-0 text-center">{{trans('admin.read more')}}</h6></a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>