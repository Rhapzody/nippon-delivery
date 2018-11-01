<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Auth token --}}
        <meta name="auth-check" content="{{Auth::check()}}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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

						@auth
                            <!-- ACCOUNT -->
						    <div class="col-md-4 clearfix">
                                <div class="header-ctn">
                                    <!-- Wishlist -->
                                    <div>
                                        <a href="#">
                                            <i class="fa fa-heart-o"></i>
                                            <span>รายการที่ชอบ</span>
                                            <div class="qty">2</div>
                                        </a>
                                    </div>
                                    <!-- /Wishlist -->

                                    <!-- Cart -->
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>ตะกร้าสินค้า</span>
                                            <div class="qty">3</div>
                                        </a>
                                        <div class="cart-dropdown">
                                            <div class="cart-list">
                                                <div class="product-widget">
                                                    <div class="product-img">
                                                        <img src="./img/product01.png" alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                        <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                                    </div>
                                                    <button class="delete"><i class="fa fa-close"></i></button>
                                                </div>

                                                <div class="product-widget">
                                                    <div class="product-img">
                                                        <img src="./img/product02.png" alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                        <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                                    </div>
                                                    <button class="delete"><i class="fa fa-close"></i></button>
                                                </div>
                                            </div>
                                            <div class="cart-summary">
                                                <small>3 Item(s) selected</small>
                                                <h5>SUBTOTAL: $2940.00</h5>
                                            </div>
                                            <div class="cart-btns">
                                                <a href="#">View Cart</a>
                                                <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Cart -->

                                    @unlessrole('ลูกค้า')
                                        <div>
                                            <a href="{{url('staff/user')}}">
                                                <i class="fa fa-cogs"></i>
                                                <span>หลังร้าน</span>
                                            </a>
                                        </div>
                                    @else
                                    @endunlessrole

                                    <!-- Menu Toogle -->
                                    <div class="menu-toggle">
                                        <a href="#">
                                            <i class="fa fa-bars"></i>
                                            <span>Menu</span>
                                        </a>
                                    </div>
                                    <!-- /Menu Toogle -->
                                </div>
                            </div>
                            <!-- /ACCOUNT -->
                        @endauth
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
                                <h3 class="footer-title">About Us</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                                <ul class="footer-links">
                                    <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                    <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Categories</h3>
                                <ul class="footer-links">
                                    <li><a href="#">Hot deals</a></li>
                                    <li><a href="#">Laptops</a></li>
                                    <li><a href="#">Smartphones</a></li>
                                    <li><a href="#">Cameras</a></li>
                                    <li><a href="#">Accessories</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="clearfix visible-xs"></div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Information</h3>
                                <ul class="footer-links">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Orders and Returns</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Service</h3>
                                <ul class="footer-links">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">View Cart</a></li>
                                    <li><a href="#">Wishlist</a></li>
                                    <li><a href="#">Track My Order</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul>
                            </div>
                        </div>
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
                            <ul class="footer-payments">
                                <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                                <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                            </ul>
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

	</body>
</html>
