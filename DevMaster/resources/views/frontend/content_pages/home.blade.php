@extends('frontend.index')
@section('content')
    {{--THÔNG BÁO TRANG--}}
    @include('sweetalert::alert')
    {{--HẾT THÔNG BÁO TRANG--}}



    <!-- Banner -->
    <div class="sec-banner bg0 p-t-95 p-b-55">
        <div class="container">
            <div class="row">
                @foreach($categories as $items)
                <div class="col-md-6 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{asset($items->image)}}" alt="IMG-BANNER">

                        <a href="{{route('details_product',$items->slug)}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									{{$items->name}}
								</span>

                                <span class="block1-info stext-102 trans-04">
									New Trend
								</span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Shop Now
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Blog -->
    <section class="sec-blog bg0 p-t-60 p-b-90">
        <div class="container">
            <div class="p-b-66">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    Our Blogs
                </h3>
            </div>

            <div class="row">
                @foreach($articles as $items)
                <div class="col-sm-6 col-md-4 p-b-40">
                    <div class="blog-item">
                        <div class="hov-img0">
                            <a href="{{route('find_blog',$items->slug)}}">
                                <img src="{{asset($items->image)}}" alt="IMG-BLOG">
                            </a>
                        </div>

                        <div class="p-t-15">
                            <div class="stext-107 flex-w p-b-14">
								<span class="m-r-3">
									<span class="cl4">
										By
									</span>

									<span class="cl5">
										{{$items->user->name}}
									</span>
								</span>

                                <span>
									<span class="cl4">
										on
									</span>

									<span class="cl5">
										{{$items->created_at}}
									</span>
								</span>
                            </div>

                            <h4 class="p-b-12">
                                <a href="{{route('find_blog',$items->slug)}}" class="mtext-101 cl2 hov-cl1 trans-04">
                                    {{$items->title}}
                                </a>
                            </h4>

                            <p class="stext-108 cl6">
                                {!! $items->summary !!}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="p-b-66">
                <h3 class= "txt-center respon1">
                    <a href="{{route('blogs')}}" class="btn btn-outline-secondary">Read More</a>
                </h3>
            </div>
        </div>
    </section>

    <!-- Product -->
    <section class="bg0 p-t-23 p-b-130">
        <div class="container">
            <div class="p-b-66">
                <h3 class="ltext-105 cl5 txt-center respon1">
                   Products Hot Overview
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        All Products
                    </button>

                    @foreach($list as $items)
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{$items['slug']}}">
                        {{$items['name']}}
                    </button>
                    @endforeach
                </div>

                <div class="flex-w flex-c-m m-tb-10">

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <form action="{{route('searchProducts')}}" method="get">
                        @csrf
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Search">
                    </div>
                    </form>
                </div>


            </div>

            <div class="row isotope-grid">

                @foreach($list as $items)
                    @foreach($items['lsProduct'] as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$items['slug']}}">
                    <!-- Block2 -->

                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{asset($product->image)}}" width="230.8px" height="230.8px" alt="IMG-PRODUCT">

                            <a href="#" data-id="{{$product->id}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{route('products_show',[$product->category->slug,$product->slug])}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                   {{$product->name}}
                                </a>


                                    <span class="stext-105 cl3" style="color:red;">
                                        Price: ${{$product->sale}}
                                    </span>



                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
{{--                                    <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-cart" style="color: darkgreen;">--}}
{{--                                        <i class="zmdi zmdi-shopping-cart"></i>--}}
{{--                                    </div>--}}
                                    <img class="icon-heart1 dis-block trans-04" src="/frontend/images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="/frontend/images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="flex-c-m flex-w w-full p-t-38">
                <a href="{{route('details_product','all-products')}}" class="btn btn-outline-secondary">
                    Show More All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    Brands
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2" >
                <div class="slick2">
                    @foreach($lsBrands as $items)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{asset($items->image)}}" height="100px" width="50px" alt="IMG-PRODUCT">

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Modal1 -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="/frontend/images/icons/icon-close.png" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="flex-sb flex-w">
{{--                                <div class="wrap-slick3-dots"></div>--}}
{{--                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>--}}

                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="" id="img_0" alt="IMG-PRODUCT"  width="428ps" height="570px">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" id="thb_1" href="/frontend/images/product-detail-01.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14 name">

                            </h4>

                            <span class="mtext-106 cl2 price">

							</span>

                            <p class="stext-102 cl3 p-t-23 color">

                            </p>

                            <p class="stext-102 cl3 p-t-23 stock" style="color:red;">

                            </p>

                            <p class="stext-102 cl3 p-t-23" style="font-size: 18px">
                                <b>Chính sách ưu đãi cho sản phẩm:</b>
                            </p>

                            <p class="stext-102 cl3 p-t-23 summary">

                            </p>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
