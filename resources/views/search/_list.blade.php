<!-- Display a list of groups results-->
<div class="list-group">
	@if (count($new_groups) == 0)

		<form method="post" action="/groups/create">
			{!! Form::hidden('destination_id', $destination_id) !!}
			{!! Form::hidden('date', $date) !!}
			{!! Form::hidden('tickets', $tickets) !!}
			<input class="btn btn-success btn-block" type="submit" value="Create new?">
		</form>

	@endif

	@foreach ($new_groups as $new_group)
		<div class="list-group-item">
			<div class="row">

				<div class="col-md-8 col-md-offset-0 pull-left">
					<h4 class="list-group-item-heading">{{ $new_group->destination->name }}</h4>
					<p class="list-group-item-text">Date: {{ date('d/m', strtotime($new_group->date)) }}</p>
					<p class="list-group-item-text">People: {{ 10 - $new_group->slots }}/10</p>
				</div>

				<form method="post" action="/groups/join" class="pull-right join-btn">
					{!! Form::hidden('group_id', $new_group->id) !!}
					{!! Form::hidden('tickets', $tickets) !!}
					<input class="btn btn-success" type="submit" value="Join">
				</form>

			</div>
		</div>
	@endforeach

	@if(count($joined_groups) != 0)
		<hr>
	@endif

	@foreach ($joined_groups as $joined_group)

		<a href="/groups/{{ $joined_group->id }}" class="list-group-item">
			<div class="row">
				<div class="col-md-8 col-md-offset-0 pull-left">
					<h4 class="list-group-item-heading">{{ $joined_group->destination->name }}</h4>
					<p class="list-group-item-text">Date: {{ date('d/m', strtotime($joined_group->date)) }}</p>
					<p class="list-group-item-text">People: {{ 10 - $joined_group->slots }}/10</p>
				</div>
			</div>
		</a>

	@endforeach
</div>