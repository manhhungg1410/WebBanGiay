<header class="main-header">

    <!-- Logo -->
    <a href="/backend/index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="/backend/#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                @if(Auth::check())
                <li class="dropdown user user-menu">
                    <a href="/backend/#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset(Auth::user()->avatar)}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset(Auth::user()->avatar)}}" class="img-circle" alt="User Image">

                            <p>
                                {{Auth::user()->name}}
                                <small>Member since {{Auth::user()->created_at}}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('adminuser.show',Auth::user()->id)}}" class="btn btn-default btn-flat"> <span class="glyphicon glyphicon-user"></span> Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('adminchange_pass',Auth::user()->id)}}" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-refresh"></span> Change Password</a>
                            </div>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="/backend/#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>

    </nav>
</header>
