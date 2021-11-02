@extends('frontend.index')
@section('content')

    {{-- title   --}}
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" >
        <h2 class="ltext-105 title txt-center">
            Blogs
        </h2>
    </section>
    <!-- Content page -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">

                        @foreach($lsArticle as $items)
                        <!-- item blog -->
                        <div class="p-b-63">
                            <a href="blog-detail.html" class="hov-img0 how-pos5-parent">
                                <img src="{{asset($items->image)}}" alt="IMG-BLOG">

                                <div class="flex-col-c-m size-123 bg9 how-pos5">
									<span class="ltext-107 cl2 txt-center">
										{{ $items->created_at->format('d') }}
									</span>

                                    <span class="stext-109 cl3 txt-center">
                                       {{ $items->created_at->format('M') }}
										{{ $items->created_at->year }}
									</span>
                                </div>
                            </a>

                            <div class="p-t-32">
                                <h4 class="p-b-15">
                                    <a href="blog-detail.html" class="ltext-108 cl2 hov-cl1 trans-04">
                                        {{$items->title}}
                                    </a>
                                </h4>

                                <p class="stext-117 cl6">
                                   {!! $items->summary !!}
                                </p>

                                <div class="flex-w flex-sb-m p-t-18">
									<span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
										<span>
											<span class="cl4">By</span> {{$items->user->name}}
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>

                                        @if($items->type==1)
										<span>
											Tin tức
										</span>
                                        @elseif($items->type==2)
                                            <span>
											Tin nổi bật
										    </span>
                                        @else
                                            <span>
											Tin khuyến mại
										    </span>
                                        @endif
									</span>

                                    <a href="{{route('find_blog',$items->slug)}}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                        Continue Reading

                                        <i class="fa fa-long-arrow-right m-l-9"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Pagination -->
                            {{$lsArticle->appends(['search'=>$title])->links("pagination::bootstrap-4")}}
                    </div>

                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <div class="bor17 of-hidden pos-relative">
                            <form action="{{route('blogs')}}" method="get">
                                @csrf
                                <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" value="{{$title}}" placeholder="Search">

                                <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Categories Products
                            </h4>

                            <ul>
                                @foreach($categories as $items)
                                <li class="bor18">
                                    <a href="{{route('details_product',$items->slug)}}" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                        {{$items->name}}
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="p-t-65">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Featured Products
                            </h4>

                            <ul>
                                @foreach($lsProduct as $items)
                                <li class="flex-w flex-t p-b-30">
                                    <a href="{{route('products_show',[$items->category->slug,$items->slug])}}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                        <img src="{{asset($items->image)}}" width="90" height="110" alt="PRODUCT">
                                    </a>

                                    <div class="size-215 flex-col-t p-t-8">
                                        <a href="{{route('products_show',[$items->category->slug,$items->slug])}}" class="stext-116 cl8 hov-cl1 trans-04">
                                            {{$items->name}}
                                        </a>

                                        <span class="stext-116 cl6 p-t-20">
											@if($items->sale == $items->price)
                                                ${{$items->price}}
                                                @else ${{$items->sale}}
                                                @endif
										</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
