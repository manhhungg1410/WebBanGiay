<!-- Header -->
<header class="header-v3">
    <!-- Header desktop -->
    <div class="container-menu-desktop trans-03">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop p-l-45">

                <!-- Logo desktop -->
                <a href="{{route('home_page')}}" class="logo">
                    <img src="/frontend/images/icons/logo-02.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="{{route('home_page')}}">Home</a>
                        </li>

                        <li>
                            <a href="{{route('about_us')}}">About us</a>
                        </li>


                        <li class="label1" data-label1="hot">
                            <a href="{{route('details_product','all-products')}}">Products</a>
                            <ul class="sub-menu">
                                @foreach($lsCategories as $parent)
                                    @if($parent->parent_id ==0)
                                <li>
                                    <a href="{{route('details_product',$parent->slug)}}">{{$parent->name}}</a>
                                    <ul class="sub-menu">
                                        @foreach($lsCategories as $child)
                                            @if($child->parent_id == $parent->id)
                                             <li><a href="{{route('details_product',$child->slug)}}">{{$child->name}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                        <li>
                            <a href="{{route('blogs')}}">Blogs</a>
                        </li>

                        <li>
                            <a href="{{route('contact')}}">Contact us</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m h-full">
                    <div class="flex-c-m h-full p-r-25 bor6">
                        <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="2">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </div>

                    <div class="flex-c-m h-full p-lr-19">
                        <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                            <i class="zmdi zmdi-menu"></i>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="/frontend/images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
            <div class="flex-c-m h-full p-r-5">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li>
                <a href="{{route('home_page')}}">Home</a>
            </li>

            <li>
                <a href="{{route('about_us')}}">About</a>
            </li>

            <li class="label1" data-label1="hot">
                <a href="{{route('details_product','all-products')}}">Products</a>
                <ul class="sub-menu">
                    @foreach($lsCategories as $parent)
                        @if($parent->parent_id ==0)
                            <li>
                                <a href="{{route('details_product',$parent->slug)}}">{{$parent->name}}</a>
                                <ul class="sub-menu">
                                    @foreach($lsCategories as $child)
                                        @if($child->parent_id == $parent->id)
                                            <li><a href="{{route('details_product',$child->slug)}}">{{$child->name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>


            <li>
                <a href="{{route('blogs')}}">Blogs</a>
            </li>

            <li>
                <a href="{{route('contact')}}">Contact us</a>
            </li>
        </ul>
    </div>


</header>


<!-- Sidebar -->
<aside class="wrap-sidebar js-sidebar">
    <div class="s-full js-hide-sidebar"></div>

    <div class="sidebar flex-col-l p-t-22 p-b-25">
        <div class="flex-r w-full p-b-30 p-r-27">
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
            <ul class="sidebar-link w-full">

                @if(Auth::check())
                <li class="p-b-13">
                    <a href="{{route('information_guest')}}" class="stext-102 cl2 hov-cl1 trans-04">
                        {{Auth::user()->name}} - My Account
                    </a>
                </li>

                    <li class="p-b-13">
                        <a href="#" class="stext-102 cl2 hov-cl1 trans-04">
                            My Wishlist
                        </a>
                    </li>
                @else
                    <li class="p-b-13">
                        <a href="{{route('view_login')}}" class="stext-102 cl2 hov-cl1 trans-04">
                            Login or Sigup now!
                        </a>
                    </li>
                @endif

                @foreach($lsPolicies as $items)
                <li class="p-b-13">
                    <a href="{{route('policies',$items->id)}}" class="stext-102 cl2 hov-cl1 trans-04">
                        {{$items->name}}
                    </a>
                </li>
                @endforeach

                    @if(Auth::check())
                        <li class="p-b-13">
                            <a href="{{route('logout_guest')}}" class="stext-102 cl2 hov-cl1 trans-04">
                                Log out
                            </a>
                        </li>

                    @endif



            </ul>


        </div>
    </div>
</aside>


<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="/frontend/images/item-cart-01.jpg" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            White Shirt Pleat
                        </a>

                        <span class="header-cart-item-info">
								1 x $19.00
							</span>
                    </div>
                </li>

                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="/frontend/images/item-cart-02.jpg" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            Converse All Star
                        </a>

                        <span class="header-cart-item-info">
								1 x $39.00
							</span>
                    </div>
                </li>

                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="/frontend/images/item-cart-03.jpg" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            Nixon Porter Leather
                        </a>

                        <span class="header-cart-item-info">
								1 x $17.00
							</span>
                    </div>
                </li>
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: $75.00
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>

                    <a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1 rs2-slick1">
        <div class="slick1">
            @foreach($lsBanner as $items)
                <div class="item-slick1 bg-overlay1" style="background-image: url({{asset($items->image)}})" data-thumb="{{asset($items->image)}}" data-caption="{{$items->title}}">
                    <div class="container h-full">
                        <div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									{{$items->title}}
								</span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
                                    {!! $items->description !!}
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="{{route('details_product','all-products')}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                    Shop Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="wrap-slick1-dots p-lr-10"></div>
    </div>
</section>



