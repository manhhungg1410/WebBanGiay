@extends('frontend.index')
@section('content')

{{-- title   --}}
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" >
        <h2 class="ltext-105 title txt-center title">
            Products Details
        </h2>
    </section>


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{asset($product->image)}}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{asset($product->image)}}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset($product->image)}}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                @foreach($product_img as $items)
                                <div class="item-slick3" data-thumb="{{asset($items->image)}}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{asset($items->image)}}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset($items->image)}}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{$product->name}}
                        </h4>

                        <span class="mtext-106 cl2" >
                            Price: ${{$product->sale}}
                        </span>

                        <p class="stext-102 cl3 p-t-23" >
                            Color: {{$product->color}}
                        </p>

                        <p class="stext-102 cl3 p-t-23" >
                            Category: {{$product->category->name}}
                        </p>

                        <p class="stext-102 cl3 p-t-23" style="color: red;" >
                            @if($product->stock<=0)
                                Status: Out of Stock
                                @else
                                Status: Stocking
                                @endif
                        </p>

                        <p class="stext-102 cl3 p-t-23" style="font-size: 18px">
                           <b> Promotion policy for this product:</b>
                        </p>

                        <p class="stext-102 cl3 p-t-23">
                            {!! $product->summary !!}
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Size
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="time">
                                            <option>Choose an option</option>
                                            <option>Size S</option>
                                            <option>Size M</option>
                                            <option>Size L</option>
                                            <option>Size XL</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                   {!! $product->summary !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				@if($product->sku==null)
                    SKU: Nothing
                @else
                    SKU: {{$product->sku}}
                    @endif
			</span>

            <span class="stext-107 cl6 p-lr-25">
				Categories: {{$product->category->name}}
			</span>
        </div>
    </section>


    <!-- Viewed Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products Viewed
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @if(!empty($lsViewed))
                    @foreach($lsViewed as $items)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{asset($items->image)}}" width="230.8px" height="230.8px" alt="IMG-PRODUCT">

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
                                                Price: ${{$product->sale}}
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
                        @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach($lsProduct as $items)
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{asset($items->image)}}" width="230.8px" height="230.8px" alt="IMG-PRODUCT">

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
                                        Price: ${{$product->sale}}
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
