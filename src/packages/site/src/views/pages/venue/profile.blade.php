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
	$venue = isset($venue) ? $venue : null;

	//get page variables
//	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
//	$text = safeArrayValue('text', $pageData, "");
//	$button = safeArrayValue('button', $pageData, "");
//	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
//	$backgroundImage = safeArrayValue('background_image', $pageData, "");


	//profile properties
	$profileImage = safeObjectValue('image_profile', $venue, "");
	$venueName = safeObjectValue('name', $venue, "");
	$venueDescription = safeObjectValue('description', $venue, "");
	$venueRecommendations = safeObjectValue('recommendations', $venue, null);
	$venueURL = safeObjectValue('website', $venue, null);

	//suggestion data
	$suggestionImage = safeObjectValue('image_suggestion', $venue, "");
	$suggestion = safeObjectValue('suggestion', $venue, "");
	
	//venue co-ordinates
	$lattitude = safeObjectValue('lattitude', $venue, "");
	$longitude = safeObjectValue('longitude', $venue, "");
	
?>


{{-- profile --}}
<div class="venue-profile">

	{{-- background image --}}
	<div class="stretch-to-fit hide-overflow-y">
		@include('soup::sections.background', ['backgroundImage' => $profileImage, 'loadGroup' => 'profile'])
	</div>
	
	<div class="page-overlay bg-color-clear" load-style="fade" load-group="profile">
	
		<div class="spacer-small"></div>
	
		<h1 class="title-semi-bold color-2">{{ $venueName }}</h1>
	
	</div>

</div>

{{-- description --}}
<div class="venue-description page-padding-small bg-color-1">
	
	<div class="spacer-tiny"></div>
	
	<div class="color-2">{!! $venueDescription !!}</div>
	
	@if (isset($venueRecommendations)) 
		<h5 class="uppercase color-2">RECOMMENDED BY {{ $venueRecommendations }}</h5>
	@endif
	
	<div class="spacer-tiny"></div>

</div>

{{-- suggestion --}}
<div class="venue-suggestion bg-color-1">
	
	{{-- background image --}}
	<div class="stretch-to-fit hide-overflow-y">
		@include('soup::sections.background', ['backgroundImage' => $suggestionImage, 'loadGroup' => 'suggestion'])
	</div>
	
	<div class="page-overlay bg-color-clear" load-style="fade" load-group="suggestion">
	
		<div class="table-parent fill-height">

			<div class="table-center-row">
			
				<div class="table-center-cell">
	
					<h4 class="title-regular color-2">- SUGGESTION -</h4>
					<h1 class="title-semi-bold uppercase color-2">{{ $suggestion }}</h1>
	
				</div>
				
			</div>
			
		</div>
	
	</div>

</div>

{{-- map --}}
<div class="">
	


</div>

{{-- website --}}
<div class="">
	
	<div class="spacer-medium"></div>
	
	<a href="{{ $venueURL }}"><h4 class="color-2">VISIT THEIR WEBSITE</h4></a>
	
	<div class="spacer-medium"></div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
