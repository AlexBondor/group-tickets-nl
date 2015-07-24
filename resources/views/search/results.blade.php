@extends('app')

@section('content')
	<div class="heading-font-normal">
		Searched for:
		<div class="search-data">
			Destination: {{ $data['destination_name'] }}
			</br>
			Date: {{ $data['date'] }}
			</br>
			Tickets: {{ $data['tickets'] }}
			</br>
		</div>
		<hr>
		Results:
	</div>
	@include ('search._list')
@endsection
