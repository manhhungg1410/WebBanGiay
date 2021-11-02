@extends('frontend.index')
@section('content')

    {{-- title   --}}
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" >
        <h2 class="ltext-105 title txt-center">
            Blog Details
        </h2>
    </section>
    <!-- Content page -->
    <section class="bg0 p-t-52 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!--  -->
                        <div class="wrap-pic-w how-pos5-parent">
                            <img src="{{asset($article->image)}}" alt="IMG-BLOG">

                            <div class="flex-col-c-m size-123 bg9 how-pos5">
								<span class="ltext-107 cl2 txt-center">
									{{$article->created_at->day}}
								</span>

                                <span class="stext-109 cl3 txt-center">
									 {{ $article->created_at->format('M') }}
                                    {{ $article->created_at->year }}
								</span>
                            </div>
                        </div>

                        <div class="p-t-32">
							<span class="flex-w flex-m stext-111 cl2 p-b-19">
								<span>
									<span class="cl4">By</span> {{$article->user->name}}
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									{{$article->created_at->day}}
                                    {{ $article->created_at->format('M') }},
                                    {{ $article->created_at->year }}
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								 @if($article->type==1)
                                    <span>
											Tin tức
										</span>
                                @elseif($article->type==2)
                                    <span>
											Tin nổi bật
										    </span>
                                @else
                                    <span>
											Tin khuyến mại
										    </span>
                                @endif

							</span>

                            <h4 class="ltext-109 cl2 p-b-28">
                                {{$article->title}}
                            </h4>

                            <p class="stext-117 cl6 p-b-26">
                                    {!! $article->description !!}
                            </p>

                        </div>

                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">

                        <div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Categories
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

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog -->
    <section class="sec-blog bg0 p-t-60 p-b-90">
        <div class="container">
            <div class="p-b-66">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    News Blogs
                </h3>
            </div>

            <div class="row">
                @foreach($lsArticle as $items)
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
@endsection
