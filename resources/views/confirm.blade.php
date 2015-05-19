<html>
	<head>
		<title>Confirm</title>
		<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href="{{ asset('/css/welcome.css') }}" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="div-container">
					<div class="title">confirm email</div>
				</div>

				<div class="div-container">
					<p class="numbers">This should be the email you use</p>					
				</div>

				<div class="div-container">
					<form method="post" action="/confirm" class="btn-block">
						{!! Form::hidden('id', Auth::user()->id) !!}
						<div class="confirm-div">
							{!! Form::input('email', 'email', null, ['class' => 'email-input']) !!}
						</div>
						<div class="confirm-div">
							{!! Form::submit('Confirm', ['class' => 'btn btn-primary btn-confirm']) !!}
						</div>
					</form>
			    </div>

				<div class="div-container">
				    <div class="disclaimer"> 
				    	Thank you for your patience! Enjoy your trips!
				    </div>
			    </div>
			</div>
		</div>
	</body>
</html>

