<div class="row">

	<div id='thumbnail-col' class="left-col">
		<div class="thumbnail">
			<a href="{{ $logged_user->link }}" target="_blank">
	  			<img class="user-img" src="{{ $logged_user->avatar }}">
	  		</a>
		    <div class="caption">
				<span id="spanTickets" aria-hidden="true">+{{ $logged_user->tickets($group->id) }}</span>
				<div tabindex="0" class="pull-right" data-toggle="popover" data-content="{{ $logged_user->email }}" data-placement="bottom">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true" data-value='popover'></span>
				</div>	
			</div>
	    </div>
	</div>

	<div id="btn-col" class="right-col">

		<div>
			<button id="btnAddTickets" class="btn btn-primary btn-add-tickets btn-block" data-value="no-reset">Set Tickets</button>
			<form id="formAddTicketsConfirm" method="post" action="/groups/update" class="btn-block hidden">
				{!! Form::hidden('group_id', $group->id, ['id'=>'atGroupId']) !!}
				<input id="atTickets" type="number" name="tickets" class="input-add-tickets pull-left" data-value="no-reset">
				<button id="btnSetTickets" class="btn btn-info btn-block btn-set-tickets" type="submit">Set</button>
			</form>
		</div>

		<div>
			<button id="btnOrder" class="btn btn-primary btn-block" data-value="no-reset">Order</button>
			<a id="btnOrderConfirm" href="https://www.ns.nl/producten/en/s/ns-groepsretour" class="btn btn-info btn-block hidden btn-order" target="_blank">Go to ns.nl</a>
		</div>

		<div>
			<button id="btnLeaveGroup" class="btn btn-primary btn-block cbtn-leave-group" data-value="no-reset">Leave group</button>
			<form id="formLeaveGroupConfirm" method="post" action="/groups/leave" class="btn-block hidden">
				{!! Form::hidden('group_id', $group->id) !!}
				{!! Form::hidden('tickets', $logged_user->tickets($group->id), ['id' => 'leavingTickets']) !!}
				<button id="btnLeaveGroupConfirm" class="btn btn-info btn-block btn-leave-group" type="submit">Click to confirm</button>
			</form>
		</div>

	</div>
</div>

@section('footer')
@parent
	<script type="text/javascript">
		// Enable popovers
		$(function () {
			$('[data-toggle="popover"]').popover();
		});

		// If popover shown and user clicks the body
		// popover is hidden
		$('body').on('click', function (e) {
		    if ($(e.target).data('value') != 'popover' && $(e.target).parents('.popover.in').length === 0 && $(e.target).data('value') != 'no-reset') 
		    { 
	            $('[data-toggle="popover"]').popover('hide');
	            resetButtons();
		    }
		});

		function resetButtons() {
			$('#btnAddTickets').removeClass('hidden');
			$('#formAddTicketsConfirm').addClass('hidden');

			$('#btnOrder').removeClass('hidden');
			$('#btnOrderConfirm').addClass('hidden');

			$('#btnLeaveGroup').removeClass('hidden');
			$('#formLeaveGroupConfirm').addClass('hidden');
		}

		$('#btnAddTickets').on('click', function() {
			$('#btnAddTickets').addClass('hidden');
			$('#formAddTicketsConfirm').removeClass('hidden');
		});

		$('#btnSetTickets').on('click', function() {
			$('#btnAddTickets').removeClass('hidden');
			$('#formAddTicketsConfirm').addClass('hidden');
		});

		$(function ()
		{
			$('.input-add-tickets').val(1);
			$('.input-add-tickets').attr('min', 1);
			$('.input-add-tickets').attr('max', $('#availableSlots').val());
		});

		$('#btnOrder').on('click', function() {
			$('#btnOrder').addClass('hidden');
			$('#btnOrderConfirm').removeClass('hidden');
		});

		$('#btnOrderConfirm').on('click', function() {
			$('#btnOrder').removeClass('hidden');
			$('#btnOrderConfirm').addClass('hidden');
		});

		$('#btnLeaveGroup').on('click', function() {
			$('#btnLeaveGroup').addClass('hidden');
			$('#formLeaveGroupConfirm').removeClass('hidden');
		});

		$('#btnLeaveGroupConfirm').on('click', function() {
			$('#btnLeaveGroup').removeClass('hidden');
			$('#formLeaveGroupConfirm').addClass('hidden');
		});

		$( document ).ready(function() {
			 $('#formAddTicketsConfirm').on( 'submit', function() {
			    //.....
			    //show some spinner etc to indicate operation in progress
			    //.....
				$.ajax({
					type: "POST",
					url: '/groups/update',
					data: { 
						'group_id': $('#atGroupId').val(), 
						'tickets': $('#atTickets').val()
					}
				}).done( function (data){
					$tickets = data[0];
					$slots = data[1];
					$('#groupSlots').text($slots + "/10");
					$('#spanTickets').text("+" + $tickets);
					$('#leavingTickets').val($tickets);
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