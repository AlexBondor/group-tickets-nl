@extends('app')

@section('content')
	<div class="row">
		<div class="col-xs-8 group-destination">
			<div class="heading-font-normal">
				<input type="hidden" id="group_id" value="{{ $group->id }}"/>
				Group details:
				<div class="search-data">
					Destination: {{ $group->destination->name }}	
					</br>
					Date: {{ $group->date->format('d.m.y') }}	
					<div class="share-it">
				    	You can share the link with anybody!
				  </div>
				</div>			
			</div>
		</div>
		<div class="col-xs-4 group-slots">
			<input id="availableSlots" type="hidden" value="{{ $group->slots + $logged_user->tickets($group->id) }}">
			<div id="groupSlots" class="pull-right">
				{{ 10 - $group->slots }}/10
			</div>
		</div>
	</div>
	<hr>

	@include('groups._user-info')
	<hr>

	@include('groups._members')
	@if (count($group->users) != 1)
		<hr>
	@endif

	@include('groups._comments')

@endsection

@section('footer')
<script type="text/javascript">
	//alert({{ getenv('FACEBOOK_CLIENT_ID') }});
	var access_token="{{ getenv("FACEBOOK_CLIENT_ID") }}|{{ getenv("FACEBOOK_CLIENT_SECRET") }}";
	var template="{{ $logged_user->name }} posted a comment on {{ $group->destination->slug }} - {{ $group->date->format('d.m.y') }} group www.goo.gl";
	var callback="#"; //http://www.staging.grouptickets.nl/groups/{{ $group->id }}"

	//console.log(url);
	var users = {!! $group->users !!};
	$( document ).ready(function() {
    	 	$('#newComment').on( 'submit', function() {
			for(var index in users) {
				if (users[index]['provider_id'] != {{ $logged_user->provider_id }})
				{
					var url = "https://graph.facebook.com/" + users[index]['provider_id'] + "/notifications?access_token=" + access_token + "&template=" + template + "&href=" + callback;
					$.ajax({
                                		type: "POST",
                                		url: url,
                                		error: function(response) {
                                        		//console.log(response);
                                			}
                        			}).done( function (data){
                                			//console.log(data);
                        			});
					}
				}
			return false;
		});
	});
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
