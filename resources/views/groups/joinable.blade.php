@extends('app')

@section('content')
	<div class="row">
		<div class="col-xs-8 group-destination">
			<div class="heading-font-normal">
				Group details:
				<div class="search-data">
					Destination: {{ $group->destination->name }}	
					</br>
					Date: {{ $group->date->format('d.m.y') }}	
					</br>
					</br>
					Tickets:
				</div>			
			</div>
		</div>
		<div class="col-xs-4 group-slots">
			<div id="groupSlots" class="pull-right">
				{{ 10 - $group->slots }}/10
			</div>
		</div>
	</div>
	<form method="post" action="/groups/join" class="joinable-form">
		<input id="availableSlots" type="hidden" value="{{ $group->slots }}">
		{!! Form::hidden('group_id', $group->id) !!}
		{!! Form::hidden('tickets', 1) !!}
		<input id="joinableTickets" type="number" name="tickets" class="input-add-tickets pull-left" data-value="no-reset">
		<input id="joinableBtn" class="btn btn-primary btn-block" type="submit" value="Join">
	</form>
	<hr>
	<div class="heading-font-normal">
		Members:
	</div>
	@include('groups._members')
	@if (count($group->users) != 1)
		<hr>
	@endif

	@include('groups._comments')

@endsection

@section('footer')
<script type="text/javascript">
	setTimeout(function(){
	   window.location.reload(1);
	}, 100000);
	$(function ()
	{
		$('#joinableTickets').val(1);
		$('#joinableTickets').attr('min', 1);
		$('#joinableTickets').attr('max', $('#availableSlots').val());
	});
</script>
@endsection