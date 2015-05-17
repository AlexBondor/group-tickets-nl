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
 
	        //.....
	        //show some spinner etc to indicate operation in progress
	        //.....
			$.ajax({
				type: "POST",
				url: '/groups/comment',
				data: { 
					'group_id': $('#group_id').val(), 
					'comment': $('#comment').val()
				}
			}).done( function (comments){
				$('#comment').val('');
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