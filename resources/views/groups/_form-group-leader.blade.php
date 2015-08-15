{!! Form::hidden('group_id', $group->id) !!}
{!! Form::hidden('user_id', $logged_user->id) !!}
{!! Form::button('Become group leader!', ['class' => 'btn btn-primary btn-block', 'data-toggle' => 'modal', 'data-target' => '.confirm-leadership-modal']) !!}

<div class="modal fade confirm-leadership-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="mySmallModalLabel">Attention!</h4>
			</div>

			<div class="modal-body alert alert-danger">
				With great power comes great responsibility!
				<br>
				<br>
				<b>
					What does becoming a group leader mean?
				</b>
				<br>
				* You must buy the tickets from NS.nl for everybody in the group
				<br>
				* You need to send the e-ticket to each member once they gave you their share
				<br>
				* You will be able to kick members out if they won't respond
				<br>
				* You must lock the group before proceeding to buying the tickets
				<br>
				* You must signal members that you have bought the tickets
				<br>
				<br>
				<b>
					Steps:
				</b>
				<br>
				1. Wait for people to join the group
				<br>
				2. Lock the group when it is full
				<br>
				3. Request members to pay their share
				<br>
				4. Buy the tickets and inform the members
				<br>
				5. Send the tickets away!
				<br>
				<br>
				<b>C'mon, I know you can do it!</b>
			</div>

			<div class="modal-footer">
				<button type="button" class="pull-left btn btn-info modal-close-button" data-dismiss="modal">Close</button>
				<button id="submit-modal-button" type="button" class="btn btn-primary">I can do it!</button>
			</div>
		</div>
	</div>
</div>

@section('footer')
@parent
	<script type="text/javascript">
		$("#submit-modal-button").on("click", function() {
			document.forms[0].submit();
		});
	</script>
@endsection