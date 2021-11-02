@extends('frontend.index')
@section('content')

    <!-- Title -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" >
        <h2 class="ltext-105 title txt-center">
            @if($categories==null)
               All Products
            @else
            Products - {{$categories->name}}
                @endif
        </h2>
    </section>

    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        @if($categories==null)
                            All Products
                        @else
                            Products - {{$categories->name}}
                        @endif
                    </button>
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
                @foreach($lsProduct as $items)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{asset($items->image)}}"  width="230.8px" height="230.8px" alt="IMG-PRODUCT">

                            <a href="#" data-id="{{$items->id}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{route('products_show',[$items->category->slug,$items->slug])}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{$items->name}}
                                </a>

                                <span class="stext-105 cl3" style="color:red;">
                                        Price: ${{$items->sale}}
                                    </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04" src="/frontend/images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="/frontend/images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">

                    {{$lsProduct->links("pagination::bootstrap-4")}}

            </div>
        </div>
    </div>

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


