<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Nippon Delivery</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href={{url("/assets/css/bootstrap.min.css")}}>
	<link rel="stylesheet" href={{url("https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i")}}>
	<link rel="stylesheet" href={{url("/assets/css/ready.css")}}>
    <link rel="stylesheet" href={{url("/assets/css/demo.css")}}>
    <script src={{url("/assets/js/core/jquery.3.2.1.min.js")}}></script>
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <style type="text/css" media="print">
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }
    </style>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
                <a href="{{url('/')}}" class="logo">
                    <i class="la la-angle-left"> </i>
					กลับไปหน้าร้าน
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="{{url('storage',[Auth::user()->picture_name])}}" alt="user-img" width="36" class="img-circle"><span >{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="{{url('storage',[Auth::user()->picture_name])}}" alt="user"></div>
										<div class="u-text">
											<h4>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</h4>
											<p class="text-muted">{{ Auth::user()->email}}</p></div>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href={{url('user/edit')}}><i class="ti-user"></i> แก้ไขโปรไฟล์</a>
									<div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> ออกจากระบบ</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
							<img src="{{url('storage',[Auth::user()->picture_name])}}">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
                                    {{ Auth::user()->first_name}} {{ Auth::user()->last_name}}
									<span class="user-level">{{ Auth::user()->roles[0]->name}}</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href={{url('user/edit')}}>
											<span class="link-collapse">แก้ไขโปรไฟล์</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
                        @hasanyrole('เจ้าของร้าน|ผู้จัดการสาขา')
                            <li class="nav-item {{($unav=='user')?'active':''}}">
                                <a href={{url('/staff/user/')}}>
                                    <i class="la la-group"></i>
                                    <p>ผู้ใช้</p>
                                </a>
                            </li>
                            <li class="nav-item {{($unav=='product')?'active':''}}">
                                <a href={{url('/staff/product/')}}>
                                    <i class="la la-shopping-cart"></i>
                                    <p>สินค้า</p>
                                </a>
                            </li>
                            <li class="nav-item {{($unav=='sales')?'active':''}}">
                                <a href={{url('/staff/sales/')}}>
                                    <i class="la la-area-chart"></i>
                                    <p>ยอดขาย</p>
                                    <span class="badge badge-count"></span>
                                </a>
                            </li>
                            <li class="nav-item {{($unav=='history')?'active':''}}">
                                <a href={{url('/staff/history/')}}>
                                    <i class="la la-book"></i>
                                    <p>ประวิติการสั่งซื้อ</p>
                                    <span class="badge badge-count"></span>
                                </a>
                            </li>
                        @endhasanyrole
                        @hasrole('พ่อครัว/แม่ครัว')
                            <li class="nav-item {{($unav=='order')?'active':''}}">
                                <a href={{url('/staff/order/')}}>
                                    <i class="la la-file-text"></i>
                                    <p>การรับออเดอร์</p>
                                    <span class="badge badge-count"></span>
                                </a>
                            </li>
                        @endhasrole
                        @hasrole('คนส่งสินค้า')
                            <li class="nav-item {{($unav=='deliver')?'active':''}}">
                                <a href={{url('/staff/deliver/')}}>
                                    <i class="la la-truck"></i>
                                    <p>การจัดส่ง</p>
                                    <span class="badge badge-count"></span>
                                </a>
                            </li>
                        @endhasrole
                        @hasrole('เจ้าของร้าน')
                            <li class="nav-item {{($unav=='branch')?'active':''}}">
                                <a href={{url('staff/branch')}}>
                                    <i class="la la-map-marker"></i>
                                    <p>สาขา</p>
                                </a>
                            </li>
                        @endhasrole
					</ul>
				</div>
            </div>
            {{-- main --}}
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
                        {{-- content goes here --}}

                        @yield('content')

					</div>
				</div>
				<footer class="footer">
					<div class="container-fluid">
						<nav class="pull-left">
							<ul class="nav">
								<li class="nav-item">
									<a class="nav-link" href="http://www.themekita.com">
										ThemeKita
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">
										Help
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="https://themewagon.com/license/#free-item">
										Licenses
									</a>
								</li>
							</ul>
						</nav>
						<div class="copyright ml-auto">
							2018, made with <i class="la la-heart heart text-danger"></i> by <a href="http://www.themekita.com">ThemeKita</a>
						</div>
					</div>
				</footer>
			</div>
		</div>
	</div>
</body>
<script src={{url("/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js")}}></script>
<script src={{url("/assets/js/core/popper.min.js")}}></script>
<script src={{url("/assets/js/core/bootstrap.min.js")}}></script>
<script src={{url("/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js")}}></script>
<script src={{url("/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js")}}></script>
<script src={{url("/assets/js/plugin/jquery-mapael/jquery.mapael.min.js")}}></script>
<script src={{url("/assets/js/plugin/jquery-mapael/maps/world_countries.min.js")}}></script>
<script src={{url("/assets/js/plugin/chart-circle/circles.min.js")}}></script>
<script src={{url("/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js")}}></script>
<script src={{url("/assets/js/ready.min.js")}}></script>

</html>
