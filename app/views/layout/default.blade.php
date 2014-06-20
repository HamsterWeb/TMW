<!doctype html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7" lang="fr"><![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7" lang="fr"><![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8" lang="fr"><![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9" lang="fr"><![endif]-->
<!--[if gt IE 9]>  <html class="modern" lang="fr"><![endif]-->
<!--[if !IE]><!--> <html class="modern" lang="fr"><!--<![endif]--> 

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Windsurf|Kitesurf spot finder</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
		@yield('head')
		
	</head>
	<body>
	<div class="container-fluid" id="header-wrap">
		<nav class="navbar navbar-default" >
			<div class="logo-wrap">
				<figure>
					<h1> TMW </h1>	
				</figure>
			</div>
			<ul>
				<li>
					<a href="{{ url('/') }}"> Home </a>
				</li>
				<li>
					<a href="{{ url('spot/new') }}"> Add a new spot </a>
				</li>
			</ul>
		</nav>
	</div>
	
	@yield('content')

	
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="{{ asset('assets/js/main.js') }}"> </script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"> </script>
	@yield('scripts')

	</body>

</html>
