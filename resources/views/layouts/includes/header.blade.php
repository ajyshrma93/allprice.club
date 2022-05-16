<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="{{url('/home')}}">
                    <img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}" alt="">
                </a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0">
            <ul>
                <li class="cursor-pointer"><span class="header-search"><i data-feather="search"></i></span></li>
            </ul>
        </div>
        @auth

        <div class="nav-right col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus me-0">
                <li>
                    <!-- <div class="mode"><i class="fa fa-moon-o"></i></div> -->
                </li>
                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="media profile-media">
                        <div class="media-body">
                            <span>{{auth()->user()->name}} &nbsp;</span>
                        </div>
                        <img class="b-r-10" src="../assets/images/dashboard/profile.jpg" alt="">
                    </div>
                    <ul class="profile-dropdown onhover-show-div">

                        <li><a href="javascript:void(0)" onclick="$('#logout-form').submit()"><i data-feather="log-in"> </i><span>Log Out</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        @endauth

    </div>
</div>
