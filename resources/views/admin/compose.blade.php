@extends('app')

@section('content')
	<div class="heading-font-normal">Send message</div>
@endsection

@section('footer')
<script type="text/javascript">
	// var access_token="{{ getenv("FACEBOOK_CLIENT_ID") }}|{{ getenv("FACEBOOK_CLIENT_SECRET") }}";
	// var template="{{ $logged_user->name }} posted a comment on {{ $group->destination->slug }} - {{ $group->date->format('d.m.y') }} group www.goo.gl";
	// var callback="#"; //http://www.staging.grouptickets.nl/groups/{{ $group->id }}"

	// var users = {!! $group->users !!};
	// $( document ).ready(function() {
 //    	 	$('#newComment').on( 'submit', function() {
			
	// 		return false;
	// 	});
	// });
//	alert(st);
//	var gi = $('#group_id').val();

//	var st = "/groups/listen/" + gi;
	
//	setInterval(function(){
//    $.ajax({ url: st, success: function(data){
//        console.log(data);
//    }, dataType: "json"});
//}, 1000);
</script>
@endsection
