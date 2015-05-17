@extends('app')

@section('content')
	<div class="heading-font-normal">My groups</div>
	<hr>

	@include ('groups._list')

@endsection
