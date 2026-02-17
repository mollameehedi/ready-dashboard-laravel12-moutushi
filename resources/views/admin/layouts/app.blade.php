
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ setting_img('website_favicon') }}" type="image/png"/>
	<!--plugins-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('admin.includes.style')
	<title>@stack('title', setting('site_name'))</title>
</head>
<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ setting_img('website_logo') }}"
                    alt="" width="100" height="40">
				</div>
				<div>
					<h4 class="logo-title d-block d-xl-none" data-setting="app_name">School</h4>
				</div>
				{{-- <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div> --}}
			</div>
			<!--navigation-->
			@include('admin.includes.left_sidebar')
		</div>
		<header>
			<div class="topbar d-flex align-items-center">
				<div class="toggle-icon "><i class='bx bx-arrow-to-left'></i>
				</div>
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#"><i class='bx bx-search'></i>
								</a>
							</li>
							<button class="btn btn-sm" id="themeToggle">
								<i class='bx bx-moon'></i>
							</button>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{ get_image_url(Auth::user(),'image') }}" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">{{auth()->user()->first_name}}</p>
								<p class="designattion mb-0">{{auth()->user()->role}}</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item" href="{{ route('admin.settings.general.index') }}"><i class="bx bx-cog"></i><span>Settings</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                            </li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
                @yield('content')
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		@include('admin.includes.footer')
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	@include('admin.includes.script')
</body>

</html>
