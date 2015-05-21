<!-- Display a list of groups -->
<div class="list-group">
	@foreach ($my_groups as $group)

		<a href="groups/{{ $group->id }}-{{ $group->destination->slug }}-{{ $group->date->format('d-m-y') }}" class="list-group-item">
			<div class="row">
				<div class="list-group-details col-md-8 col-md-offset-0 pull-left">
					<h4 class="list-group-item-heading">{{ $group->destination->name }}</h4>
					<p class="list-group-item-text">Date: {{ date('d/m', strtotime($group->date)) }}</p>
					<p class="list-group-item-text">Tickets: {{ $group->pivot->tickets }}</p>
				</div>
				<div class="pull-right">
					<h4 class="list-group-item-heading">{{ 10 - $group->slots }}/10</h4>
					<br>
					<br>
					Click for details
				</div>
			</div>
		</a>
		
	@endforeach
</div>