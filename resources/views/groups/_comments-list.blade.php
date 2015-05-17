@foreach ($group->comments as $comment)

	<li class="media">
		<div class="media-left">
			<a href="{{ $comment->user->link }}">
				<img class="media-object" src="{{ $comment->user->avatar }}"/>
			</a>
		</div>
		<div class="media-body">
			<span class="group-comment-user-name">{{ $comment->user->name }}</span>
			<br>
			<span>{{ $comment->text }}</span>
		</div>
	</li>

@endforeach