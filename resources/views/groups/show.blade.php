@extends('app')

@section('content')
	<div class="row">
		<div class="col-xs-8 group-destination">
			<div class="heading-font-normal">
				<input type="hidden" id="group_id" value="{{ $group->id }}"/>
				Group details:
				<div class="search-data">
					Destination: {{ $group->destination->name }}	
					</br>
					Date: {{ $group->date->format('d.m.y') }}	
					<div class="share-it">
				    	You can share the link with anybody!
				  </div>
				</div>			
			</div>
		</div>
		<div class="col-xs-4 group-slots">
			<input id="availableSlots" type="hidden" value="{{ $group->slots + $logged_user->tickets($group->id) }}">
			<div id="groupSlots" class="pull-right">
				{{ 10 - $group->slots }}/10
			</div>
		</div>
	</div>
	<hr>

	@include('groups._user-info')
	<hr>

	@include('groups._members')
	@if (count($group->users) != 1)
		<hr>
	@endif

	@include('groups._comments')

@endsection

@section('footer')
@endsection
