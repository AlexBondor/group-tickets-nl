@extends('app')

@section('content')
	<div class="heading-font-normal">Some tips</div>
	<hr>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          How to enable clickable FB notifications?
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        When you click a notification Facebook will try to load the content of this website inside a facebook page. But it will only load contents of applications the users trust. If you haven't done any settings when you click a notification you will be shown a white page with a 'sad face'(in Chrome for ex.) on the page.
		<br>
		<br>
		How can you solve this?
		<br>
		Go to <a href="https://www.grouptickets.nl">https://www.grouptickets.nl</a>.
		<br>
		There will a page with a lock(in Chrome for ex) and you have to click "Advanced" and afterwards hit "Proceed"(it says that it is untrusted, but you can trust me there is nothing wrong that can happen). It should be similar to other browsers.
		<br>
		That is the moment when you say you trust the website and from that moment on Facebook will be able to load the websites' content when you click a notification.
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
@endsection