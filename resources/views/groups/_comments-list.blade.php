@foreach ($group->comments as $comment)

	<li class="media">
		<div class="media-left">
			<a href="{{ $comment->user->link }}">
				<img class="media-object" src="{{ $comment->user->avatar }}"/>
			</a>
		</div>
		<div class="media-body" style="width:100%">
			<div class="col-xs-8 group-comment-user-name" style="padding-left: 0px;">
				{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}
			</div>
			<div class="col-xs-4 comment-time-edit-delete-section" style="font-size:12px; float:righ;" align="right">
				@if ($logged_user->id == $comment->user->id)
					<span id="edit_comment_button" class="glyphicon glyphicon-pencil"></span> 
					<span id="remove_comment_button" class="glyphicon glyphicon-remove"></span>
				@endif 
			</div>
			<br>
			<div class="col-xs-12" style="padding-left: 0px;">
				<textarea id="edit_comment_textarea" rows="5" style="resize: none; width: 100%" maxlength="5000" hidden>{{ $comment->text }}</textarea>
				{{ $comment->text }}
			</div>
		</div>
	</li>

@endforeach


@section('footer')
@parent

<script type="text/javascript">
	$('#edit_comment_button').on('click', function(){
		$('div').parent().('#edit_comment_textarea').removeClass('hidden');
	});
</script>

@endsection