<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Group Tickets</title>
		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/roboto-font.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="beta-label">beta</div>

		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Group Tickets</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="{{ url('/groups') }}">My Groups</a></li>
						<li><a href="{{ url('/search') }}">Search</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="background row">
				<div class="col-xs-12 col-md-6 col-md-offset-3 content">

					@include('_message')

					@yield('content')

				</div>
			</div>
		</div>
		<footer class="footer">
			Made by Alex Bondor © {{ date('Y') }}
		</footer>
		<!-- Scripts -->
		<script src="{{ asset('/js/jquery-1.10.2.js') }}"></script>
  		<script src="{{ asset('/js/jquery-ui.js') }}"></script>
		<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('/js/select2.min.js') }}"></script>
	
		@yield('footer')
		
	</body>
</html>
