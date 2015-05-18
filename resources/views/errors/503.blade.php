@extends('app')

@section('content')
	<div class="heading-font-normal">Woops! Something went wrong! Go back to <a href="{{ action('SearchController@index') }}">Search</a> or <a href="{{ action('GroupController@index') }}">My groups</a></div>
@endsection