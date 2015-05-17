<html>
	<head>
		<title>Welcome</title>
		<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href="{{ asset('/css/welcome.css') }}" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="div-container">
					<div class="title">group-tickets-nl</div>
				</div>

				<div class="div-container">
					<p class="numbers">{{ $count }} users registered already.</p>					
				</div>

				<div class="div-container">
					<a class="btn btn-block btn-facebook fb-button" href="{{ action('AuthController@login') }}">
				    	<i class="fa fa-facebook"></i> Login with FB!
				    </a>
			    </div>

				<div class="div-container">
				    <div class="disclaimer"> 
				    	Disclaimer: This app has nothing to do with NS Company.
				    </div>
			    </div>
			</div>
		</div>
	</body>
</html>
