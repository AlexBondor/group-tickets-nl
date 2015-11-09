@foreach ($group->comments as $comment)
	
	@if($comment->user->banned == 1)
	<li class="media" style="background-color:red; color:white">
	@else
	<li class="media">
	@endif
		<div class="media-left">
			<a href="{{ $comment->user->link }}">
				<img class="media-object" src="{{ $comment->user->avatar }}"/>
			</a>
		</div>
		<div class="media-body" style="width:100%">
			<div class="col-xs-8 group-comment-user-name" style="padding-left: 0px;">					
				{{ $comment->user->name }} 
				@if($comment->user->banned == 1)
				 - SPAMMER
				@endif
			</div>
			<div class="col-xs-4" style="font-size:12px; float:righ;" align="right">{{ $comment->created_at->diffForHumans() }}</div>
			<br>
			<div class="col-xs-12" style="padding-left: 0px;">{{ $comment->text }}</div>
		</div>
	</li>

@endforeach
