<!-- Display a list of groups results-->
<div class="list-group">

	<div class="search-data heading-font-normal">
		{{ count($new_groups) }} new groups
	</div>

	@if (count($new_groups) == 0)

		<form method="post" action="/groups/create">
			{!! Form::hidden('destination_id', $destination_id) !!}
			{!! Form::hidden('date', $date) !!}
			{!! Form::hidden('tickets', $tickets) !!}
			<input class="btn btn-primary btn-block" type="submit" value="Create new group">
		</form>

	@endif

	<?php $i=0; ?>
	@foreach ($new_groups as $new_group)
		<div class="list-group-item">
			<div class="row">

				<div class="list-group-details col-md-8 col-md-offset-0 pull-left">
					<h4 class="list-group-item-heading">{{ $new_group->destination->name }}</h4>
					<p class="list-group-item-text">Date: {{ date('d/m', strtotime($new_group->date)) }}</p>
					<p class="list-group-item-text">People: {{ 10 - $new_group->slots }}/10</p>
				</div>

				<form method="post" action="/groups/join" class="pull-right">
					{!! Form::hidden('group_id', $new_group->id) !!}
					{!! Form::hidden('tickets', $tickets) !!}
					<input id="{{ $i }}" class="btn btn-primary join-btn" value="Join">
				</form>

			</div>
		</div>
	<?php $i++; ?>
	@endforeach

	<div class="search-data heading-font-normal">
		{{ count($joined_groups) }} joined groups
	</div>
	@foreach ($joined_groups as $joined_group)

		<a href="/groups/{{ $joined_group->id }}" class="list-group-item">
			<div class="row">
				<div class="list-group-details col-md-8 col-md-offset-0 pull-left">
					<h4 class="list-group-item-heading">{{ $joined_group->destination->name }}</h4>
					<p class="list-group-item-text">Date: {{ date('d/m', strtotime($joined_group->date)) }}</p>
					<p class="list-group-item-text">People: {{ 10 - $joined_group->slots }}/10</p>
				</div>
			</div>
		</a>

	@endforeach
	<a href="/search" class="btn btn-info btn-block" style="margin-top: 20px"> 
		Back to search
	</a>
</div>

@section('footer')
<script type="text/javascript">
	$(".join-btn").on("click", function() {
		var access_token="{{ getenv("FACEBOOK_CLIENT_ID") }}|{{ getenv("FACEBOOK_CLIENT_SECRET") }}";
		var template="{{ $logged_user->name }} has joined {{ $destination_slug }} - {{ $date }} group. Check it out!";
		var callback="#";
		var group_id = $(this).attr('id');
		var url = "/groups/" + group_id;
		$.ajax({ 
			url: url, 
			success: function(data){
	        	console.log(data);
		        // Signal members on FB that somebody has joined the group
			 	for(var index in data) 
			 	{
					if (data[index]['provider_id'] != {{ $logged_user->provider_id }})
					{
						var url = "https://graph.facebook.com/" + data[index]['provider_id'] + "/notifications?access_token=" + access_token + "&template=" + template + "&href=" + callback;
						$.ajax({
			        		type: "POST",
			        		url: url
						});
					}
				}
	    	}
	    });
	});
</script>
@endsection

