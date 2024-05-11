<!doctype html>
<html class="left-sidebar-panel sidebar-light">
	<head>
		<script src="https://dropin-sandbox.vpay.africa/dropin/v1/initialise.js"></script>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Dashboard | FamCraft Technologies</title>

		<meta name="keywords" content="FamCraft Technologies, NIN services, Airtime, Data, Cable TV" />
		<meta name="description" content="FamCraft Technologies, NIN services, Airtime, Data, Cable TV">
		<meta name="author" content="famcraft.ng">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('img/logos/favicon.png') }}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ asset('img/logos/favicon.png') }}">


		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/animate/animate.compat.css') }}">
		<link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/all.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/boxicons/css/boxicons.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/jquery-ui/jquery-ui.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/jquery-ui/jquery-ui.theme.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/morris/morris.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/simple-line-icons/css/simple-line-icons.css') }}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('admin/css/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('admin/css/skins/default.css') }}" />

		<!-- Head Libs -->
		<script src="{{ asset('admin/vendor/modernizr/modernizr.js') }}"></script>

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

	</head>

	@if (session('success'))
		<script>
			toastr.success('{{ session('success') }}', 'Success');
		</script>
	@endif
	@if (session('error'))
		<script>
			toastr.error('{{ session('error') }}', 'Error');
		</script>
	@endif

	<style>
		.whatsapp {
			display: none; /* Hidden by default */
			position: fixed; /* Fixed/sticky position */
			bottom: 20px; /* Place the button at the bottom of the page */
			right: 30px; /* Place the button 30px from the right */
			z-index: 99; /* Make sure it does not overlap */
			border: none; /* Remove borders */
			outline: none; /* Remove outline */
			background-color: red; /* Set a background color */
			color: white; /* Text color */
			cursor: pointer; /* Add a mouse pointer on hover */
			padding: 15px; /* Some padding */
			border-radius: 10px; /* Rounded corners */
			font-size: 18px; /* Increase font size */
		}

		.whatsapp:hover {
			background-color: #555; /* Add a dark-grey background on hover */
		}
	</style>
	<body>
		<section class="body">

			<!-- start: header -->
            @include('admin-theme.header')
			<!-- end: header -->

			<div class="inner-wrapper">

				<!-- start: sidebar -->
				@if (auth()->user()->role === "Administrator")

                	@include('admin-theme.admin-sidebar')

				@else

					@include('admin-theme.sidebar')

				@endif
				<!-- end: sidebar -->

				@yield('content')

			</div>

			<a href="wa.me/2348164418223" class="whatsapp">Support</a>

			<!-- start: sidebar -->
			@include('admin-theme.footer')
			<!-- end: sidebar -->

		</section>

		<!-- Vendor -->
		<script src="{{ asset('admin/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ asset('admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ asset('admin/vendor/popper/umd/popper.min.js') }}"></script>
		<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('admin/vendor/common/common.js') }}"></script>
		<script src="{{ asset('admin/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ asset('admin/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
		<script src="{{ asset('admin/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

		<!-- Specific Page Vendor -->
		<script src="{{ asset('admin/vendor/jquery-ui/jquery-ui.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
		<script src="{{ asset('admin/vendor/jquery-appear/jquery.appear.js') }}"></script>
		<script src="{{ asset('admin/vendor/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
		<script src="{{ asset('admin/vendor/jquery.easy-pie-chart/jquery.easypiechart.js') }}"></script>
		<script src="{{ asset('admin/vendor/flot/jquery.flot.js') }}"></script>
		<script src="{{ asset('admin/vendor/flot.tooltip/jquery.flot.tooltip.js') }}"></script>
		<script src="{{ asset('admin/vendor/flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ asset('admin/vendor/flot/jquery.flot.categories.js') }}"></script>
		<script src="{{ asset('admin/vendor/flot/jquery.flot.resize.js') }}"></script>
		<script src="{{ asset('admin/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
		<script src="{{ asset('admin/vendor/raphael/raphael.js') }}"></script>
		<script src="{{ asset('admin/vendor/morris/morris.js') }}"></script>
		<script src="{{ asset('admin/vendor/gauge/gauge.js') }}"></script>
		<script src="{{ asset('admin/vendor/snap.svg/snap.svg.js') }}"></script>
		<script src="{{ asset('admin/vendor/liquid-meter/liquid.meter.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqvmap/jquery.vmap.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
		<script src="{{ asset('admin/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('admin/js/theme.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ asset('admin/js/custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ asset('admin/js/theme.init.js') }}"></script>

		<!-- Examples -->
		<script src="{{ asset('admin/js/examples/examples.dashboard.js') }}"></script>
		<script src="{{ asset('admin/js/examples/examples.modals.js') }}"></script>

		{{-- <a href="https://chat.whatsapp.com/HjN7zXVq6UMDpuMo5dDEBs" class="whatsapp-icon" target="_blank">
			<i class="fab fa-whatsapp"></i> <!-- Font Awesome WhatsApp icon -->
		</a> --}}
	</body>
</html>