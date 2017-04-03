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
	$recommendations = isset($recommendations) ? $recommendations : null;
//	$dinnerVenue = isset($dinnerVenue) ? $dinnerVenue : null;
//	$brunchVenue = isset($brunchVenue) ? $brunchVenue : null;

	//get page variables
//	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
//	$button = safeArrayValue('button', $pageData, "");
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
//	$backgroundImage = safeArrayValue('background_image', $pageData, "");

	//user properties
	$userName = fullName($user, null);

/*
	//dinner venue properties
	$dinnerId = safeObjectValue('id', $dinnerVenue, "");
	$dinnerProperties = [
		'type' => 'DINNER',
		'name' => safeObjectValue('name', $dinnerVenue, ""),
		'image' => safeObjectValue('image_profile', $dinnerVenue, ""),
		'link' => intval($dinnerId)>=0 ? route('soup.venue.profile', ['venueId'=>$dinnerId]) : null,
		'address' => compilePropertiesString($dinnerVenue, ['address', 'suburb'], [', ']),
		'openHours' => venueTodaysOpenHoursString($dinnerVenue, "CLOSED TODAY")
	];

	//brunch venue properties
	$brunchId = safeObjectValue('id', $brunchVenue, "");
	$brunchProperties = [
		'type' => 'BRUNCH',
		'name' => safeObjectValue('name', $brunchVenue, ""),
		'image' => safeObjectValue('image_profile', $brunchVenue, ""),
		'link' => intval($brunchId)>=0 ? route('soup.venue.profile', ['venueId'=>$brunchId]) : null,
		'address' => compilePropertiesString($brunchVenue, ['address', 'suburb'], [', ']),
		'openHours' => venueTodaysOpenHoursString($brunchVenue, "CLOSED TODAY")
	];
*/	
?>

<div class="spacer-tiny"></div>

{{-- title --}}
<div class="padding-small">
	@if (isset($userName))
		<h2 class="clear-header-margins bold uppercase color-2">{{ $userName }}'S INVITATIONS<h2>
	@endif
</div>


@if (isset($recommendations) && count($recommendations)>0)

	@foreach($recommendations as $recommendation)
		@include('soup::sections.recommendation', $recommendation)
	@endforeach

@else

	<div class="page-padding-medium">
		<h2 class="title-light color-2">{!! $text !!}</h2>
	</div>

@endif

<div class="spacer-medium"></div>

@stop
{{--------------- END CONTENT ----------------}}
