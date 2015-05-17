@extends('app')

@section('content')
	<div class="heading-font-normal">
		{{ count($new_groups) }} new /
		{{ count($joined_groups) }} joined 
	</div>
	<hr>
	@include ('search._list')
@endsection
