<!-- Display a list of groups -->
<div class="list-group">
	@foreach ($my_groups as $group)

		<a href="groups/{{ $group->id }}" class="list-group-item">
			<div class="row">
				<div class="col-md-8 col-md-offset-0 pull-left">
					<h4 class="list-group-item-heading">{{ $group->destination->name }}</h4>
					<p class="list-group-item-text">Date: {{ date('d/m', strtotime($group->date)) }}</p>
					<p class="list-group-item-text">Tickets: {{ $group->pivot->tickets }}</p>
				</div>
				<div class="pull-right slots">
					<h4 class="list-group-item-heading">{{ 10 - $group->slots }}/10</h4>
				</div>
			</div>
		</a>
		
	@endforeach
</div>