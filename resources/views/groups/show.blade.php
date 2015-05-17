@extends('app')

@section('content')
	<div class="row">
		<div class="col-xs-8 group-destination-div">
			<span class="heading-font-normal">
				{{ $group->destination->name }}				
			</span>
			<span class="group-date">
				{{ $group->date->format('d.m.y') }}
			</span>
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
	<hr>

	@include('groups._comments')

@endsection