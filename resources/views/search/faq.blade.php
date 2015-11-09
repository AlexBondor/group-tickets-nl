@extends('app')

@section('content')
	<div class="heading-font-normal">Some tips</div>
	<hr>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingZero">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
          What does this website do?
        </a>
      </h4>
    </div>
    <div id="collapseZero" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingZero">
      <div class="panel-body">
       	This website is meant to make searching/creating/joining/sharing groups easier than the big Facebook groups that exist already. 
       	<br>
       	You cannot buy train tickets from this website! When a group is full you have to agree on who's going to buy the tickets and you buy the tickets from ns.nl website(the link is available on any group under the Order button).
      	<br>
	I am not responsible for any fraud that might be encountered while using the grouptickets.nl website!
	</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		Privacy Policy
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
	In the next paragraphs I will try to explain to everybody what data do I gather from the users and what do I do with it.
	<br>
	<br>
	The website stores public data from your Facebook account. More precisely it stores your name, email, facebook page link, facebook avatar link and facebook user id. Moreover any comment that you post on this website is stored as well.
	<br>
	<br>
	All the user information is gathered and stays in the website database. There is no way that somebody from outside has access to your information through my website.
	<br>
	<br>
	grouptickets.nl also uses Google Analytics which provides information in numbers about the user flow on the website.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Notifications don't appear on Facebook application
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        The code provided by Facebook to integrate notifications with any application makes possible giving notifications only in browsers. That is why you won't get any notifications on your FB application from your smartphone or tablet.
        <br>
        <br>
        How can I solve this?
        <br>
        For now the only solution is to use your phones' or tables' browser instead of the Facebook application.
      </div>
    </div>
  </div>
</div>
@endsection
