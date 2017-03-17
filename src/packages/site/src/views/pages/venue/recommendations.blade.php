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
//	$pageData = isset($pageData) ? $pageData : null;
	$dinnerVenue = isset($dinnerVenue) ? $dinnerVenue : null;
	$brunchVenue = isset($brunchVenue) ? $brunchVenue : null;

	//get page variables
//	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
//	$text = safeArrayValue('text', $pageData, "");
//	$button = safeArrayValue('button', $pageData, "");
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
//	$backgroundImage = safeArrayValue('background_image', $pageData, "");


	//dinner venue properties
	$dinnerId = safeObjectValue('name', $dinnerVenue, "");
	$dinnerName = safeObjectValue('name', $dinnerVenue, "");
	$dinnerImage = safeObjectValue('image_profile', $dinnerVenue, "");

	//brunch venue properties
	$brunchId = safeObjectValue('name', $brunchVenue, "");
	$brunchName = safeObjectValue('name', $brunchVenue, "");
	$brunchImage = safeObjectValue('image_profile', $brunchVenue, "");
	
?>


{{-- dinner venue --}}
<div class="venue-preview">

	{{-- background image --}}
	@include('soup::sections.background', ['backgroundImage' => $dinnerImage, 'loadGroup' => 'dinner'])
	
	<div class="page-overlay bg-color-clear" load-style="fade" load-group="dinner">
	
		<h1 class="color-2">{{ $dinnerName }}</h1>
	
	</div>

</div>

{{-- brunch venue --}}
<div class="venue-profile">

	{{-- background image --}}
	@include('soup::sections.background', ['backgroundImage' => $brunchImage, 'loadGroup' => 'brunch'])
	
	<div class="page-overlay bg-color-clear" load-style="fade" load-group="brunch">
	
		<h1 class="color-2">{{ $brunchName }}</h1>
	
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
