@foreach ($group->users as $user)
	@if ($user->id != $logged_user->id)
		<div class="thumbnail inline">
			<a href="{{ $user->link }}">
	  			<img src="{{ $user->avatar }}">
	  		</a>
		    <div class="caption">
				<span aria-hidden="true">+{{ $user->tickets($group->id) }}</span>
				<div tabindex="0" class="pull-right" data-toggle="popover" data-content="{{ $user->email }}" data-placement="bottom">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true" data-value='popover'></span>
				</div>	
			</div>
	    </div>
	@endif
@endforeach