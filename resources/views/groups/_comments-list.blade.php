@foreach ($group->comments as $comment)

	<li class="media">
		<div class="media-left">
			<a href="{{ $comment->user->link }}">
				<img class="media-object" src="{{ $comment->user->avatar }}"/>
			</a>
		</div>
		<div class="media-body" style="width:100%">
			<div class="col-xs-8 group-comment-user-name">{{ $comment->user->name }} </div>
			<div class="col-xs-4" style="font-size:12px; float:right" align="right">{{ $comment->created_at->diffForHumans() }}</div>
			<br>
			<div class="col-xs-12">{{ $comment->text }}</div>
		</div>
	</li>

@endforeach
