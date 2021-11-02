<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>
                    @foreach($lsCategories as $items)
                        @if($items->parent_id==0)
                    <li class="p-b-10">
                        <a href="{{route('details_product',$items->slug)}}" class="stext-107 cl7 hov-cl1 trans-04">
                            {{$items->name}}
                        </a>
                    </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Help
                </h4>

                <ul>
                    @foreach($lsPolicies as $items)
                    <li class="p-b-10">
                        <a href="{{route('policies',$items->id)}}" class="stext-107 cl7 hov-cl1 trans-04">
                            {{$items->name}}
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    GET IN TOUCH
                </h4>

                <p class="stext-107 cl7 size-201">
                    Any questions? Let us know in store at Yen Hoa, Cau Giay, Ha Noi or call us on 0965540180
                </p>

            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Contact us?
                </h4>

                <form action="{{route('contact')}}" method="get">
                    @csrf
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            Contact us
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">


            <p class="stext-107 cl6 txt-center">

                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Design by Mạnh Hùng
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </p>
        </div>
    </div>

</footer>

