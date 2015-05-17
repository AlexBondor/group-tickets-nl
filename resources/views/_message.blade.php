@if (Session::has('joined_group_message'))
	<div class="alert alert-success">
		{{ session('joined_group_message') }}
	</div>
@elseif (Session::has('created_group_message'))
	<div class="alert alert-success">
		{{ session('created_group_message') }}
	</div>
@elseif (Session::has('left_group_message'))
	<div class="alert alert-success">
		{{ session('left_group_message') }}
	</div>
@endif

@section('footer')
	<script type="text/javascript">
		$('div.alert').delay(2000).slideUp(300);
	</script>
@endsection