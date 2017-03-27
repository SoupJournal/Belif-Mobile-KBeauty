@extends('soup::layouts.master')


{{------------------ TITLE -------------------}}

@section('title') Soup @stop

{{---------------- END TITLE -----------------}}




{{----------------- SCRIPTS ------------------}}

@section('scripts')

	{{-- HTML::script('packages/artisan/cms/js/cms/form/form.js') --}}	
	
@stop
{{--------------- END SCRIPTS ----------------}}





{{----------------- CONTENT ------------------}}

@section('content')

<?php

	//ensure page data is set
	$pageData = isset($pageData) ? $pageData : null;
	$user = isset($user) ? $user : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	
	//get user properties
	$email = safeObjectValue('email', $user, "");

	//images
	$titleImage = "https://s3.amazonaws.com/soup-journal-app-storage/soup/mobile/images/icons/logo-soup-large-white.png";

?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-clear" load-style="fade" load-group="main">


	{{-- title image --}}
	<img class="logo-title-image" alt="Soup" src="{{ $titleImage }}" load-style="fade">


	{{-- login page --}}
	<div class="page-container page-padding-medium-2" style="background-color: transparent;">		
	
		<div class="spacer-large"></div>
		
		
		{{-- subtitle --}}
		<h4 class="color-2">
			<div>{!! $title !!}</div>
			<div>{!! $subtitle !!}</div>
			<div>{{ $email }}</div>
			<div>{!! $text !!}</div>
		</h4>
		

			
		<div class="spacer-large"></div>
		<div class="spacer-medium"></div>
		
		
	
		{{-- next button --}}
		<a href="{{ route('soup.login') }}" class="button-page bg-color-10">
			<h4 class="clear-header-margins">{{ $button }}</h4>
		</a>

		

	
	</div>
		

</div>

@stop
{{--------------- END CONTENT ----------------}}
