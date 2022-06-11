<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="{{url('/home')}}">
                    <img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}" alt="">
                </a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
        </div>
        <div class="left-header col-auto horizontal-wrapper ps-0">
            <ul>
                @auth
                <li class="cursor-pointer">
                    <i class="fa fa-map-marker"></i> <span class="location">{{auth()->user()->location}}</span>
                </li>
                @endauth
            </ul>
        </div>
        <div class="nav-right col-6 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus me-0">
                @if(Request::is('search'))
                <li>
                    <a class="" type="button" data-bs-toggle="modal" data-bs-target="#product-modal-2-mobile" data-bs-original-title="" title="">
                        <i class="fa fa-filter" style="font-size:20px !important;"></i>
                    </a>
                </li>
                @endif
                {{-- <div class="mode"><i class="fa fa-moon-o"></i></div> -->
                <li class="cursor-pointer"><span class="header-search"><i data-feather="search"></i></span></li>
                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="media profile-media">

                        <img class="b-r-10" src="{{asset('assets/images/dashboard/profile.jpg')}}" alt="">
        </div>
        <ul class="profile-dropdown onhover-show-div" style=" left: unset !important;">
            <li><i data-feather="user"> </i><span>{{auth()->user()->name}}</span></li>
            <li><a href="javascript:void(0)" onclick="$('#logout-form').submit()"><i data-feather="log-in"> </i><span>Log Out</span></a></li>
        </ul>
        </li> --}}
        </ul>
    </div>

</div>
</div>
