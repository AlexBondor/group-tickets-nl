@extends('app')

@section('content')
	<div class="heading-font-normal">
		Searched for:
		<div class="search-data">
			Destination: {{ $destination_name }}
			</br>
			Date: {{ $date }}
			</br>
			Tickets: {{ $tickets }}
			</br>
		</div>
		<hr>
		Results:
	</div>
	@include ('search._list')
@endsection
