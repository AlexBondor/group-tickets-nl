<!-- Destination Form Input -->
<div class="form-group">
	{!! Form::label('destination', "Where to?") !!}
	{!! Form::text('destination', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Form Input -->
<div class="form-group">
	{!! Form::label('date', "When?") !!}
	{!! Form::input('date', 'date', $group->date->format('d-m-y'), ['class' => 'form-control']) !!}
</div>

<!-- Tickets Form Input -->
<div class="form-group">
	{!! Form::label('tickets', "How many?") !!}
	{!! Form::text('tickets', null, ['class' => 'form-control']) !!}
</div>

<!-- Add Article Form Input -->
<div class="form-group">
	{!! Form::submit('Search', ['class' => 'btn btn-primary form-control']) !!}
</div>