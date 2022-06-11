<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{route('home')}}">
                <img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt="">
                <img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{route('home')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    @auth

                    <li class="back-btn"><a href="{{route('home')}}">
                            <img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>{{auth()->user()->name}}</h6>
                            <p>{{auth()->user()->email}}</p>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="{{$menu =='product'?'active':''}} sidebar-link sidebar-title link-nav" href="{{route('home')}}">
                            <i data-feather="user"></i>
                            <span>Home Page</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="{{$menu =='search'?'active':''}} sidebar-link sidebar-title link-nav" href="{{route('search')}}">
                            <i data-feather="globe"></i>
                            <span>Public Purchase list</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{$menu=='shop'?'active':''}}" href="{{route('shops.index')}}">
                            <i data-feather="shopping-cart"></i>
                            <span>Shop List</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="{{$menu =='category'?'active':''}}  sidebar-link sidebar-title link-nav" href="{{route('category.index')}}">
                            <i data-feather="tag"></i>
                            <span>Category List</span>
                        </a>
                    </li>
                    @if (auth()->user()->role_id == \App\Models\User::ROLE_ADMIN)
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{$menu =='cities'?'active':''}}" href="#">
                            <i data-feather="settings"></i>
                            <span>Admin Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a class="{{$menu =='cities'?'active':''}}" href="{{route('cities.index')}}">Cities</a></li>
                            <li><a class="{{$menu =='users'?'active':''}}" href="{{route('users.index')}}">Users</a></li>
                        </ul>
                    </li>

                    @endif
                    <li class="sidebar-list">
                        <a class="{{$menu =='reports'?'active':''}}  sidebar-link sidebar-title link-nav" href="{{route('reports.index')}}">
                            <i data-feather="tag"></i>
                            <span>Purchase History</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{url('geo-location')}}">
                            <i data-feather="pie-chart"></i>
                            <span>Check Location</span>
                        </a>
                    </li>
                    <li class="sidebar-list" onclick="$('#logout-form').submit()">
                        <a class="sidebar-link sidebar-title link-nav" href="javascript:void(0)">
                            <i data-feather="log-in"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                    @else
                    <li class="sidebar-list">

                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('login')}}">
                            <i data-feather="log-in"></i>
                            <span>Login</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('register')}}">
                            <i data-feather="user-plus"></i>
                            <span>Signup</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
