@extends('app')

@section('content')
	<div class="heading-font-normal">Search for groups</div>
	<hr>
	{!! Form::model($group = new \App\Group, ['url' => 'search/results']) !!}
		@include ('search._form-search')
	{!! Form::close() !!}

	@include ('errors.list')
@endsection
