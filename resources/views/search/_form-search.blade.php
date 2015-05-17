<!-- Destination Form Input -->
<div class="form-group">
	{!! Form::label('destination_list', "Where to?") !!}
	{!! Form::select('destination_list[]', $destinations, null, ['id' => 'destination_list', 'class' => 'form-control', 'style' => 'width: 100%;']) !!}
</div>

<!-- Date Form Input -->
<div class="form-group">
	{!! Form::label('date', "When?") !!}
	{!! Form::input('date', 'date', $group->date->format('Y-m-d'), ['class' => 'form-control',  'value' => '2012-5-4', 'min'=> date("Y-m-d")]) !!}
</div>

<!-- Tickets Form Input -->
<div class="form-group">
	{!! Form::label('tickets', "How many?") !!}
	{!! Form::text('tickets', null, ['class' => 'form-control']) !!}
</div>

</br>

<!-- Add Article Form Input -->
<div class="form-group">
	{!! Form::submit('Search', ['class' => 'btn btn-primary form-control']) !!}
</div>

@section('footer')
	<script type="text/javascript">
		$('#destination_list').select2();
	</script>
@endsection