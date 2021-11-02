@extends('frontend.index')
@section('content')

    {{-- title   --}}
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" >
        <h2 class="ltext-105 title txt-center">
            Team Leader
        </h2>
    </section>
    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            @foreach($userAdmin as $items)
            <div class="row p-b-148">
                <div class="col-md-7 col-lg-8">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        <h3 class="mtext-111 cl2 p-b-16">
                          About CEO: {{$items->name}}
                        </h3>

                        <p class="stext-113 cl6 p-b-26">
                            DOB: {{$items->date}}
                        </p>

                        <p class="stext-113 cl6 p-b-26">
                            Education: {{$items->education}}
                        </p>

                        <p class="stext-113 cl6 p-b-26">
                            Desciption: {{$items->description}}
                        </p>

                        <div class="bor16 p-l-29 p-b-9 m-t-22">
                            <p class="stext-114 cl6 p-r-40 p-b-11">
                              {{$items->sayings}}
                            </p>

                            <span class="stext-111 cl8">
								- CEO {{$items->name}}
							</span>
                        </div>
                    </div>
                </div>

                <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                    <div class="how-bor1 ">
                        <div class="hov-img0">
                            <img src="{{asset($items->avatar)}}" alt="IMG">
                        </div>
                    </div>
                </div>

            </div>
            @endforeach

            @foreach($lsUser as $items)
            <div class="row">
                <div class="order-md-2 col-md-7 col-lg-8 p-b-30">
                    <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                        <h3 class="mtext-111 cl2 p-b-16">
                            About {{$items->name}}
                        </h3>

                        <p class="stext-113 cl6 p-b-26">
                            DOB: {{$items->date}}
                        </p>

                        <p class="stext-113 cl6 p-b-26">
                            Education: {{$items->education}}
                        </p>

                        <p class="stext-113 cl6 p-b-26">
                            Description: {{$items->description}}
                        </p>

                        <div class="bor16 p-l-29 p-b-9 m-t-22">
                            <p class="stext-114 cl6 p-r-40 p-b-11">
                               {{$items->sayings}}
                            </p>

                            <span class="stext-111 cl8">
								- {{$items->name}}
							</span>
                        </div>
                    </div>
                </div>

                <div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
                    <div class="how-bor2">
                        <div class="hov-img0">
                            <img src="{{asset($items->avatar)}}" alt="IMG">
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
        </div>
    </section>

@endsection
