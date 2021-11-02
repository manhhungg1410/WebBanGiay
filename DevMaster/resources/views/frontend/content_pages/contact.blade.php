@extends('frontend.index')
@section('content')

    {{-- title   --}}
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" >
        <h2 class="ltext-105 title txt-center">
            Contact us
        </h2>
    </section>
    <!-- Content page -->

    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    {{--        BẮT ERROR            --}}
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    {{--        END BẮT ERROR            --}}
                    <form>
                        @csrf
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Send Us A Message
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            @if(empty($email))
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="email" name="email" placeholder="Your Email Address">
                            @else
                                <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="email" name="email" value="{{$email}}">
                                @endif
                            <img class="how-pos4 pointer-none" src="/frontend/images/icons/icon-email.png" alt="ICON">
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" id="name" name="name" placeholder="Your Name">
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" id="phone" name="phone" placeholder="Your Phone">
                        </div>

                        <div class="bor8 m-b-30">
                            <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" id="msg" placeholder="How Can We Help?"></textarea>
                        </div>

                        <style>
                            .loader {
                                border: 16px solid #f3f3f3;
                                border-radius: 50%;
                                border-top: 16px solid blue;
                                border-bottom: 16px solid blue;
                                width: 90px;
                                height: 90px;
                                -webkit-animation: spin 2s linear infinite;
                                animation: spin 2s linear infinite;
                                display: none;
                            }

                            .ok{
                                justify-content: center;
                                padding-bottom:20px;
                            }

                            @-webkit-keyframes spin {
                                0% { -webkit-transform: rotate(0deg); }
                                100% { -webkit-transform: rotate(360deg); }
                            }

                            @keyframes spin {
                                0% { transform: rotate(0deg); }
                                100% { transform: rotate(360deg); }
                            }
                        </style>
                        <div class="row ok">
                            <div class="loader"></div>
                        </div>

                        <button id="submitForm" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            Submit
                        </button>
                    </form>

                </div>


                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

                        <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Address
							</span>

                            <p class="stext-115 cl6 size-213 p-t-18">
                                Golden Park, P.Yên Hòa, Q.Cầu Giấy, TP.Hà Nội
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

                        <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Lets Talk
							</span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                +98 965 554 0180
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

                        <div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Sale Support
							</span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                hunq1410@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#submitForm').click(function(e){
                e.preventDefault();
                $('.loader').show();
                var datas = {
                    'name': $('#name').val(),
                    '_token': "{{ csrf_token() }}",
                    'email': $('#email').val(),
                    'phone': $('#phone').val(),
                    'msg': $('#msg').val(),
                };
            //   console.log(datas);
                $.ajax({
                    type: "POST",
                    url: "api/send-email",
                    data: datas,
                    success:function(response){
                        $('.loader').hide();
                        Swal.fire({
                            title: 'Success',
                            text: "Your message has been sent.",
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Return Home Page',
                            cancelButtonText: 'Continue'
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location = '/';
                            }
                            $('#name').val('');
                            $('#email').val('');
                            $('#phone').val('');
                            $('#msg').val('');
                        });
                    },
                    error:function (response){
                        console.log(response);
                        $('.loader').hide();
                        Swal.fire(
                            'Error!',
                            'Your message can not send.' +
                            'Please fill out the form!!!',
                            'error'
                        )
                    }
                });
            });
        });
    </script>
    @endsection

