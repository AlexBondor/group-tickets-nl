@extends('app')

@section('content')
	<div class="heading-font-normal">Send message</div>
	<textarea id="message" name="text" rows="2" cols="50" style="resize: none; width: 100%" placeholder="Send a notification.."></textarea>
@endsection

@section('footer')
<script type="text/javascript">
	// Submit form on enter and newline on shift + enter
	$('#message').on('keydown', function(event) {
		if (event.keyCode == 13)
		{
			if (!event.shiftKey) 
			{
				$message = $('#message').val();
	    	 	$('#message').attr('disabled', '');
	    	 	$('#message').val('');
				$.ajax({
					type: "POST",
					url: "/admin/message",
					data: {
						'message': $message
					},
					success: function(){
						alert("Sent");
					}
				});
			}
		}
	});
</script>
@endsection
