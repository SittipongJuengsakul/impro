<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf_token" content="{{ csrf_token() }}" />
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ URL::asset('assets/css/reset.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-theme.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/component-nav.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/bot-style.min.css') }}">
	<script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js') }}"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
	<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/tableToExcel.js') }}"></script>
	<script src="{{ URL::asset('assets/js/show_tables.js')}}"></script>
	<script src="{{ URL::asset('assets/js/show_highcharts.js')}}"></script>
	<!-- fix Bootsrtap 3 
	<script src="{{ URL::asset('assets/js/respond.min.js')}}"></script>
	<script src="{{ URL::asset('assets/js/html5shiv.js')}}"></script>-->

	 
</head>
<body>

	@include('layout.header')

    <div class="container-fluid">
		<div class="bot-content" id="content">
			@yield('content')
		</div>
    </div>
</body>

<script src="{{ URL::asset('assets/js/slidejs/jquery.sudoSlider.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/slidejs/lib/jquery.properload.js') }}"></script>

<script src="{{ URL::asset('assets/js/slide-menu.js') }}"></script>

</html>