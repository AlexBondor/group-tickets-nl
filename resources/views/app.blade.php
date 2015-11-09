<!DOCTYPE html>
<html lang="en"  xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta content="Description" property="og:description"/>
		<meta content="Title" property="og:title"/>
		<title>Group Tickets</title>
		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/roboto-font.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
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
						<li><a href="{{ url('/faq') }}">FAQ</a></li>
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
					
					
<b>Important message!</b> Unfotunately, the NS doesn't want this website to function anymore in the way it works now. You won't be able to create groups anymore until the NS and I come to an agreement and maybe there will be some other way of travelling cheaper so that is profitable for them as well. <b>Thank you for all your support!</b> If you have any idea that I should propose to the NS drop me a line at support@grouptickets.nl. With regret, Alex Bondor.
					
					@yield('content')
					<div align="center" style="color:#000066; font-size: 12px; font-weight: 400">
						support@grouptickets.nl
					</div>
				</div>
			</div>
		</div>
		<footer class="footer">
			Alex Bondor © {{ date('Y') }}
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="float: right">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="S68MYC5GGTXZQ">
				<input type="image" src="http://grouptickets.nl/images/Support.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>

		</footer>
		<!-- Scripts -->
		<script src="{{ asset('/js/jquery-1.10.2.js') }}"></script>
  		<script src="{{ asset('/js/jquery-ui.js') }}"></script>
		<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('/js/select2.min.js') }}"></script>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63171754-1', 'auto');
  ga('send', 'pageview');

</script>
		@yield('footer')
		
	</body>
</html>
