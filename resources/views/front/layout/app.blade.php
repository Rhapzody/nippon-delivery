<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
        @php
            $disk = (env('APP_ENV') == 'production')?'s3':'local';
        @endphp
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Auth token --}}
        <meta name="auth-check" content="{{Auth::check()}}">

        <title>{{ config('app.name') }}</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="{{url('css/bootstrap.min.css') . '?' . http_build_query(['v'=>'0.1'])}}"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="{{url('css/slick.css') . '?' . http_build_query(['v'=>'0.1'])}}"/>
 		<link type="text/css" rel="stylesheet" href="{{url('css/slick-theme.css') . '?' . http_build_query(['v'=>'0.1'])}}"   />

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="{{url('css/nouislider.min.css') . '?' . http_build_query(['v'=>'0.1'])}}"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="{{url('css/font-awesome.min.css') . '?' . http_build_query(['v'=>'0.1'])}}">

 		<!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="{{url('css/style.css') . '?' . http_build_query(['v'=>'0.1'])}}"/>

        <!-- jq -->
        <script src="{{url('js/jquery.min.js') . '?' . http_build_query(['v'=>'0.1'])}}"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .error {
                color :red;
            }
            .big-icon {
                font-size: 18px;
            }
        </style>
        <script>
            function getUrl(image_name) {
                if('{{env('APP_ENV')}}' == 'production'){
                    return '{{env('AWS_URL')}}' + '/public' + '/' + image_name;
                }else {
                    return '{{url('storage')}}' + '/' + image_name;
                }
            }
        </script>
    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                    </ul>
					<ul class="header-links pull-right">
                        @guest
                            <li><a href="#"><i class="fa fa-money"></i> บาท</a></li>
                            <li class="nav-item">
                                <i class="fa fa-unlock" aria-hidden="true"></i>
                                <a class="nav-link" href="{{ route('login') }}">{{ __('เข้าสู่ระบบ') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('ลงทะเบียน') }}</a>
                                @endif
                            </li>
                        @else
                            <li><a href={{url('user/edit')}}><i class="fa fa-user-o"></i>{{ Auth::user()->email}}</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                    {{ __('ออกจากระบบ') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-2">
							<div class="header-logo">
								<a href="#" class="logo">
                                    <img style="position: relative;left: 25px;" src={{url('favicon.ico')}} alt="nippon-delivery" width="75px" height="65px" class="">
                                    <span style="color:white;">Nippon delivery</span>
                                </a>
							</div>
                        </div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{url('store')}}" method="get" >
									<select class="input-select" name="typeId">
                                        @if (isset($search_type_id))
                                            <option value="0" {{($search_type_id == 0)?"selected":""}}>ทุกประเภท</option>
                                            @foreach (App\MenuType::all() as $type)
                                                <option value="{{$type->id}}" {{($search_type_id == $type->id)?"selected":""}}>{{$type->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="0" >ทุกประเภท</option>
                                            @foreach (App\MenuType::all() as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        @endif
									</select>
									<input class="input" placeholder="ค้นหาสินค้าที่นี่" name="search" value="{{isset($search)?$search:''}}">
									<button class="search-btn">ค้นหา</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->


                        <!-- ACCOUNT -->
                        <div class="col-md-4 clearfix">
                            <div class="header-ctn">
                                @auth
                                    <!-- Wishlist -->
                                    <div>
                                        <a href="{{url('user/whishlist')}}">
                                            <i class="fa fa-heart-o"></i>
                                            <span>รายการที่ชอบ</span>
                                            <div class="qty" id="whish-qty"></div>
                                        </a>
                                    </div>
                                    <!-- /Wishlist -->

                                    <!-- Cart -->
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>ตะกร้าสินค้า</span>
                                            <div class="qty" id="cart-qty"></div>
                                        </a>
                                        <div class="cart-dropdown">
                                            <div class="cart-list" id="cart-list">
                                                <!-- List -->
                                            </div>
                                            <div class="cart-summary">
                                                <small id="cart-sum-qty"></small>
                                                <h5 id="cart-price"></h5>
                                            </div>
                                            <div class="cart-btns">
                                                <a href="{{url('user/cart?unav=cart')}}">ดูรายละเอียด</a>
                                                <a href="#" onclick="document.getElementById('cart-in-layout').submit();">ดำเนินการต่อ  <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                            <form id="cart-in-layout" action="{{url('user/checkout?unav=check')}}" method="POST">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Cart -->

                                    @unlessrole('ลูกค้า')
                                        <div>
                                            <a href="{{url('staff/dispatch')}}">
                                                <i class="fa fa-cogs"></i>
                                                <span>หลังร้าน</span>
                                            </a>
                                        </div>
                                    @else
                                    @endunlessrole

                                @endauth
                                <!-- Menu Toogle -->
                                <div class="menu-toggle float-rigth">
                                    <a href="#">
                                        <i class="fa fa-bars"></i>
                                        <span>Menu</span>
                                    </a>
                                </div>
                                <!-- /Menu Toogle -->
                            </div>
                        </div>
                        <!-- /ACCOUNT -->

					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
        <!-- /HEADER -->

        <!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
                        <li class="{{((isset($nav) ? $nav : 'Default') == 'home')?"active":""}} h4"><a href="{{url('/')}}">หน้าแรก</a></li>
						<li class="{{((isset($nav) ? $nav : 'Default') == 'all')?"active":""}} h4"><a href="{{url('/store/all')}}">ทั้งหมด</a></li>
						@foreach (App\MenuType::all() as $type)
                            <li class="{{((isset($nav) ? $nav : 'Default') == $type->name)?"active":""}} h4">
                                <a href="{{url('/store',[$type->name])}}">{{$type->name}}</a>
                            </li>
                        @endforeach
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->


        @yield('content')


        <!-- FOOTER -->
        <footer id="footer">
            <!-- top footer -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Nippon-delivery</h3>
                                <p>ร้านอาหารญี่ปุ่น บริการส่งถึงที่รวดเร็วทันใจ</p>
                                <ul class="footer-links">
                                    <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                    <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="clearfix visible-xs"></div>

                        @guest
                        @else
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">บริการ</h3>
                                <ul class="footer-links">
                                    <li><a href="{{url('user/edit?unav=edit')}}">บัญชีของฉัน</a></li>
                                    <li><a href="{{url('user/cart?unav=cart')}}">ตะกร้าสินค้า</a></li>
                                    <li><a href="{{url('user/whishlist?unav=whish')}}">รายการที่ชอบ</a></li>
                                    <li><a href="{{url('user/history?unav=history')}}">ประวัติการสั่งซื้อ</a></li>
                                </ul>
                            </div>
                        </div>
                        @endguest
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /top footer -->

            <!-- bottom footer -->
            <div id="bottom-footer" class="section">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="copyright">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </span>
                        </div>
                    </div>
                        <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /bottom footer -->
        </footer>
        <!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="{{url('js/bootstrap.min.js') . '?' . http_build_query(['v'=>'20181025190455'])}}"></script>
		<script src="{{url('js/slick.min.js') . '?' . http_build_query(['v'=>'20181025190455'])}}"></script>
		<script src="{{url('js/nouislider.min.js') . '?' . http_build_query(['v'=>'20181025190455'])}}"></script>
		<script src="{{url('js/jquery.zoom.min.js') . '?' . http_build_query(['v'=>'20181025190455'])}}"></script>
        <script src="{{url('js/main.js') . '?' . http_build_query(['v'=>'20181025190455'])}}"></script>

        <script>

            let removeFromCart;

            $(function() {

                if ($('meta[name="auth-check"]').attr('content')) {
                    $.get("{{url('whish/count')}}", function(data) {
                        $('#whish-qty').html(data.count);
                    });

                    let sumPrice = 0;
                    let sumQty = 0;
                    let storageUrl = "{{url('storage')}}" + "/";
                    let productUrl = "{{url('product')}}" + "/";

                    function getCart(data) {
                        $('#cart-list').html("");
                        data.forEach(ele => {
                            let element =`
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="${getUrl(ele.menu.menu_pictures[0].name)}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href=${productUrl+ele.menu.id}>${ele.menu.name}</a></h3>
                                        <h4 class="product-price"><span class="qty">${ele.quantity}x</span>${ele.menu.price} บาท</h4>
                                    </div>
                                    <button class="delete" onclick="removeFromCart(${ele.menu.id}, ${ele.quantity}, '${ele.menu.name}');"><i class="fa fa-close"></i></button>
                                </div>
                            `
                            $('#cart-list').append(element);
                            sumQty += ele.quantity;
                            sumPrice += ele.quantity * ele.menu.price;
                        });

                        $('#cart-qty').html(sumQty);
                        $('#cart-sum-qty').html('จำนวนรวม: ' + sumQty + ' ชิ้น');
                        $('#cart-price').html('ราคารวม: ' + sumPrice + ' บาท');
                        sumPrice = 0;
                        sumQty = 0;
                    }

                    $.get("{{url('cart')}}", getCart);

                    removeFromCart = function (id, qty, name) {
                        swal({
                            title: 'ลบรายการ "' + name +'"',
                            text: 'กรุณาระบุจำนวนที่ต้องการลบ',
                            content: {
                                element: "input",
                                attributes: {
                                    placeholder: "1 - " + qty,
                                    type: "number",
                                    min:0,
                                    max:qty
                                },
                            },
                            button: {
                                text:"ลบ"
                            },
                        })
                        .then(input => {
                            if (input >= qty) {
                                input = qty;
                            }else if (input == 0 || input == null || input < 0) {
                                return false;
                            }

                            $.post("{{url('cart/delete')}}" + "/" + id, {
                                quantity:input,
                                _token:"{{csrf_token()}}"
                            },function(data) {
                                if (data.status === 'success') {
                                    swal("ลบสำเร็จ", "ลบ " + name + " จำนวน " + input + "ชิ้น", "success");
                                    $.get("{{url('cart')}}", getCart);
                                }else{
                                    swal("ลบไม่สำเร็จ", "มีข้อผิดพลาดบางประการ", "error");
                                }
                            });

                        });
                    }

                }


            })
        </script>

	</body>
</html>
