@section('sidebar')
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="{{ Route('dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>LARAVEDIA</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
                <div class="profile_pic">
                    <img src="{{ asset('assets/uploads/images/user') . '/' . Auth::user()->image }}". alt="..."
                        class="img-circle profile_img">
                </div>
                <div class="profile_info">
                    <span>Welcome,</span>
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3>General</h3>
                    <ul class="nav side-menu">
                        <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ Route('dashboard') }}">Dashboard</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-database"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ Route('product') }}">Product</a></li>
                                <li><a href="{{ Route('warehouse') }}">Warehouse</a></li>
                                {{-- <li><a href="{{ Route('warehousedtl') }}">Warehouse Detail</a></li> --}}
                            </ul>
                        </li>
                        @if (Auth::user()->role == 'admin')
                            <li><a><i class="fa fa-database"></i> Management Users <span
                                        class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ Route('user') }}">Users</a></li>
                                    {{-- <li><a href="#">Warehouse</a></li> --}}
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Settings">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Lock">
                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
            </div>
            <!-- /menu footer buttons -->
        </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                    <li class="nav-item dropdown open" style="padding-left: 15px;">
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                            data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/uploads/images/user') . '/' . Auth::user()->image }}"
                                alt="">{{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ Route('profile') }}"> Profile</a>
                            {{-- <a class="dropdown-item" href="#">Help</a> --}}
                            <a class="dropdown-item" href="{{ Route('logout') }}"><i class="fa fa-sign-out pull-right"></i>
                                Log
                                Out</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /top navigation -->
@endsection
