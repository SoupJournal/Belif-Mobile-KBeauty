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
	$venue = isset($venue) ? $venue : null;
	$mapsKey = isset($mapsKey) ? $mapsKey : null;

	//get page variables
//	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
//	$backgroundImage = safeArrayValue('background_image', $pageData, "");


	//profile properties
	$profileImage = safeObjectValue('image_profile', $venue, "");
	$venueId = safeObjectValue('id', $venue, "");
	$venueName = safeObjectValue('name', $venue, "");
	$venueDescription = safeObjectValue('description', $venue, "");
	$venueRecommendations = safeObjectValue('recommendations', $venue, null);
	$venueURL = safeObjectValue('website', $venue, null);
	$venueAddress = compilePropertiesString($venue, ['address', 'suburb'], [', ']);
	$openHours = venueTodaysOpenHoursString($venue, "CLOSED TODAY");

	//suggestion data
	$suggestionImage = safeObjectValue('image_suggestion', $venue, "");
	$suggestion = safeObjectValue('suggestion', $venue, "");
	
	//reservation data
	$reservationURL = route('soup.reservation.id', ['venueId' => $venueId]);
	
	//venue co-ordinates
	$lattitude = safeObjectValue('lattitude', $venue, null);
	$longitude = safeObjectValue('longitude', $venue, null);
	//create map position
	$mapPosition = null;
	if (isset($lattitude) && isset($longitude)) {
		$mapPosition = [
			'lat' => floatval($lattitude),
			'lng' => floatval($longitude)
		];
	}
	//create map marker
	$mapMarkers = $mapPosition ? [$mapPosition] : null;

?>


{{-- profile --}}
<div class="venue-profile">

	{{-- background image --}}
	<div class="stretch-to-fit hide-overflow-y">
		@include('soup::sections.background', ['backgroundImage' => $profileImage, 'loadGroup' => 'profile'])
		<div class="stretch-to-fit gradient-overlay"></div>
	</div>
	
	<div class="page-overlay bg-color-clear" load-style="fade" load-group="profile">
	
		<div class="spacer-small"></div>
	
		<h1 class="medium-1 title-bold uppercase color-2 page-padding-small">{{ $venueName }}</h1>
	
		<div class="page-footer">
		
			<h2 class="inline clear-header-margins shrink-to-fit title-semi-bold capitalize color-2 condensed">
				{{ $venueAddress }}
			</h2>
			<h2 class="inline clear-header-margins shrink-to-fit title-semi-bold capitalize color-1 bg-color-2 venue-hours condensed">
				{{ $openHours }}
			</h2>
			
			<div class="spacer-medium"></div>
			
		</div>
		
	</div>

</div>

{{-- description --}}
<div class="venue-description page-padding-small bg-color-5">
	
	<div class="spacer-tiny"></div>
	
	@if (isset($venueDescription)) 
		<h3 class="title-light large color-2">{!! $venueDescription !!}</h3>
	@endif
	
	@if (isset($venueRecommendations)) 
		<h3 class="title-semi-bold uppercase color-2">RECOMMENDED BY {{ $venueRecommendations }}</h3>
	@endif
	
	<div class="spacer-tiny"></div>

</div>

{{-- suggestion --}}
<div class="venue-suggestion bg-color-10">
	
	{{-- background image --}}
	<div class="stretch-to-fit hide-overflow-y">
		@include('soup::sections.background', ['backgroundImage' => $suggestionImage, 'loadGroup' => 'suggestion'])
	</div>
	
	<div class="stretch-to-fit bg-color-clear" load-style="fade" load-group="suggestion">
	
		<div class="table-parent fill-height">

			<div class="table-center-row">
			
				<div class="table-center-cell">
	
					<h3 class="clear-header-margins title-regular color-2">- {{ $text }} -</h3>
					<div class="spacer-tiny"></div>
					<h1 class="clear-header-margins title-semi-bold uppercase color-2">{{ $suggestion }}</h1>
	
				</div>
				
			</div>
			
		</div>
	
	</div>

</div>


{{-- reservation --}}
<div class="bg-color-10">
	
	<div class="spacer-small-2"></div>
	
	@if (isset($inviteDate))
		<div class="page-padding-small">
			<h1 class="small">You and a friend are invited for dinner in {{ $inviteDate }}.</h1>
		</div>
	@endif
	
	<a href="{{ $reservationURL }}">
		<h3 class="button-page-border border-thin title-bold bg-color-clear border-color-1 color-1">
			{{ $button }}
		</h3>
	</a>
	
	<div class="spacer-medium"></div>

</div>


{{-- map --}}
<div class="page-section">
	@include('soup::sections.map', Array(
		'APIKey' => $mapsKey,
		'width' => '100%',
		'height' => '200px',
		'position' => $mapPosition,
		'markers' => $mapMarkers
	))
</div>


{{-- website --}}
<div class="">
	
	<div class="spacer-medium"></div>
	
	<a href="{{ $venueURL }}"><h4 class="color-2">{{ $secondaryButton }}</h4></a>
	
	<div class="spacer-medium"></div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
