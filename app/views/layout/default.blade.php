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
		<section id="auth-header">
		 @if(Auth::check())
			<div class="row">
				<div class="col-md-offset-10">
					<i class="glyphicon glyphicon-user"> </i>
					Hello {{ Auth::user()->nickname }} | <a href="{{ url('rider/logout') }}">Log out </a>
				</div>
			</div>
		@else
			<div class="row">
				<div class="col-md-offset-11">
					<a href="{{ url('rider/login') }}" class="btn btn-xs btn-default"> Connect </a>
				</div>
			</div>
		@endif
		</section>
		<nav class="navbar navbar-default" >
			<div class="logo-wrap">
				<figure>
					<a href="{{ url('/') }}">
						<img src="{{ asset('assets/images/flag-flat-dark-blue.png') }}" alt="TMW" />
					</a>
				</figure>
					<div>
					<h1> 
						Too much the wind my friend !
					</h1>
					<h2>
						<i class="glyphicon glyphicon-map-marker"> </i> <strong> Windsurf </strong>| <strong>Kitesurf </strong>spot finder
					</h2>
				</div>
			</div>
			<ul>
				@if(Auth::check())
				<li>
					<a href="{{ url('spot/new') }}"> <i class="glyphicon glyphicon-plus-sign"> </i> Add a new spot </a>
				</li>
				<li>
					<div class="horizontal-form">
						{{ Form::open(array('url' => 'spot/search', 'method' => 'post', 'id' => 'searchForm') ) }}
							 <input type="search" id="spotname" name="spotname" placeholder="Search.." />
							 <button type="submit" id="submitSpotSearch" name="submitSpotSearch" class="btn btn-default btn-sm">
								<i class="glyphicon glyphicon-search"></i>
							 </button>
						{{ Form::close() }}
					</div>
				</li>
				@endif
			</ul>
		</nav>
	
	
		@yield('content')

		<div id="footer">
		</div>
	</div>
	
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="{{ asset('assets/js/main.js') }}"> </script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"> </script>
	@yield('scripts')

	</body>

</html>
