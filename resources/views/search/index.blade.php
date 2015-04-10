@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			{!! Form::model($group = new \App\Group, ['url' => 'search\results']) !!}
				@include ('search._form', ['submitButtonText' => 'Search'])
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
