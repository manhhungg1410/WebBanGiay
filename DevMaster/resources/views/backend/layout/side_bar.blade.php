<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        @if(Auth::check())
        <div class="user-panel">
            <div class="pull-left image">
               <img src="{{asset(Auth::user()->avatar)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="/"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
     @endif
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>


            <li class="{{ request()->is('admin') ? 'active' : ''  }}">
                <a href="{{route('adminadmin')}}">
                   <span>Welcome {{Auth::user()->role->name}}</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

            @can('admin_manager')
            <li class="{{ request()->is('admin/dashboard') ? 'active' : ''  }}">
                <a href="{{route('admindashboard')}}">
                    <i class="fa fa-dashboard"></i>  <span>Dashboard</span>
                    <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">new</small>--}}
            </span>
                </a>
            </li>
            @endcanany

            @can('not_poster')
            <li class="{{ request()->is('admin/categories*') ? 'active' : ''  }}">
                <a href="{{route('admincategories.index')}}">
                    <i class="fa fa-th"></i> <span>Categories Management</span>
                    <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">new</small>--}}
            </span>
                </a>
            </li>

            <li class="treeview {{ (request()->is('admin/products*') || (request()->is('admin/product_images*'))) ? 'active' : ''  }}" >
                <a href="/backend/#">
                    <i class="fa fa-th"></i>
                    <span>Products Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('admin/products*') ? 'active' : ''  }}"><a href="{{route('adminproducts.index')}}" ><i class="fa fa-circle-o"></i> List Products </a></li>
                    <li class="{{ request()->is('admin/product_images*') ? 'active' : ''  }}"><a href="{{route('adminproduct_images.index')}}" ><i class="fa fa-circle-o"></i> Products Image Management </a></li>
                </ul>
            </li>

            <li class="{{ request()->is('admin/brands*') ? 'active' : ''  }}">
                <a href="{{route('adminbrands.index')}}">
                    <i class="fa fa-th"></i> <span>Brands Management</span>
                    <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">new</small>--}}
            </span>
                </a>
            </li>

            @endcan

            @cannot('editor')
            <li class="{{request()->is('admin/articles*')?'active':''}}">
                <a href="{{route('adminarticles.index')}}">
                    <i class="fa fa-th"></i> <span>Articles Management</span>
                    <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">new</small>--}}
            </span>
                </a>
            </li>
            @endcannot

            @cannot('editor_poster')
            <li class="{{(request()->is('admin/user*') || request()->is('admin/role*'))?'active':''}}">
                <a href="{{route('adminuser.index')}}">
                    <i class="fa fa-th"></i> <span>Users Management</span>
                    <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">new</small>--}}
            </span>
                </a>
            </li>
            @endcannot

            @cannot('editor_poster')
                <li class="{{request()->is('admin/policies*')?'active':''}}">
                    <a href="{{route('adminpolicies.index')}}">
                        <i class="fa fa-th"></i> <span>Policies Management</span>
                        <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">new</small>--}}
            </span>
                    </a>
                </li>
            @endcannot

            @can('not_poster')
            <li class="{{request()->is('admin/banner*')?'active':''}}">
                <a href="{{route('adminbanner.index')}}">
                    <i class="fa fa-th"></i> <span>Banners Management</span>
                    <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">new</small>--}}
            </span>
                </a>
            </li>


            <li class="treeview">
                <a href="/backend/#">
                    <i class="fa fa-th"></i>
                    <span>Orders Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-circle-o"></i> List </a></li>
{{--                    <li><a href=""><i class="fa fa-circle-o"></i> Thêm </a></li>--}}
                </ul>
            </li>



                <li class="{{request()->is('admin/contacts*')?'active':''}}">
                    <a href="{{route('admincontacts.index')}}">
                        <i class="fa fa-th"></i> <span>Contacts Management</span>
                        <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">new</small>--}}
                 </span>
                    </a>
                </li>

            @endcan

            @can('admin_manager')
            <li class="treeview">
                <a href="/backend/#">
                    <span class="glyphicon glyphicon-wrench"></span>
                    <span>Website Configuaration</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-circle-o"></i> List </a></li>
{{--                    <li><a href=""><i class="fa fa-circle-o"></i> Thêm </a></li>--}}
                </ul>
            </li>
                @endcan

            <li>
                <a href="{{route('admin_logout')}}">
                    <span class="glyphicon glyphicon-log-out"></span> <span>Log Out</span>
                    <span class="pull-right-container">
{{--              <small class="label pull-right bg-green">new</small>--}}
            </span>
                </a>
            </li>
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>




