<!-- Destination Form Input -->
<div class="form-group">
	{!! Form::label('destination_list', "Where to?") !!}
	{!! Form::select('destination_list[]', $destinations, $default_id, ['id' => 'destination_list', 'class' => 'form-control', 'style' => 'width: 100%;']) !!}
</div>

<!-- Date Form Input -->
<div class="form-group">
	{!! Form::label('date', "When?") !!}
    <input id="datetime" type='text' name="date" class="form-control" data-provide="datepicker"/>
</div>

<!-- Tickets Form Input -->
<div class="form-group">
	{!! Form::label('tickets', "How many?") !!}
	{!! Form::input('number', 'tickets', 1, ['class' => 'form-control']) !!}
</div>

</br>

<!-- Add Article Form Input -->
<div class="form-group">
	{!! Form::submit('Search', ['class' => 'btn btn-primary form-control']) !!}
</div>

@section('footer')
	<script type="text/javascript">
		$('#destination_list').select2();
		$('#datetime').datepicker({
			autoclose: true,
	        minDate: 0
		}).datepicker("setDate", "0");
	</script>
@endsection