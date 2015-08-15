<div class="list-group">
	@foreach ($group->users as $user)
		@if ($user->id != $logged_user->id)
			<div class="list-group-item row">
				<div class="col-xs-6 right-col">
					@if ($user->id == $leader_id)
						Group leader
						<br>
					@endif
					<a class="member-name" href="{{ $user->link }}">{{ $user->name }}</a>
					<br>
					<i class="user-stats">groups: 10 joined, 3 left</i>	
					<br>	
					<div class="member-email-box" tabindex="0" data-toggle="popover" data-content="{{ $user->email }}" data-placement="bottom">
						<span class="glyphicon glyphicon-envelope" aria-hidden="true" data-value='popover'></span>
					</div>			
				</div>
				<div class="col-xs-6 right-col tickets-col">
					<div class="tickets pull-right">
						<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> {{ $user->tickets($group->id) }}
					</div>
				</div>
			</div>
		@endif
	@endforeach
</div>