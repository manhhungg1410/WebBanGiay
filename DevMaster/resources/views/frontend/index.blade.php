<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="/frontend/images/icons/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/frontend/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/css/main.css')}}">
    <!--===============================================================================================-->
    @yield('my_css')

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
        }

        input[type=number] {
            -moz-appearance:textfield; /* Firefox */
        }
    </style>
</head>
<body class="animsition">

@include('frontend.header')

@yield('content')

@include('frontend.footer')
<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
</div>

<!--===============================================================================================-->
<script src="/frontend/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/frontend/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="/frontend/vendor/bootstrap/js/popper.js"></script>
<script src="/frontend/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/frontend/vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function(){
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
@yield('my_js')
<!--===============================================================================================-->
<script src="/frontend/vendor/daterangepicker/moment.min.js"></script>
<script src="/frontend/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="/frontend/vendor/slick/slick.min.js"></script>
<script src="/frontend/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="/frontend/vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="/frontend/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled:true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="/frontend/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="/frontend/vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('.js-addwish-b2').on('click', function(e){
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function(){
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    $('.js-addcart-detail').each(function(){
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to cart !", "success");
        });
    });
</script>
<!--===============================================================================================-->
<script src="/frontend/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function(){
        $(this).css('position','relative');
        $(this).css('overflow','hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function(){
            ps.update();
        })
    });
</script>
<!--===============================================================================================-->
<script src="/frontend/js/main.js"></script>

    <script>
        $(document).ready(function(){
            $(document).on('keyup', '.qty', function() {
                var that = $(this);
                var qty = that.val();
                var rowID = that.siblings('.rowID').val();
                var price = that.siblings('.price').val();

                if(qty!="" && qty>0) {
                    $.ajax({
                        url: '/update-cart',
                        type: 'get',
                        data: {qty: qty, rowID: rowID},
                        success: function (response) {
                            if (response.status == 200) {
                                var sum = 0;
                                $('.content-cart').each(function () {
                                    var tien1sp = $(this).children('.price').val();
                                    var sluong1sp = $(this).children('.qty').val();
                                    if(sluong1sp=="" || sluong1sp==null){
                                        sluong1sp = 0;
                                    }
                                    sum += (tien1sp * sluong1sp);
                                });
                                $('.header-cart-total').html('Total: ' + sum + '$');
                            }
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                }
            });
            $(document).on('change', '.qty', function() {
                var that = $(this);
                var qty = that.val();
                var rowID = that.siblings('.rowID').val();
                if(qty=="" || qty<1){
                    qty = 1;
                    that.val(qty);
                    $.ajax({
                        url: '/update-cart',
                        type: 'get',
                        data: {qty: qty, rowID: rowID},
                        success: function (response) {
                            if (response.status == 200) {
                                var sum = 0;
                                $('.content-cart').each(function () {
                                    var tien1sp = $(this).children('.price').val();
                                    var sluong1sp = $(this).children('.qty').val();

                                    sum += (tien1sp * sluong1sp);
                                });
                                $('.header-cart-total').html('Total: ' + sum + '$');
                            }
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                }
            });
            $(document).on('click', '.header-cart-item-img', function() {
                var delete_this = $(this);
                    var id = $(this).siblings('.id_proc').val();
                console.log(id);
                    $.ajax({
                        url: '/delete-one-cart',
                        type: 'get',
                        data: {id: id},
                        success: function (response) {
                            if (response.status == 200) {
                                delete_this.parent('.header-cart-item').remove();
                                var sum = 0;
                                var count=0;
                                $('.content-cart').each(function () {
                                    count++;
                                    var tien1sp = $(this).children('.price').val();
                                    var sluong1sp = $(this).children('.qty').val();

                                    sum += (tien1sp * sluong1sp);
                                });
                                $('.header-cart-total').html('Total: ' + sum + '$');
                                $('.icon-header-noti').attr('data-notify',count)
                            }
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
            });
        });
    </script>


</body>
</html>
