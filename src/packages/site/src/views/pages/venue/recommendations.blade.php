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
	$user = isset($user) ? $user : null;
	$dinnerVenue = isset($dinnerVenue) ? $dinnerVenue : null;
	$brunchVenue = isset($brunchVenue) ? $brunchVenue : null;

	//get page variables
//	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
//	$text = safeArrayValue('text', $pageData, "");
//	$button = safeArrayValue('button', $pageData, "");
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
//	$backgroundImage = safeArrayValue('background_image', $pageData, "");

	//user properties
	$userName = fullName($user, null);


	//dinner venue properties
	$dinnerId = safeObjectValue('id', $dinnerVenue, "");
	$dinnerName = safeObjectValue('name', $dinnerVenue, "");
	$dinnerImage = safeObjectValue('image_profile', $dinnerVenue, "");
	$dinnerLink = intval($dinnerId)>=0 ? route('soup.venue.profile', ['venueId'=>$dinnerId]) : null;
	$dinnerAddress = compilePropertiesString($dinnerVenue, ['address', 'suburb'], [', ']);
	$dinnerOpenHours = venueTodaysOpenHoursString($dinnerVenue, "CLOSED TODAY");

	//brunch venue properties
	$brunchId = safeObjectValue('id', $brunchVenue, "");
	$brunchName = safeObjectValue('name', $brunchVenue, "");
	$brunchImage = safeObjectValue('image_profile', $brunchVenue, "");
	$brunchLink = intval($brunchId)>=0 ? route('soup.venue.profile', ['venueId'=>$brunchId]) : null;
	$brunchAddress = compilePropertiesString($brunchVenue, ['address', 'suburb'], [', ']);
	$brunchOpenHours = venueTodaysOpenHoursString($brunchVenue, "CLOSED TODAY");
	
?>

{{-- title --}}
<div class="padding-small">
	@if (isset($userName))
		<h2 class="uppercase color-2">{{ $userName }}'S INVITATIONS<h2>
	@endif
</div>


{{-- dinner venue --}}
@if (isset($dinnerVenue) && intval($dinnerId)>=0)
	<div class="venue-preview-container">
		<a href="{{ $dinnerLink  }}">
			<div class="venue-preview">
			
				{{-- background image --}}
				<div class="stretch-to-fit hide-overflow-y">
					@include('soup::sections.background', ['backgroundImage' => $dinnerImage, 'loadGroup' => 'dinner'])
				</div>
				
				<div class="page-overlay bg-color-clear" load-style="fade" load-group="dinner">
				
					<h1 class="title-bold color-2">DINNER</h1>
				
				</div>
			</div>
			<div class="bg-color-2">
				
				<div class="spacer-small"></div>
				
				{{-- name --}}
				<div class="padding-very-large">
					<h3 class="clear-header-margins uppercase color-1">{{ $dinnerName }}</h3>
				</div>

				<div class="padding-small">
					<h3 class="shrink-to-fit title-regular capitalize color-1">{{ $dinnerAddress }}</h3>
					<h3 class="shrink-to-fit title-regular lowercase color-1">{{ $dinnerOpenHours }}</h3>
				</div>

				<div class="spacer-small"></div>
				
			</div>
		</a>
	</div>
@endif


{{-- brunch venue --}}
@if (isset($brunchVenue) && intval($brunchId)>=0)
	<div class="venue-preview-container">
		<a href="{{ $brunchLink  }}">
			<div class="venue-preview">
	
				{{-- background image --}}
				<div class="stretch-to-fit hide-overflow-y">
					@include('soup::sections.background', ['backgroundImage' => $brunchImage, 'loadGroup' => 'brunch'])
				</div>
				
				<div class="page-overlay bg-color-clear" load-style="fade" load-group="brunch">
				
					<h1 class="title-bold color-2">BRUNCH</h1>
				
				</div>
	
			</div>
			<div class="bg-color-2">
				
				<div class="spacer-small"></div>
				
				{{-- name --}}
				<div class="padding-very-large">
					<h3 class="clear-header-margins uppercase color-1">{{ $brunchName }}</h3>
				</div>

				<div class="padding-small">
					<h3 class="shrink-to-fit title-regular capitalize color-1">{{ $brunchAddress }}</h3>
					<h3 class="shrink-to-fit title-regular lowercase color-1">{{ $brunchOpenHours }}</h3>
				</div>

				<div class="spacer-small"></div>
				
			</div>
		</a>
	</div>
@endif

<div class="spacer-medium"></div>

@stop
{{--------------- END CONTENT ----------------}}
