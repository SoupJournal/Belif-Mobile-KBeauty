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
	$venue = isset($venue) ? $venue : null;
	$reservation = isset($reservation) ? $reservation : null;
	$pageData = isset($pageData) ? $pageData : null;

	//get page variables
	$title = safeArrayValue('title', $pageData, "");
//	$subtitle = safeArrayValue('subtitle', $pageData, "");
	$text = safeArrayValue('text', $pageData, "");
	$button = safeArrayValue('button', $pageData, "");
	$secondaryButton = safeArrayValue('secondary_button', $pageData, "");
	$backgroundImage = safeArrayValue('background_image', $pageData, "");
	

	//venue properties
	$venueId = safeObjectValue('id', $venue, "");
	$venueName = safeObjectValue('name', $venue, "");

	//reservation properties
	$reservationKey = safeObjectValue('code', $reservation, null);
	$date = safeObjectValue('date', $reservation, null);
	$reservationType = safeObjectValue('type', $reservation, null);
	$reservationGuests = safeObjectValue('guests', $reservation, 0);
	$reservationTime = $date ? $date->format('g:i A') : "";
	$reservationDay = $date ? $date->format('l, F jS') : "";

	//form submit URL
	$formURL = isset($formURL) ? $formURL : "";
	
?>

{{-- background image --}}
@include('soup::sections.background', ['backgroundImage' => $backgroundImage, 'loadGroup' => 'main'])

<div class="page-overlay bg-color-clear" load-style="fade" load-group="main">

	<div class="framed-box border-color-2 stretch-to-fit">
	
			<div class="table-parent fill-height">
			
				<div class="table-center-row">

					<div class="table-center-cell">
				
					{{ Form::open(Array('role' => 'form', 'name' => 'loginForm', 'url' => $formURL)) }}
					
						<div class="page-section page-padding-small">		
						
							<div class="spacer-medium"></div>
						
							<h1 class="title-bold color-2">{{ $title }}</h1>
							
							
							
							<div class="spacer-medium"></div>
							<div class="spacer-tiny"></div>
							
							
							
							<h2 class="clear-header-margins bold title-light color-2">
								{{ $venueName }}
							</h2>
							
							<div class="spacer-tiny"></div>
						
						
							
							<h2 class="clear-header-margins bold title-light color-2">
								<div>
									{{ isset($reservationType) ? $reservationType . ' for' : 'For' }} {{ $reservationGuests }} {{ $reservationGuests==1 ? 'person' : 'people' }} at {{ $reservationTime }} 
								</div>
								<div>
									On {{ $reservationDay }}.
								</div>
							</h2>
							
							<div class="spacer-medium"></div>
							
							
						</div>
						
						
						<div class="page-section page-padding-small-2">
							
							<h4 class="title-light color-2">{!! $text !!}</h4>
								
								
							<div class="spacer-medium"></div>
						
						</div>
						
	
					
						<div class="page-section">
								
									
							{{-- submit button --}}
							<div class="form-group"> 
								<button class="button-page-border title-bold border-thin bg-color-clear border-color-2 color-2">
									<h4 class="clear-header-margins">{{ $button }}</h4>
								</button>
							</div>
						
						
							<div class="spacer-tiny"></div>
							
						
							{{-- cancel button --}}
							<div class="form-group"> 
								<a href="{{ $backURL }}" class="button-page-border border-thin title-bold bg-color-clear border-color-9 color-9">
									<h4 class="clear-header-margins">{{ $secondaryButton }}</h4>
								</a>
							</div>
						
							<div class="spacer-large"></div>
						
							
							
							{{-- reservation key --}}
							<input type="hidden" name="reservation" value="{{ $reservationKey }}">
						
						</div>
						
					{{ Form::close() }}
		
				</div>
			</div>
		</div>
	
	</div>

</div>

@stop
{{--------------- END CONTENT ----------------}}
