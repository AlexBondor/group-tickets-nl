<div class="heading-font-normal">Comments:</div>

<form id="newComment" method="post" action="/groups/comment">
	{!! Form::hidden('group_id', $group->id, ['id' => 'group_id']) !!}
	<textarea id="comment" name="text" rows="2" cols="50" style="resize: none; width: 100%" placeholder="Enter a new comment.."></textarea>
</form>

<ul id="commentsList" class="media-list">
	
	@include('groups._comments-list')

</ul>

@section('footer')
@parent
<script type="text/javascript">
	// Submit form on enter and newline on shift + enter
	$('textarea').on('keydown', function(event) {
		if (event.keyCode == 13)
		{
			if (!event.shiftKey) 
			{
				$('#newComment').submit();
			}
		}
	});

	$( document ).ready(function() {
    	 $('#newComment').on( 'submit', function() {
    	 	var access_token="{{ getenv("FACEBOOK_CLIENT_ID") }}|{{ getenv("FACEBOOK_CLIENT_SECRET") }}";
			var template="{{ $logged_user->name }} posted a comment on {{ $group->destination->slug }} - {{ $group->date->format('d.m.y') }} group. Check it out!";
			var callback="#"; //http://www.staging.grouptickets.nl/groups/{{ $group->id }}"
			var users = {!! $group->users !!};
    	 	// Signal members on FB that somebody commented
    	 	for(var index in users) 
    	 	{
				if (users[index]['provider_id'] != {{ $logged_user->provider_id }})
				{
					var url = "https://graph.facebook.com/" + users[index]['provider_id'] + "/notifications?access_token=" + access_token + "&template=" + template + "&href=" + callback;
					$.ajax({
                		type: "POST",
                		url: url
					});
				}
			}

			// Save new comment to database and update user's view
    	 	$comment = $('#comment').val();
    	 	$('#comment').attr('disabled', '');
    	 	$('#comment').val('');
	        //.....
	        //show some spinner etc to indicate operation in progress
	        //.....
			$.ajax({
				type: "POST",
				url: '/groups/comment',
				data: { 
					'group_id': $('#group_id').val(), 
					'comment': $comment
				}
			}).done( function (comments){
    	 		$('#comment').removeAttr('disabled');
				// prepend la ultimu comm
				$("#commentsList").html(comments);
			});

	 
	        //.....
	        //do anything else you might want to do
	        //.....
	 
	        //prevent the form from actually submitting in browser
	        return false;
	    });
	});
</script>
@endsection